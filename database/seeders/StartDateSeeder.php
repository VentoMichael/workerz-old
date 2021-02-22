<?php

namespace Database\Seeders;

use App\Models\StartDate;
use Illuminate\Database\Seeder;

class StartDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StartDate::create([
            'id'=>1,
            'name'=>'Lundi',
        ]);
        StartDate::create([
            'id'=>2,
            'name'=>'Mardi',
        ]);
        StartDate::create([
            'id'=>3,
            'name'=>'Mercredi',
        ]);
        StartDate::create([
            'id'=>4,
            'name'=>'Jeudi',
        ]);
        StartDate::create([
            'id'=>5,
            'name'=>'Vendredi',
        ]);
        StartDate::create([
            'id'=>6,
            'name'=>'Samedi',
        ]);
        StartDate::create([
            'id'=>7,
            'name'=>'Dimanche',
        ]);
    }
}
