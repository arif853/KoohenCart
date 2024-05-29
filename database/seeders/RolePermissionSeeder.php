<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard view',
            'dashboard edit',
            'product create',
            'product view',
            'product edit',
            'product delete',
            'admin create',
            'admin view',
            'admin edit',
            'admin delete',
            'role create',
            'role view',
            'role edit',
            'role delete',
            'view permission',
            'view permission',
            'create permission',
            'update permission',
            'delete permission',
        ];

        $roleSuperAdmin = Role::first();
       
        for ($i = 0; $i < count($permissions); $i++) {
            $permission = Permission::create(['name' => $permissions[$i], 'guard_name' => 'web']);
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);
        }

        // Assign super admin role permission to superadmin user
        $admin = User::where('name', 'superadmin')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }
        
    }
}
