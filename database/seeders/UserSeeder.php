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
        User::create([
            'username' => 'admin1',
            'password' => bcrypt('password^'),
            'role_id' => 1,
            'status' => 'active'
        ]);
        User::create([
            'username' => 'admin2',
            'password' => bcrypt('password^'),
            'role_id' => 1,
            'status' => 'active'
        ]);
        User::create([
            'username' => 'admin3',
            'password' => bcrypt('password^'),
            'role_id' => 1,
            'status' => 'active'
        ]);

        User::create([
            'username' => 'sales1',
            'password' => bcrypt('password'),
            'email' => 'sales1@gmail.com',
            'phone_number' => '081234567890',
            'address' => fake()->address(),
            'full_name' => 'Full name sales 1',
            'status' => 'active',
            'role_id' => 2,
        ]);

        User::create([
            'username' => 'sales2',
            'password' => bcrypt('password'),
            'email' => 'sales2@gmail.com',
            'phone_number' => '081234567891',
            'address' => fake()->address(),
            'full_name' => 'Full name sales 2',
            'status' => 'active',
            'role_id' => 2,
        ]);

        User::create([
            'username' => 'sales3',
            'password' => bcrypt('password'),
            'email' => 'sales3@gmail.com',
            'phone_number' => '081234567892',
            'address' => fake()->address(),
            'full_name' => 'Full name sales 3',
            'status' => 'active',
            'role_id' => 2,
        ]);

        User::create([
            'username' => 'sales4',
            'password' => bcrypt('password'),
            'email' => 'sales4@gmail.com',
            'phone_number' => '081234567893',
            'address' => fake()->address(),
            'full_name' => 'Full name sales 4',
            'status' => 'non active',
            'role_id' => 2,
        ]);
    }
}
