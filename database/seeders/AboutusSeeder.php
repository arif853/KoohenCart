<?php

namespace Database\Seeders;

use App\Models\Aboutus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aboutus::create([
            'title' => 'We are Building The Destination For Getting Things Done ',
            'description' => 'loreWomans they he gathered found forgot he fondly lone, in a een he shades control,
                by memory loathed this hall awake he revel concubines to. Nor reverie feere nor olden of mirthful mothernot harolds.
                Not his that chaste is soul time pomp native. Fabled heralds ever taste whilome noontide native.'
        ]);
    }
}
