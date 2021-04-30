<?php

namespace Database\Seeders;

use App\Models\CatchPhraseUser;
use Illuminate\Database\Seeder;

class CatchPhraseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatchPhraseUser::create([
            'id'=>1,
            'name'=>' par excellence'
        ]);
        CatchPhraseUser::create([
            'id'=>2,
            'name'=>', le meilleur dans son domaine'
        ]);
        CatchPhraseUser::create([
            'id'=>3,
            'name'=>' qui vous faut'
        ]);
        CatchPhraseUser::create([
            'id'=>4,
            'name'=>' qui a du temps pour vous'
        ]);
        CatchPhraseUser::create([
            'id'=>5,
            'name'=>' qui sera aussi rapide que professionnel'
        ]);
    }
}
