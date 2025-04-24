<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
USE App\Helpers\FrontHelper;

class ActualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer le chemin de base des images via le helper
        $imageBasePath = FrontHelper::getEnvFolder() . 'storage/front/assets/img/blog/';

        DB::table('actualities')->insert([
            [
                'titre' => 'Wòónɔ̀ví, première plateforme de covoiturage au Bénin',
                'slug' => Str::slug('Wòónɔ̀ví, première plateforme de covoiturage au Bénin'),
                'description' => 'Découvrez comment Wòónɔ̀ví révolutionne la mobilité au Bénin avec sa plateforme innovante et accessible à tous.',
                'image_url' => $imageBasePath . '02.jpg',
                'type_new_id' => 3, // ID pour "Lancement"
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Covoiturage en Afrique : Wòónɔ̀ví montre la voie',
                'slug' => Str::slug('Covoiturage en Afrique : Wòónɔ̀ví montre la voie'),
                'description' => 'Avec son approche centrée sur la communauté, Wòónɔ̀ví offre une solution pratique et économique pour les déplacements en Afrique.',
                'image_url' => $imageBasePath . '02.jpg',
                'type_new_id' => 3, // ID pour "Innovations"
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Pourquoi choisir Wòónɔ̀ví pour vos trajets quotidiens ?',
                'slug' => Str::slug('Pourquoi choisir Wòónɔ̀ví pour vos trajets quotidiens ?'),
                'description' => 'Découvrez les avantages uniques de Wòónɔ̀ví : sécurité, convivialité et économies pour vos déplacements.',
                'image_url' => $imageBasePath . '03.jpg',
                'type_new_id' => 3, // ID pour "Conseils"
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);


    }
}
