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
                'titre' => 'Wɔōnonvi se lance officiellement à Cotonou et Lomé',
                'slug' => Str::slug('Wɔōnonvi se lance officiellement à Cotonou et Lomé'),
                'extract' => 'La mobilité change de visage à Cotonou et Lomé avec l’arrivée de Wɔōnonvi.',
                'description' => 'C’est officiel : Wɔōnonvi, la nouvelle application de covoiturage, démarre ses activités à Cotonou 🇧🇯 et à Lomé 🇹🇬. Elle offre une solution de transport accessible, économique et communautaire dans les grandes villes d’Afrique de l’Ouest.',
                'image_url' => $imageBasePath . '01.jpg',
                'type_new_id' => 3, // Lancement
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Grand-Popo, Abomey-Calavi et Porto-Novo rejoignent Wɔōnonvi',
                'slug' => Str::slug('Grand-Popo, Abomey-Calavi et Porto-Novo rejoignent Wɔōnonvi'),
                'extract' => 'De nouvelles villes béninoises adoptent le covoiturage grâce à Wɔōnonvi.',
                'description' => 'Wɔōnonvi étend ses services à Grand-Popo, Abomey-Calavi et Porto-Novo. Cette expansion vise à faciliter les déplacements dans le sud du Bénin avec des trajets partagés, sûrs et moins coûteux.',
                'image_url' => $imageBasePath . '02.jpg',
                'type_new_id' => 3, // Lancement
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Lomé, Kara et Sokodé : le Togo découvre Wɔōnonvi',
                'slug' => Str::slug('Lomé, Kara et Sokodé : le Togo découvre Wɔōnonvi'),
                'extract' => 'Wɔōnonvi démarre fort au Togo avec une présence à Lomé, Kara et Sokodé.',
                'description' => 'L’application de covoiturage Wɔōnonvi s’implante désormais dans plusieurs villes togolaises. Avec son modèle solidaire, elle connecte les voyageurs à moindre coût, tout en valorisant la proximité et la sécurité.',
                'image_url' => $imageBasePath . '03.jpg',
                'type_new_id' => 3, // Lancement
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Wɔōnonvi : une nouvelle ère pour les trajets urbains au Bénin et Togo',
                'slug' => Str::slug('Wɔōnonvi : une nouvelle ère pour les trajets urbains au Bénin et Togo'),
                'extract' => 'Une alternative moderne au transport classique dans les grandes villes.',
                'description' => 'Fini les embouteillages solitaires et les coûts élevés ! Avec Wɔōnonvi, le covoiturage devient une option simple, rapide et conviviale pour les habitants de Cotonou, Lomé, Calavi, Sokodé et au-delà.',
                'image_url' => $imageBasePath . '01.png',
                'type_new_id' => 3, // Innovations
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Le covoiturage devient plus simple avec Wɔōnonvi',
                'slug' => Str::slug('Le covoiturage devient plus simple avec Wɔōnonvi'),
                'extract' => 'L’application pensée pour faciliter vos déplacements quotidiens.',
                'description' => 'Téléchargez l’application Wɔōnonvi et trouvez ou proposez un trajet en quelques clics. Une solution pensée pour les habitants du Bénin et du Togo à la recherche d’alternatives fiables, économiques et pratiques.',
                'image_url' => $imageBasePath . '02.png',
                'type_new_id' => 3, // Conseils
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titre' => 'Voyager autrement : la vision de Wɔōnonvi',
                'slug' => Str::slug('Voyager autrement : la vision de Wɔōnonvi'),
                'extract' => 'Wɔōnonvi, c’est plus qu’un trajet. C’est un projet de société.',
                'description' => 'En misant sur le partage, la sécurité et l’accessibilité, Wɔōnonvi entend transformer la manière dont nous vivons nos déplacements urbains en Afrique de l’Ouest. La plateforme mise sur les valeurs humaines pour réinventer la mobilité.',
                'image_url' => $imageBasePath . '03.png',
                'type_new_id' => 3, // Vision / Philosophie
                'published' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
