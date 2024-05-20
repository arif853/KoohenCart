<?php

namespace Database\Seeders;

use App\Models\Contactinfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contactinfo::create([
            'phone' => '014785369',
            'whatsapp' => '0147853692',
            'email' => 'mail@email.com',
            'address' => 'Youraddresshere',
            'officehour' => 'Sat - Thu , 10AM to 6PM',
        ]);
    }
}
