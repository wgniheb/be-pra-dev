<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => 1,
            'name' => 'Superadmin',
        ]);
        Role::create([
            'id' => 2,
            'name' => 'Administrator',
        ]);
        Role::create([
            'id' => 3,
            'name' => 'Manajer',
        ]);
        Role::create([
            'id' => 4,
            'name' => 'Officer',
        ]);
    }
}
