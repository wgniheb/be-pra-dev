<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserStatus::create([
            'name' => 'Active',
        ]);
        UserStatus::create([
            'name' => 'Suspended',
        ]);
    }
}
