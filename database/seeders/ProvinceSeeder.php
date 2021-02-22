<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'id' => 1,
            'name' => 'Anvers'
        ]);
        Province::create([
            'id' => 2,
            'name' => 'Flandre-Occidentale'
        ]);
        Province::create([
            'id' => 3,
            'name' => 'Flandre-Orientale'
        ]);
        Province::create([
            'id' => 4,
            'name' => 'Hainaut'
        ]);
        Province::create([
            'id' => 5,
            'name' => 'Liège'
        ]);
        Province::create([
            'id' => 6,
            'name' => 'Limbourg'
        ]);
        Province::create([
            'id' => 7,
            'name' => 'Luxembourg'
        ]);
        Province::create([
            'id' => 8,
            'name' => 'Namur'
        ]);
        Province::create([
            'id' => 9,
            'name' => 'Brabant flamand'
        ]);
        Province::create([
            'id' => 10,
            'name' => 'Brabant wallon'
        ]);
        Province::create([
            'id' => 11,
            'name' => 'Bruxelles'
        ]);
    }
}
