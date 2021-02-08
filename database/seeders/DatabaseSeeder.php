<?php

namespace Database\Seeders;

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
        $this->call(LocationSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(StartDateSeeder::class);
        $this->call(UserRoleSeeder::class);
    }
}
