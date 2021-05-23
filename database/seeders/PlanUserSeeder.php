<?php

namespace Database\Seeders;

use App\Models\PlanUser;
use Illuminate\Database\Seeder;

class PlanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanUser::create([
            'id' => 1,
            'name' => 'Free',
            'price' => 0,
            'duration' => 7,
            'hight_visibility' => false,
            'priority' => false,
            'more_visible'=>false,
        ]);
        PlanUser::create([
            'id' => 2,
            'name' => 'Premium',
            'price' => 10.99,
            'oldprice' => 15.99,
            'duration' => 30,
            'hight_visibility' => true,
            'priority' => true,
            'more_visible'=>true,
        ]);
        PlanUser::create([
            'id' => 3,
            'name' => 'Star',
            'price' => 34.99,
            'duration' => 90,
            'hight_visibility' => true,
            'priority' => true,
            'more_visible'=>true,
        ]);
    }
}
