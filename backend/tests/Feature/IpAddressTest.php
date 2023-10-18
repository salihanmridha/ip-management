<?php

namespace Tests\Feature;

use App\Models\IpAddress;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IpAddressTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    /**
     * Unauthenticated user cant fetch all ip addresses and redirect to login get route
     */
    public function test_unauthenticated_user_cant_get_ip_list(): void
    {
        $response = $this->get('api/ip-address');

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect("api/login");
    }

    /**
     * Unauthenticated user cant create ip address
     */
    public function test_unauthenticated_user_cant_create_ip(): void
    {
        $attr = [
            "ip_address" => "127.0.0.1",
            "comment" => "localhost",
        ];
        $response = $this->postJson('api/ip-address', $attr);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

    }

    /**
     * Unauthenticated user cant access single ip address
     */
    public function test_unauthenticated_user_cant_get_single_ip_address(): void
    {
        $response = $this->get('api/ip-address/1');

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect("api/login");
    }

    /**
     * Unauthenticated user cant update ip address
     */
    public function test_unauthenticated_user_cant_update_ip(): void
    {
        $attr = [
            "comment" => "new localhost",
        ];
        $response = $this->put('api/ip-address/1', $attr);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect("api/login");
    }

    /**
     * authenticated user can create ip address
     */
    public function test_authenticated_user_can_create_ip(): void
    {
        $signedInUser = User::factory()->create();

        $attr = [
            "ip_address" => "127.0.0.1",
            "comment" => "localhost",
        ];
        $response = $this->actingAs($signedInUser, 'sanctum')->postJson('api/ip-address', $attr);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            "status" => Response::HTTP_CREATED,
            "success" => true,
            "message" => "127.0.0.1 ip successfully created.",
            "data" => [
                "ip_address" => [
                    "ip_address" => "127.0.0.1",
                    "comment" => "localhost",
                    "user_id" => $signedInUser->id,
                    "user" => [
                        "name" => $signedInUser->name,
                        "email" => $signedInUser->email
                    ]
                ]
            ],
        ]);

        $this->assertDatabaseHas('ip_addresses', [
            "ip_address" => $attr["ip_address"],
            "comment" => $attr["comment"],
            "user_id" => $signedInUser->id,
        ]);
    }

    /**
     * authenticated user cant create ip address with invalid ip
     */
    public function test_authenticated_user_cant_create_ip_with_invalid_ip(): void
    {
        $signedInUser = User::factory()->create();

        $attr = [
            "ip_address" => "123.234.345.001",
            "comment" => "invalid ip",
        ];
        $response = $this->actingAs($signedInUser, 'sanctum')->postJson('api/ip-address', $attr);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            "status" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "success" => false,
            "message" => "The ip address field must be a valid IP address.",
            "errors" => [
                "ip_address" => [
                    "The ip address field must be a valid IP address.",
                ],
            ],
        ]);
    }

    /**
     * authenticated user cant create ip address without give ip address
     */
    public function test_authenticated_user_cant_create_ip_without_fill_ip_field(): void
    {
        $signedInUser = User::factory()->create();

        $attr = [
            "comment" => "localhost new comment",
        ];
        $response = $this->actingAs($signedInUser, 'sanctum')->postJson('api/ip-address', $attr);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            "status" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "success" => false,
            "message" => "The ip address field is required.",
            "errors" => [
                "ip_address" => [
                    "The ip address field is required."
                ]
            ],
        ]);
    }

    /**
     * authenticated user cant create ip address without give ip comment
     */
    public function test_authenticated_user_cant_create_ip_without_fill_comment_field(): void
    {
        $signedInUser = User::factory()->create();

        $attr = [
            "ip_address" => "192.168.0.1",
        ];
        $response = $this->actingAs($signedInUser, 'sanctum')->postJson('api/ip-address', $attr);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            "status" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "success" => false,
            "message" => "The comment field is required.",
            "errors" => [
                "comment" => [
                    "The comment field is required."
                ]
            ],
        ]);
    }

    /**
     * authenticated user can update ip address comment
     */
    public function test_authenticated_user_can_update_ip_comment(): void
    {
        $signedInUser = User::factory()->create();
        $ip = IpAddress::find(1);

        $attr = [
            "comment" => "my new comment",
        ];
        $response = $this->actingAs($signedInUser, 'sanctum')->putJson('api/ip-address/1', $attr);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            "status" => Response::HTTP_OK,
            "success" => true,
            "message" => "{$ip->ip_address} ip successfully updated.",
            "data" => [
                "ip_address" => [
                    "ip_address" => $ip->ip_address,
                    "comment" => $attr["comment"],
                    "user_id" => $ip->user_id,
                    "user" => [
                        "name" => $ip->user->name,
                        "email" => $ip->user->email
                    ]
                ]
            ],
        ]);

        $this->assertDatabaseHas('ip_addresses', [
            "ip_address" => $ip->ip_address,
            "comment" => $attr["comment"],
            "user_id" => $ip->user_id,
        ]);
    }

    /**
     * authenticated user can not update ip address without fill comment
     */
    public function test_authenticated_user_cant_update_ip_comment_without_comment_field(): void
    {
        $signedInUser = User::factory()->create();
        $ip = IpAddress::find(1);

        $attr = [];
        $response = $this->actingAs($signedInUser, 'sanctum')->putJson('api/ip-address/1', $attr);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            "status" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "success" => false,
            "message" => "The comment field is required.",
            "errors" => [
                "comment" => [
                    "The comment field is required."
                ]
            ],
        ]);
    }
}
