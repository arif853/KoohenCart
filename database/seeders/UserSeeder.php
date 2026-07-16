<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            $admin->email = 'superadmin@mail.com';
            $admin->email_verified_at = now();
            $admin->password = Hash::make(12345678);
            $admin->remember_token = Str::random(10);
            $admin->save();
        }

        if (Role::where('name', 'Super Admin')->exists()) {
            $admin->syncRoles(['Super Admin']);
        }
    }
}
