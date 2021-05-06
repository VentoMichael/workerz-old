<?php

namespace Database\Seeders;

use App\Models\ProvinceUser;
use Illuminate\Database\Seeder;

class ProvinceUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProvinceUser::factory(10)->create();

    }
}
