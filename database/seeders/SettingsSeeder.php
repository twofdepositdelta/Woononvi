<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key' => 'company_name',
                'value' => 'Wononvi',
                'description' => 'Le nom officiel de l\'entreprise'
            ],
            [
                'key' => 'company_logo',
                'value' => 'path/to/default/logo.png', // Changez le chemin vers le logo par défaut
                'description' => 'Le logo de l\'entreprise'
            ],
            [
                'key' => 'company_phone',
                'value' => '+229 12 34 56 78',
                'description' => 'Le numéro de téléphone de l\'entreprise'
            ],
            [
                'key' => 'company_email',
                'value' => 'contact@entreprise.com',
                'description' => 'L\'adresse email de l\'entreprise'
            ],
            [
                'key' => 'company_address',
                'value' => '123 Rue de l\'Exemple, Cotonou, Bénin',
                'description' => 'L\'adresse physique de l\'entreprise'
            ],
            [
                'key' => 'default_language',
                'value' => 'fr',
                'description' => 'La langue par défaut utilisée dans l\'application'
            ],
            [
                'key' => 'timezone',
                'value' => 'Africa/Porto-Novo',
                'description' => 'Le fuseau horaire de l\'entreprise'
            ],
            [
                'key' => 'commission_rate',
                'value' => '10', // Taux de commission par défaut en pourcentage
                'description' => 'Le taux de commission appliqué aux ventes'
            ],
            [
                'key' => 'currency',
                'value' => 'FCFA', // La monnaie utilisée
                'description' => 'La monnaie utilisée dans l\'entreprise'
            ],
        ]);
    }
}
