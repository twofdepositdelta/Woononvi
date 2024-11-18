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
                'titre' => 'Nouvelle version disponible',
                'slug' => Str::slug('Nouvelle version disponible'),
                'description' => 'Découvrez la dernière mise à jour avec de nouvelles fonctionnalités.',
                'image_url' => $imageBasePath . '01.jpg', // chemin simplifié avec '01.jp'
                'type_new_id' => 3, // ID de "mise à jour"
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Code promo spécial week-end',
                'slug' => Str::slug('Code promo spécial week-end'),
                'description' => 'Utilisez le code WEEKEND20 pour obtenir 20% de réduction.',
                'image_url' => $imageBasePath . '02.jpg', // chemin simplifié avec '02.jp'
                'type_new_id' => 3, // ID de "promotion"
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Conseils de sécurité',
                'slug' => Str::slug('Conseils de sécurité'),
                'description' => 'Pensez à partager votre trajet avec un proche pour plus de sécurité.',
                'image_url' => $imageBasePath . '03.jpeg', // chemin simplifié avec '03.jp'
                'type_new_id' => 3, // ID de "sécurité"
                'published' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Les grandes tendances du covoiturage au Bénin',
                'slug' => Str::slug('Les grandes tendances du covoiturage au Bénin'),
                'description' => 'Découvrez les tendances du covoiturage et son adoption au Bénin.',
                'image_url' => $imageBasePath . '04.jpg', // chemin simplifié avec '04.jp'
                'type_new_id' => 3, // ID de "actualité"
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

    }
}