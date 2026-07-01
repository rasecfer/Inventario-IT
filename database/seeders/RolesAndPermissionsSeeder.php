<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            'view_department',
            'edit_department',
            'create_department',

            'view_employee',
            'edit_employee',
            'create_employee',

            'view_lease',
            'edit_lease',
            'create_lease',

            'view_brand',
            'edit_brand',
            'create_brand',

            'view_model',
            'edit_model',
            'create_model',

            'view_classification',
            'edit_classification',
            'create_classification',

            'view_device',
            'edit_device',
            'create_device',

            'view_assignment',
            'print_assignment',
            'creat_assignment',

            'view_release',
            'print_release',
            'create_release',

            'create_disposal',

            'edit_setup',
        ];

        // Create Admin role
        $adminRole = Role::create(['name' => 'admin']);

        // Create permissions
        foreach ($permissions as $permission) {
            $newPermission = Permission::create(['name' => $permission]);

            // Assign permission to admin
            $adminRole->givePermissionTo($newPermission);
        }

        // Assign role to admin user
        $user = User::findOrFail(1);
        $user->assignRole($adminRole);

    }
}
