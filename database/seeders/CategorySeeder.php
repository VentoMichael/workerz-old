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
            'id' => 1,
            'name' => 'Administration, commerce et gestion',
            'profil' => 'stats.svg',
            'alt' => 'icone de statistiques'
        ]);
        Category::create([
            'id' => 2,
            'name' => 'Les thérapies alternatives',
            'profil' => 'reiki.svg',
            'alt' => 'icone représentant le métier thérapeutique'
        ]);
        Category::create([
            'id' => 3,
            'name' => 'Animaux, terre et environnement',
            'profil' => 'growth.svg',
            'alt' => 'icone représentant l\'environnement'
        ]);
        Category::create([
            'id' => 4,
            'name' => 'Informatique et TIC',
            'profil' => 'technology.svg',
            'alt' => 'icone représentant la technologie'
        ]);
        Category::create([
            'id' => 5,
            'name' => 'Construction et bâtiment',
            'profil' => 'brickwall.svg',
            'alt' => 'icone représentant le métier du bâtiment'
        ]);
        Category::create([
            'id' => 6,
            'name' => 'Design, arts et artisanat',
            'profil' => 'creativity.svg',
            'alt' => 'icone représentant le design'
        ]);
        Category::create([
            'id' => 7,
            'name' => 'Éducation et formation',
            'profil' => 'career.svg',
            'alt' => 'icone représentant l\'éducation'
        ]);
        Category::create([
            'id' => 8,
            'name' => 'Ingénierie',
            'profil' => 'prototype.svg',
            'alt' => 'icone représentant le métier de l\'ingénierie'
        ]);
        Category::create([
            'id' => 9,
            'name' => 'Installations et services immobiliers',
            'profil' => 'manager.svg',
            'alt' => 'icone représentant le métier de l\'immobilier'
        ]);
        Category::create([
            'id' => 10,
            'name' => 'Services financiers',
            'profil' => 'analysis.svg',
            'alt' => 'icone représentant le métier de la finance'
        ]);
        Category::create([
            'id' => 11,
            'name' => 'Services de garage',
            'profil' => 'garage.svg',
            'alt' => 'icone représentant le métier de garagiste'
        ]);
        Category::create([
            'id' => 12,
            'name' => 'Coiffure et beauté',
            'profil' => 'cosmetics.svg',
            'alt' => 'icone représentant le métier de la coiffure'
        ]);
        Category::create([
            'id' => 13,
            'name' => 'Soins de santé',
            'profil' => 'heartbeat.svg',
            'alt' => 'icone représentant le métier des soins de santé'
        ]);
        Category::create([
            'id' => 14,
            'name' => 'Patrimoine, culture et bibliothèques',
            'profil' => 'book.svg',
            'alt' => 'icone représentant une bibliothèque'
        ]);
        Category::create([
            'id' => 15,
            'name' => 'Hôtellerie, restauration et tourisme',
            'profil' => 'travel.svg',
            'alt' => 'icone représentant le métier de l\'hôtellerie'
        ]);
        Category::create([
            'id' => 16,
            'name' => 'Langues',
            'profil' => 'translating.svg',
            'alt' => 'icone représentant le métier d\'apprentissage de langues'
        ]);
        Category::create([
            'id' => 17,
            'name' => 'Services juridiques et judiciaires',
            'profil' => 'auction.svg',
            'alt' => 'icone représentant le métier judiciaire'
        ]);
        Category::create([
            'id' => 18,
            'name' => 'Fabrication et production',
            'profil' => 'production.svg',
            'alt' => 'icone représentant le métier de la fabrication industrielle'
        ]);
        Category::create([
            'id' => 20,
            'name' => 'Imprimerie et édition, marketing et publicité',
            'profil' => 'bullhorn.svg',
            'alt' => 'icone représentant le métier de la publicité et marketing'
        ]);
        Category::create([
            'id' => 21,
            'name' => 'Commerces de détails et services à la clientèle',
            'profil' => 'customer-service.svg',
            'alt' => 'icone représentant le service clientèle'
        ]);
        Category::create([
            'id' => 22,
            'name' => 'Sciences, mathématiques et statistiques',
            'profil' => 'analytics.svg',
            'alt' => 'icone représentant des statistiques'
        ]);
        Category::create([
            'id' => 23,
            'name' => 'Services de sécurité, d\'uniforme et de protection',
            'profil' => 'security-camera.svg',
            'alt' => 'icone représentant le métier de la sécurité'
        ]);
        Category::create([
            'id' => 19,
            'name' => 'Sport et loisirs',
            'profil' => 'sport.svg',
            'alt' => 'icone représentant le métier de sport'
        ]);
        Category::create([
            'id' => 24,
            'name' => 'Transport, distribution et logistique',
            'profil' => 'truck.svg',
            'alt' => 'icone représentant le métier de distribution'
        ]);
    }
}
