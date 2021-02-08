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
        StartDate::factory()->count(10)->create();
    }
}
