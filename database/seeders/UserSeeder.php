<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@koohen.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$12$LYwVhmz7qzsHVZ7YrDhXnuDsLIJ7WvgJitmJ9rVjj8Hs84Wm9Tgxy', // 12345678
        //     'remember_token' => Str::random(10),
        // ]);
        $admin  = User::where('name','Super Admin')->first();
        if(is_null($admin)){
            $admin = new User();
            $admin->name = 'Super Admin';
            $admin->email = 'admin@koohen.com';
            $admin->email_verified_at = now();
            $admin->password = Hash::make(12345678);
            $admin->remember_token = Str::random(10);
            $admin->save();
        }
    }
}
