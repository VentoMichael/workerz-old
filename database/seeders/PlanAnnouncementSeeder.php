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
            'duration' => 5,
            'hight_visibility' => false,
            'priority' => false,
            'directly_visible'=>false,
        ]);
        PlanAnnouncement::create([
            'id' => 2,
            'name' => 'Premium',
            'price' => 1.99,
            'oldprice' => 4.99,
            'duration' => 15,
            'hight_visibility' => true,
            'priority' => true,
            'directly_visible'=>true,
        ]);
        PlanAnnouncement::create([
            'id' => 3,
            'name' => 'Star',
            'price' => 7.99,
            'duration' => 25,
            'hight_visibility' => true,
            'priority' => true,
            'directly_visible'=>true,
        ]);
    }
}
