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
        // Permission For User
        Permission::create([
            'slug' => 'user.modul',
            'name' => 'Modul User',
        ]);
        Permission::create([
            'slug' => 'user.create',
            'name' => 'Create User',
        ]);
        Permission::create([
            'slug' => 'user.index',
            'name' => 'Index User',
        ]);
        Permission::create([
            'slug' => 'user.update',
            'name' => 'Update User',
        ]);
        Permission::create([
            'slug' => 'user.delete',
            'name' => 'Delete User',
        ]);
        Permission::create([
            'slug' => 'user.detail',
            'name' => 'Detail User',
        ]);

        // Permission For Role
        Permission::create([
            'slug' => 'role.modul',
            'name' => 'Modul Role',
        ]);
        Permission::create([
            'slug' => 'role.create',
            'name' => 'Create Role',
        ]);
        Permission::create([
            'slug' => 'role.index',
            'name' => 'Index Role',
        ]);
        Permission::create([
            'slug' => 'role.update',
            'name' => 'Update Role',
        ]);
        Permission::create([
            'slug' => 'role.delete',
            'name' => 'Delete Role',
        ]);
        Permission::create([
            'slug' => 'role.detail',
            'name' => 'Detail Role',
        ]);

        // Permission For Permission
        Permission::create([
            'slug' => 'permission.modul',
            'name' => 'Modul Permission',
        ]);
        Permission::create([
            'slug' => 'permission.create',
            'name' => 'Create Permission',
        ]);
        Permission::create([
            'slug' => 'permission.index',
            'name' => 'Index Permission',
        ]);
        Permission::create([
            'slug' => 'permission.update',
            'name' => 'Update Permission',
        ]);
        Permission::create([
            'slug' => 'permission.delete',
            'name' => 'Delete Permission',
        ]);
        Permission::create([
            'slug' => 'permission.detail',
            'name' => 'Detail Permission',
        ]);

        // Permission For Entity
        Permission::create([
            'slug' => 'entity.modul',
            'name' => 'Modul Entity',
        ]);
        Permission::create([
            'slug' => 'entity.create',
            'name' => 'Create Entity',
        ]);
        Permission::create([
            'slug' => 'entity.index',
            'name' => 'Index Entity',
        ]);
        Permission::create([
            'slug' => 'entity.update',
            'name' => 'Update Entity',
        ]);
        Permission::create([
            'slug' => 'entity.delete',
            'name' => 'Delete Entity',
        ]);
        Permission::create([
            'slug' => 'entity.detail',
            'name' => 'Detail Entity',
        ]);

        // Permission For User Status
        Permission::create([
            'slug' => 'userstatus.create',
            'name' => 'Create User Status',
        ]);
        Permission::create([
            'slug' => 'userstatus.index',
            'name' => 'Index User Status',
        ]);
        Permission::create([
            'slug' => 'userstatus.update',
            'name' => 'Update User Status',
        ]);
        Permission::create([
            'slug' => 'userstatus.delete',
            'name' => 'Delete User Status',
        ]);
        Permission::create([
            'slug' => 'userstatus.detail',
            'name' => 'Detail User Status',
        ]);

        // Permission For User Has Entity
        Permission::create([
            'slug' => 'userhasentity.create',
            'name' => 'Create User Has Entity',
        ]);
        Permission::create([
            'slug' => 'userhasentity.index',
            'name' => 'Index User Has Entity',
        ]);
        Permission::create([
            'slug' => 'userhasentity.update',
            'name' => 'Update User Has Entity',
        ]);
        Permission::create([
            'slug' => 'userhasentity.delete',
            'name' => 'Delete User Has Entity',
        ]);
        Permission::create([
            'slug' => 'userhasentity.detail',
            'name' => 'Detail User Has Entity',
        ]);

        // Permission For Issue Category
        Permission::create([
            'slug' => 'issuecategory.modul',
            'name' => 'Modul Issue Category',
        ]);
        Permission::create([
            'slug' => 'issuecategory.create',
            'name' => 'Create Issue Category',
        ]);
        Permission::create([
            'slug' => 'issuecategory.index',
            'name' => 'Index Issue Category',
        ]);
        Permission::create([
            'slug' => 'issuecategory.update',
            'name' => 'Update Issue Category',
        ]);
        Permission::create([
            'slug' => 'issuecategory.delete',
            'name' => 'Delete Issue Category',
        ]);
        Permission::create([
            'slug' => 'issuecategory.detail',
            'name' => 'Detail Issue Category',
        ]);

        // Permission For Issue Matrix
        Permission::create([
            'slug' => 'issuematrix.modul',
            'name' => 'Modul Issue Matrix',
        ]);
        Permission::create([
            'slug' => 'issuematrix.create',
            'name' => 'Create Issue Matrix',
        ]);
        Permission::create([
            'slug' => 'issuematrix.index',
            'name' => 'Index Issue Matrix',
        ]);
        Permission::create([
            'slug' => 'issuematrix.update',
            'name' => 'Update Issue Matrix',
        ]);
        Permission::create([
            'slug' => 'issuematrix.delete',
            'name' => 'Delete Issue Matrix',
        ]);
        Permission::create([
            'slug' => 'issuematrix.detail',
            'name' => 'Detail Issue Matrix',
        ]);
    }
}
