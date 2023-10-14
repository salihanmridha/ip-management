<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IpAddress>
 */
class IpAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id');

        return [
            'comment'         => fake()->sentence(2),
            'ip_address' => fake()->ipv4,
            'user_id'       => function() use ($userIds) {
                return $userIds->random();
            },
        ];
    }
}
