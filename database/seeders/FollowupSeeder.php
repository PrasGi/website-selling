<?php

namespace Database\Seeders;

use App\Models\Followup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Followup::create([
            'name' => 'Followup 1',
            'address' => 'Address 1',
            'phone_number' => '081234567890',
            'total' => 0,
            'user_id' => 2,
        ]);

        Followup::create([
            'name' => 'Followup 2',
            'address' => 'Address 2',
            'phone_number' => '081234567891',
            'total' => 0,
            'user_id' => 2,
        ]);
    }
}
