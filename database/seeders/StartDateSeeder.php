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
            'pre_selected'=>true,
        ]);
        StartDate::create([
            'id'=>2,
            'name'=>'Mardi',
            'pre_selected'=>true,
        ]);
        StartDate::create([
            'id'=>3,
            'name'=>'Mercredi',
            'pre_selected'=>true,
        ]);
        StartDate::create([
            'id'=>4,
            'name'=>'Jeudi',
            'pre_selected'=>true,
        ]);
        StartDate::create([
            'id'=>5,
            'name'=>'Vendredi',
            'pre_selected'=>true,
        ]);
        StartDate::create([
            'id'=>6,
            'name'=>'Samedi',
            'pre_selected'=> false
        ]);
        StartDate::create([
            'id'=>7,
            'name'=>'Dimanche',
            'pre_selected'=> false
        ]);
    }
}
