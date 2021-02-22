<?php

namespace Database\Seeders;

use App\Models\StartDateAnnouncement;
use Illuminate\Database\Seeder;

class StartDateAnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StartDateAnnouncement::factory(10)->create();
    }
}
