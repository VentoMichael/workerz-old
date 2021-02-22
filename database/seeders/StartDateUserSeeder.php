<?php

namespace Database\Seeders;

use App\Models\StartDateUser;
use Illuminate\Database\Seeder;

class StartDateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StartDateUser::factory(10)->create();
    }
}
