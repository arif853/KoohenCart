<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@koohen.com'],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ]
        );

        if ($admin->name !== 'Super Admin') {
            $admin->name = 'Super Admin';
            $admin->save();
        }

        if (Role::where('name', 'Super Admin')->exists()) {
            $admin->syncRoles(['Super Admin']);
        }
    }
}
