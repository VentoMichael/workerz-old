<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\LikeUser;
use Illuminate\Database\Seeder;

class LikeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LikeUser::factory()->count(100)->create();
    }
}
