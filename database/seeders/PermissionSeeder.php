<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'slug' => 'create.user',
            'name' => 'Create User',
        ]);
        Permission::create([
            'slug' => 'read.user',
            'name' => 'Read User',
        ]);
        Permission::create([
            'slug' => 'update.user',
            'name' => 'Update User',
        ]);
        Permission::create([
            'slug' => 'delete.user',
            'name' => 'Delete User',
        ]);
        Permission::create([
            'slug' => 'detail.user',
            'name' => 'Detail User',
        ]);
    }
}
