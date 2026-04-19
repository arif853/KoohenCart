<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissionNames = [];
        foreach (Route::getRoutes()->getRoutes() as $route) {
            foreach ($route->gatherMiddleware() as $middleware) {
                if (!str_starts_with($middleware, 'permission:')) {
                    continue;
                }

                $raw = substr($middleware, strlen('permission:'));
                $parts = preg_split('/\|/', $raw) ?: [];

                foreach ($parts as $part) {
                    $name = strtolower(trim(explode(',', $part)[0]));
                    if ($name !== '') {
                        $permissionNames[] = $name;
                    }
                }
            }
        }

        $permissionNames = array_values(array_unique($permissionNames));

        $permissions = [];
        foreach ($permissionNames as $permissionName) {
            $permissions[] = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);
        }

        $roleSuperAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $roleSuperAdmin->syncPermissions($permissions);

        $admin = User::where('email', 'admin@koohen.com')->first();
        if ($admin) {
            $admin->syncRoles(['Super Admin']);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
