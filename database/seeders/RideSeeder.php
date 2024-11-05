<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rides')->insert([
            [
                'departure' => 'Cotonou',
                'destination' => 'Porto-Novo',
                'departure_time' => Carbon::now()->addDays(1), // Heure de départ prévue
                'available_seats' => 3,
                'price_per_km' => 1000,
                'is_nearby_ride' => true,
                'status' => 'active',
                'driver_id' => 1, // Assurez-vous que cet ID existe dans votre table users
               'commission_rate'=>10,
                'created_at' => Carbon::now()->subYear(), // Date de création d'un an passé
                'updated_at' => now(),
            ],
            [
                'departure' => 'Ouidah',
                'destination' => 'Cotonou',
                'departure_time' => Carbon::now()->addDays(2), // Heure de départ prévue
                'available_seats' => 2,
                'price_per_km' => 800,
                'is_nearby_ride' => false,
                'status' => 'pending',
                'driver_id' => 2, // Assurez-vous que cet ID existe dans votre table users
               'commission_rate'=>10,
                'created_at' => Carbon::now()->subYear(), // Date de création d'un an passé
                'updated_at' => now(),
            ],
            [
                'departure' => 'Parakou',
                'destination' => 'Natitingou',
                'departure_time' => Carbon::now()->addDays(3), // Heure de départ prévue
                'available_seats' => 4,
                'price_per_km' => 1200,
                'is_nearby_ride' => true,
                'status' => 'completed',
                'driver_id' => 3, // Assurez-vous que cet ID existe dans votre table users
               'commission_rate'=>15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'departure' => 'Dassa-Zoumé',
                'destination' => 'Abomey',
                'departure_time' => Carbon::now()->addDays(4), // Heure de départ prévue
                'available_seats' => 5,
                'price_per_km' => 1500,
                'is_nearby_ride' => false,
                'status' => 'cancelled',
                'driver_id' => 1, // Assurez-vous que cet ID existe dans votre table users
                'commission_rate'=>5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'departure' => 'Cotonou',
                'destination' => 'Bohicon',
                'departure_time' => Carbon::now()->addDays(5), // Heure de départ prévue
                'available_seats' => 1,
                'price_per_km' => 900,
                'is_nearby_ride' => true,
                'status' => 'suspend',
                'driver_id' => 2, // Assurez-vous que cet ID existe dans votre table users
                'commission_rate'=>10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
