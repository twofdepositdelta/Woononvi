<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('report_types')->insert([
            ['name' => 'Comportement inapproprié', 'description' => 'Signalement d\'un comportement inapproprié d\'un passager ou d\'un conducteur.'],
            ['name' => 'Non-respect des horaires', 'description' => 'Signalement d\'un conducteur qui arrive en retard sans prévenir.'],
            ['name' => 'Problèmes de paiement', 'description' => 'Signalement de difficultés rencontrées lors de l\'effectuation d\'un paiement.'],
            ['name' => 'Trajet annulé', 'description' => 'Signalement d\'un trajet annulé sans préavis par le conducteur.'],
            ['name' => 'Problèmes de sécurité', 'description' => 'Signalement d\'une conduite dangereuse ou imprudente.'],
            ['name' => 'Fraude', 'description' => 'Signalement d\'une tentative de fraude ou d\'inexactitude.'],
            ['name' => 'Manque de propreté', 'description' => 'Signalement d\'un véhicule sale ou mal entretenu.'],
            ['name' => 'Inexactitudes des informations de trajet', 'description' => 'Signalement d\'inexactitudes dans les informations affichées.'],
            ['name' => 'Problèmes avec l\'application', 'description' => 'Signalement de bugs ou d\'erreurs dans l\'application.'],
            ['name' => 'Comportement abusif d\'un conducteur', 'description' => 'Signalement d\'un comportement inacceptable de la part d\'un conducteur.'],
        ]);
    }
}
