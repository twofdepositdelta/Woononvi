<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('faq_types')->insert([
            [
                'name' => 'Passager',
                'description' => 'Questions relatives à la création et à la gestion de votre compte utilisateur.',
            ],
            [
                'name' => 'Conducteur',
                'description' => 'Questions sur les méthodes de paiement acceptées et les facturations.',
            ],

        ]);
    }
}
