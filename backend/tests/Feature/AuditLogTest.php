<?php

namespace Tests\Feature;

use App\Models\IpAddress;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuditLogTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    /**
     * Unauthenticated user cant fetch all audit logs and redirect to login get route
     */
    public function test_unauthenticated_user_cant_get_audit_log_list(): void
    {
        $response = $this->get('api/audit-log');

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect("api/login");
    }

    /**
     * authenticated user can fetch all audit logs
     */
    public function test_authenticated_user_can_get_audit_log_list(): void
    {
        $signedInUser = User::factory()->create();
        $response = $this->actingAs($signedInUser, 'sanctum')->getJson('api/audit-log');

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonFragment(["message" => "Data successfully retrieve"]);
    }

    /**
     * audit log will add when a successful login event happen
     */
    public function test_audit_log_create_on_success_login(): void
    {
        $attr = [
            "email" => "salihanmridha@gmail.com",
            "password" => "12345678"
        ];

        $response = $this->postJson('/api/login', $attr);

        $this->assertDatabaseHas('audit_logs', [
            "model_name" => "User",
            "event" => "LOGIN",
            "status" => "SUCCESS",
            "log_description" => "salihanmridha@gmail.com login successfully.",
        ]);
    }

    /**
     * audit log will add when a failed login event happen
     */
    public function test_audit_log_create_on_failed_login(): void
    {
        $attr = [
            "email" => "salihanmridha@gmail.com",
            "password" => "1234567"
        ];

        $response = $this->postJson('/api/login', $attr);

        $this->assertDatabaseHas('audit_logs', [
            "model_name" => "User",
            "event" => "LOGIN",
            "status" => "FAILED",
            "log_description" => "salihanmridha@gmail.com login attempt failed!",
        ]);
    }

    /**
     * audit log will add when a ip address create event happen
     */
    public function test_audit_log_create_on_ip_create_event(): void
    {
        $signedInUser = User::factory()->create();

        $attr = [
            "ip_address" => "127.0.0.1",
            "comment" => "localhost",
        ];
        $this->actingAs($signedInUser, 'sanctum')->postJson('api/ip-address', $attr);

        $this->assertDatabaseHas('audit_logs', [
            "model_name" => "IpAddress",
            "event" => "CREATE",
            "status" => "SUCCESS",
            "log_description" => "{$signedInUser->email} created IP address {$attr["ip_address"]} with '{$attr["comment"]}' comment",
        ]);
    }

    /**
     * audit log will add when an ip address update event happen
     */
    public function test_audit_log_create_on_ip_update_event(): void
    {
        $signedInUser = User::factory()->create();
        $ip = IpAddress::find(1);
        $attr = [
            "comment" => "new comment for localhost",
        ];
        $this->actingAs($signedInUser, 'sanctum')->putJson('api/ip-address/'.$ip->id, $attr);

        $this->assertDatabaseHas('audit_logs', [
            "model_name" => "IpAddress",
            "event" => "UPDATE",
            "status" => "SUCCESS",
            "log_description" => "{$signedInUser->email} updated IP address {$ip->ip_address} with '{$attr["comment"]}' comment",
        ]);
    }
}
