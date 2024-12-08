<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define Permissions
        $permissions = [
            'view_contacts', 'add_contacts', 'update_contacts', 'delete_contacts',
            'view_users', 'add_users', 'update_users', 'delete_users',
            'view_roles','add_roles','update_roles','delete_roles',
            'view_leads','add_leads','update_leads','delete_leads','view_leads_generator',
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Define Roles
        $roles = ['Admin', 'Manager', 'User', 'Customer'];

        // Create Roles
        foreach ($roles as $role) {
            Role::findOrCreate($role);
        }

        // Retrieve Roles
        $rolesMap = Role::whereIn('name', $roles)->get()->keyBy('name');
        $admin = $rolesMap->get('Admin');
        $manager = $rolesMap->get('Manager');
        $user = $rolesMap->get('User');
        $customer = $rolesMap->get('Customer');

        // Assign Permissions to Roles
        $adminPermissions = $permissions; // Full access for Admin
        $admin->syncPermissions($adminPermissions);

        $managerPermissions = [
            'view_contacts',
        ];
        $manager->syncPermissions($managerPermissions);
        $customer->syncPermissions($managerPermissions);

        $userPermissions = ['view_contacts', 'view_users'];
        $user->syncPermissions($userPermissions);
    }
}
