<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('reports')->insert([
            [
                'user_id' => 1, // Assurez-vous que cet ID existe dans votre table users
                'report_type_id' => 1, // Assurez-vous que cet ID existe dans votre table report_types
                'booking_id' => 1, // ID de réservation
                'description' => 'Le conducteur a eu un comportement inapproprié pendant le trajet.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'report_type_id' => 2,
                'booking_id' => 2, // ID de réservation
                'description' => 'Le conducteur est arrivé avec 30 minutes de retard sans prévenir.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'report_type_id' => 3,
                'booking_id' => 3, // ID de réservation
                'description' => 'Problème lors du paiement via l\'application, la transaction a échoué.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'report_type_id' => 4,
                'booking_id' => 4, // ID de réservation
                'description' => 'Le conducteur a annulé le trajet à la dernière minute.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'report_type_id' => 5,
                'booking_id' => 5, // ID de réservation
                'description' => 'Le conducteur a conduit de manière dangereuse, en dépassant les limites de vitesse.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'report_type_id' => 6,
                'booking_id' => 6, // ID de réservation
                'description' => 'Tentative de fraude lors du paiement, le montant était incorrect.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'report_type_id' => 7,
                'booking_id' => 7, // ID de réservation
                'description' => 'Le véhicule était très sale et mal entretenu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'report_type_id' => 8,
                'booking_id' => 8, // ID de réservation
                'description' => 'Les informations affichées sur le trajet étaient inexactes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'report_type_id' => 9,
                'booking_id' => 9, // ID de réservation
                'description' => 'L\'application a rencontré un bug lors de la réservation.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'report_type_id' => 10,
                'booking_id' => 10, // ID de réservation
                'description' => 'Le conducteur a été agressif durant le trajet.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}