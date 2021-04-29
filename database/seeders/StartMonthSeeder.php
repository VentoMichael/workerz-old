<?php

namespace Database\Seeders;

use App\Models\StartMonth;
use Illuminate\Database\Seeder;

class StartMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StartMonth::create([
            'id'=>1,
            'name'=>'Janvier',
        ]);
        StartMonth::create([
            'id'=>2,
            'name'=>'Février',
        ]);
        StartMonth::create([
            'id'=>3,
            'name'=>'Mars',
        ]);
        StartMonth::create([
            'id'=>4,
            'name'=>'Avril',
        ]);
        StartMonth::create([
            'id'=>5,
            'name'=>'Mai',
        ]);
        StartMonth::create([
            'id'=>6,
            'name'=>'Juin',
        ]);
        StartMonth::create([
            'id'=>7,
            'name'=>'Juillet',
        ]);
        StartMonth::create([
            'id'=>8,
            'name'=>'Août',
        ]);
        StartMonth::create([
            'id'=>9,
            'name'=>'Septembre',
        ]);
        StartMonth::create([
            'id'=>10,
            'name'=>'Octobre',
        ]);
        StartMonth::create([
            'id'=>11,
            'name'=>'Novembre',
        ]);
        StartMonth::create([
            'id'=>12,
            'name'=>'Décembre',
        ]);
    }
}
