<?php

namespace Database\Seeders;

use App\Models\CatchPhraseAnnouncement;
use App\Models\CatchPhraseUser;
use App\Models\PlanAnnouncement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(CategorySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(PlanUserSeeder::class);
        $this->call(PlanAnnouncementSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoryUserSeeder::class);
        $this->call(WebsiteSeeder::class);
        $this->call(PhoneSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(StartDateSeeder::class);
        $this->call(StartMonthSeeder::class);
        $this->call(StartDateUserSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(AnnouncementCategorySeeder::class);
        $this->call(LovesSeeder::class);
        $this->call(StartDateAnnouncementSeeder::class);
        $this->call(CatchPhraseAnnouncementSeeder::class);
        $this->call(CatchPhraseUserSeeder::class);
    }
}
