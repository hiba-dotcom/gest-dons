<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['adherant', 'admin', 'président', 'imam'];

        $users = [];

        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'firstname' => fake()->firstName,
                'lastname' => fake()->lastName,
                'birthDate' => fake()->date('Y-m-d', '2005-01-01'),
                'phone' => fake()->phoneNumber,
                'role' => RoleEnum::from('adherant'),
                'email' => fake()->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'), 
            ];
        }

        DB::table('users')->insert($users);
    }
    }
