<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'administrator@sendyjoan.my.id',
            'password' => Hash::make('password'),
            'phone_number' => '082244767431',
            'role_id' => 1,
            'user_status_id' => 1,
        ]);
    }
}
