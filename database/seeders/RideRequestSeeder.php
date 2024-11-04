<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RideRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('ride_requests')->insert([
            [
                'departure' => 'Cotonou',
                'destination' => 'Porto-Novo',
                'preferred_time' => Carbon::now()->addHours(2), // 2 heures à partir de maintenant
                'preferred_amount' => 3,
                'status' => 'pending',
                'passenger_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'departure' => 'Parakou',
                'destination' => 'Natitingou',
                'preferred_time' => Carbon::now()->addHours(1), // 1 heure à partir de maintenant
                'preferred_amount' => 2,
                'status' => 'responded',
                'passenger_id' => 2, // Assurez-vous que l'utilisateur avec l'ID 2 existe
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'departure' => 'Porto-Novo',
                'destination' => 'Cotonou',
                'preferred_time' => Carbon::now()->addHours(3), // 3 heures à partir de maintenant
                'preferred_amount' => 4,
                'status' => 'completed',
                'passenger_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Ajoutez d'autres données si nécessaire
        ]);
    }
}
