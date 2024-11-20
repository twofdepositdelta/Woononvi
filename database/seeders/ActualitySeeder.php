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
                'titre' => 'Wononvi, première plateforme de covoiturage au Bénin',
                'slug' => Str::slug('Wononvi, première plateforme de covoiturage au Bénin'),
                'description' => 'Découvrez comment Wononvi révolutionne la mobilité au Bénin avec sa plateforme innovante et accessible à tous.',
                'image_url' => $imageBasePath . '01.jpg',
                'type_new_id' => 3, // ID pour "Lancement"
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Covoiturage en Afrique : Wononvi montre la voie',
                'slug' => Str::slug('Covoiturage en Afrique : Wononvi montre la voie'),
                'description' => 'Avec son approche centrée sur la communauté, Wononvi offre une solution pratique et économique pour les déplacements en Afrique.',
                'image_url' => $imageBasePath . '02.jpg',
                'type_new_id' => 3, // ID pour "Innovations"
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Pourquoi choisir Wononvi pour vos trajets quotidiens ?',
                'slug' => Str::slug('Pourquoi choisir Wononvi pour vos trajets quotidiens ?'),
                'description' => 'Découvrez les avantages uniques de Wononvi : sécurité, convivialité et économies pour vos déplacements.',
                'image_url' => $imageBasePath . '03.jpg',
                'type_new_id' => 3, // ID pour "Conseils"
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);


    }
}