<?php

namespace Database\Seeders;

use App\Models\Reclamation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReclamationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reclamation::create([
            'user_id' => 3,
            'booking_id' => 1,
            'message' => 'Le conducteur était en retard de 30 minutes.',
            'statut' => 'en_attente',
        ]);

        Reclamation::create([
            'user_id' => 2,
            'booking_id' => 2,
            'message' => 'Le passager ne s’est jamais présenté.',
            'statut' => 'en_cours',
        ]);

        Reclamation::create([
            'user_id' => 4,
            'booking_id' => 3,
            'message' => 'Je n’arrive pas à accéder à mes réservations.',
            'statut' => 'en_attente',
        ]);
    }

}
