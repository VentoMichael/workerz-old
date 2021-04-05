<?php

namespace Database\Seeders;

use App\Models\CatchPhraseAnnouncement;
use Illuminate\Database\Seeder;

class CatchPhraseAnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatchPhraseAnnouncement::create([
            'id'=>1,
            'name'=>'peu commune'
        ]);
        CatchPhraseAnnouncement::create([
            'id'=>2,
            'name'=>'pour réaliser une meilleur affaire'
        ]);
        CatchPhraseAnnouncement::create([
            'id'=>3,
            'name'=>'qui vous convient'
        ]);
        CatchPhraseAnnouncement::create([
            'id'=>4,
            'name'=>'que tout le monde devrait accepter'
        ]);
        CatchPhraseAnnouncement::create([
            'id'=>5,
            'name'=>'indispensable'
        ]);
    }
}
