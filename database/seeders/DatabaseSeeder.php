<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\EntitySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\UserStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserStatusSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(EntitySeeder::class);
    }
}
