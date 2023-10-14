<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "Salihan Mridha",
            "email" => "salihanmridha@gmail.com",
            "password" => bcrypt("12345678")
        ]);

        User::factory()->create([
            "name" => "Admin User",
            "email" => "admin@email.com",
            "password" => bcrypt("12345678")
        ]);

        User::factory(3)->create();
    }
}
