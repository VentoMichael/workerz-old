<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id'=>1,
            'name'=>'Administration, commerce et gestion'
        ]);
        Category::create([
            'id'=>2,
            'name'=>'Les thérapies alternatives'
        ]);
        Category::create([
            'id'=>3,
            'name'=>'Animaux, terre et environnement'
        ]);
        Category::create([
            'id'=>4,
            'name'=>'Informatique et TIC'
        ]);
        Category::create([
            'id'=>5,
            'name'=>'Construction et bâtiment'
        ]);
        Category::create([
            'id'=>6,
            'name'=>'Design, arts et artisanat'
        ]);
        Category::create([
            'id'=>7,
            'name'=>'Éducation et formation'
        ]);
        Category::create([
            'id'=>8,
            'name'=>'Ingénierie'
        ]);
        Category::create([
            'id'=>9,
            'name'=>'Installations et services immobiliers'
        ]);
        Category::create([
            'id'=>10,
            'name'=>'Services financiers'
        ]);
        Category::create([
            'id'=>11,
            'name'=>'Services de garage'
        ]);
        Category::create([
            'id'=>12,
            'name'=>'Coiffure et beauté'
        ]);
        Category::create([
            'id'=>13,
            'name'=>'Soins de santé'
        ]);
        Category::create([
            'id'=>14,
            'name'=>'Patrimoine, culture et bibliothèques'
        ]);
        Category::create([
            'id'=>15,
            'name'=>'Hôtellerie, restauration et tourisme'
        ]);
        Category::create([
            'id'=>16,
            'name'=>'Langues'
        ]);
        Category::create([
            'id'=>17,
            'name'=>'Services juridiques et judiciaires'
        ]);
        Category::create([
            'id'=>18,
            'name'=>'Fabrication et production'
        ]);
        Category::create([
            'id'=>19,
            'name'=>'Arts du spectacle et médias'
        ]);
        Category::create([
            'id'=>20,
            'name'=>'Imprimerie et édition, marketing et publicité'
        ]);
        Category::create([
            'id'=>21,
            'name'=>'Commerces de détails et services à la clientèle'
        ]);
        Category::create([
            'id'=>22,
            'name'=>'Sciences, mathématiques et statistiques'
        ]);
        Category::create([
            'id'=>23,
            'name'=>'Services de sécurité, d\'uniforme et de protection'
        ]);
        Category::create([
            'id'=>24,
            'name'=>'Sciences sociales et religion'
        ]);
        Category::create([
            'id'=>25,
            'name'=>'Travail social et services de soins'
        ]);
        Category::create([
            'id'=>26,
            'name'=>'Sport et loisirs'
        ]);
        Category::create([
            'id'=>27,
            'name'=>'Transport, distribution et logistique'
        ]);
    }
}
