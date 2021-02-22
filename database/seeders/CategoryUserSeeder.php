<?php

namespace Database\Seeders;

use App\Models\CategoryUser;
use Illuminate\Database\Seeder;

class CategoryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryUser::factory(10)->create();
    }
}
