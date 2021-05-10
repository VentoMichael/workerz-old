<?php

namespace Database\Seeders;

use App\Models\LikeAnnouncement;
use Illuminate\Database\Seeder;

class LikeAnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LikeAnnouncement::factory()->count(100)->create();
    }
}
