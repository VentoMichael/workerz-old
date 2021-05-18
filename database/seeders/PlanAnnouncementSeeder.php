<?php

namespace Database\Seeders;

use App\Models\PlanAnnouncement;
use Illuminate\Database\Seeder;

class PlanAnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanAnnouncement::create([
            'id' => 1,
            'name' => 'Free',
            'price' => 0,
            'duration' => 7,
            'hight_visibility' => false,
            'priority' => false,
            'more_visible'=>false,
        ]);
        PlanAnnouncement::create([
            'id' => 2,
            'name' => 'Premium',
            'price' => 2.99,
            'oldprice' => 3.99,
            'costMonthly' => 5.98,
            'duration' => 15,
            'hight_visibility' => true,
            'priority' => true,
            'more_visible'=>true,
        ]);
        PlanAnnouncement::create([
            'id' => 3,
            'name' => 'Star',
            'price' => 7.99,
            'costMonthly' => 7.99,
            'duration' => 30,
            'hight_visibility' => true,
            'priority' => true,
            'more_visible'=>true,
        ]);
    }
}
