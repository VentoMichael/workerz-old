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
            'duration' => 5,
            'hight-visibility' => false,
            'priority' => false,
            'directly_visible'=>false,
        ]);
        PlanUser::create([
            'id' => 2,
            'name' => 'Premium',
            'price' => 4.99,
            'oldprice' => 6.99,
            'duration' => 15,
            'hight-visibility' => true,
            'priority' => true,
            'directly_visible'=>true,
        ]);
        PlanUser::create([
            'id' => 3,
            'name' => 'Star',
            'price' => 9.99,
            'duration' => 25,
            'hight-visibility' => true,
            'priority' => true,
            'directly_visible'=>true,
        ]);
    }
}
