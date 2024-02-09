<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\RoleHasPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $intPermission = Permission::count();
        for ($i = 1; $i <= $intPermission; $i++) {
            RoleHasPermission::create([
                'role_id' => 1,
                'permission_id' => $i,
            ]);
        }
    }
}
