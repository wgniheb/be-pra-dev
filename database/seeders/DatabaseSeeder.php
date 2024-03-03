<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\EntitySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\UserStatusSeeder;
use Database\Seeders\IssueMatrixSeeder;
use Database\Seeders\IssueCategorySeeder;
use Database\Seeders\StakeholderKuadranSeeder;

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
        $this->call(IssueCategorySeeder::class);
        $this->call(IssueMatrixSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StakeholderCategorySeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(StakeholderKuadranSeeder::class);
    }
}
