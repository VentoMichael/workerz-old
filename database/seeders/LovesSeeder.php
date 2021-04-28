<?php

namespace Database\Seeders;

use App\Models\Loves;
use Illuminate\Database\Seeder;

class LovesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Loves::factory()->count(10)->create();
    }
}
