<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actualities')->insert([
            [
                'titre' => 'Nouvelle version disponible',
                'slug'=>Str::slug('Nouvelle version disponible'),
                'description' => 'Découvrez la dernière mise à jour avec de nouvelles fonctionnalités.',
                'image_url' => '/images/update.png',
                'type_new_id' => 1, // ID de "mise à jour"
                 'published'=> true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Code promo spécial week-end',
                'slug'=>Str::slug('Code promo spécial week-end'),
                'description' => 'Utilisez le code WEEKEND20 pour obtenir 20% de réduction.',
                'image_url' => '/images/promo.png',
                'type_new_id' => 2, // ID de "promotion"
                 'published'=> true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Conseils de sécurité',
                'slug'=>Str::slug('Conseils de sécurité'),
                'description' => 'Pensez à partager votre trajet avec un proche pour plus de sécurité.',
                'image_url' => '/images/security.png',
                'type_new_id' => 3, // ID de "sécurité"
                'published'=> false,
                'created_at' => now(),
                'updated_at' => now()
            ],
           
        ]);
    }
}
