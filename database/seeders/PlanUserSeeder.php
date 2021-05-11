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
            'duration' => 1,
            'hight_visibility' => false,
            'priority' => false,
            'more_visible'=>false,
        ]);
        PlanUser::create([
            'id' => 2,
            'name' => 'Premium',
            'price' => 24.99,
            'costMonthly' => 8.33,
            'oldprice' => 29.99,
            'duration' => 3,
            'hight_visibility' => true,
            'priority' => true,
            'more_visible'=>true,
        ]);
        PlanUser::create([
            'id' => 3,
            'name' => 'Star',
            'price' => 79.99,
            'costMonthly' => 6.67,
            'duration' => 12,
            'hight_visibility' => true,
            'priority' => true,
            'more_visible'=>true,
        ]);
    }
}
