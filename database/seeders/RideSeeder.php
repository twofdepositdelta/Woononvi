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
                'numero_ride' => random_int(100000, 999999),
                'departure' => 'Cotonou',
                'destination' => 'Porto-Novo',
                'departure_time' => Carbon::now()->addDays(1),
                'available_seats' => 3,
                'price_per_km' => 1000,
                'latitude' => 6.3656,  // Latitude de départ (exemple)
                'longitude' => 2.4188, // Longitude de départ (exemple)
                'distance_travelled' => 0,  // Pas encore de distance parcourue
                'passenger_count' => 0, // Aucune place réservée pour l'instant
                'is_nearby_ride' => true,
                'status' => 'active',
                'driver_id' => 1,
                'commission_rate' => 10,
                'created_at' => Carbon::now()->subYear(),
                'updated_at' => now(),
            ],
            [
                'numero_ride' => random_int(100000, 999999),
                'departure' => 'Ouidah',
                'destination' => 'Cotonou',
                'departure_time' => Carbon::now()->addDays(2),
                'available_seats' => 2,
                'price_per_km' => 800,
                'latitude' => 6.3585,  // Latitude de départ (exemple)
                'longitude' => 2.0656, // Longitude de départ (exemple)
                'distance_travelled' => 0,  // Pas encore de distance parcourue
                'passenger_count' => 0, // Aucune place réservée pour l'instant
                'is_nearby_ride' => false,
                'status' => 'pending',
                'driver_id' => 2,
                'commission_rate' => 10,
                'created_at' => Carbon::now()->subYear(),
                'updated_at' => now(),
            ],
            [
                'numero_ride' => random_int(100000, 999999),
                'departure' => 'Parakou',
                'destination' => 'Natitingou',
                'departure_time' => Carbon::now()->addDays(3),
                'available_seats' => 4,
                'price_per_km' => 1200,
                'latitude' => 9.3403,  // Latitude de départ (exemple)
                'longitude' => 2.6292, // Longitude de départ (exemple)
                'distance_travelled' => 10000, // Distance parcourue (exemple)
                'passenger_count' => 2, // Deux passagers réservés
                'is_nearby_ride' => true,
                'status' => 'completed',
                'driver_id' => 3,
                'commission_rate' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_ride' => random_int(100000, 999999),
                'departure' => 'Dassa-Zoumé',
                'destination' => 'Abomey',
                'departure_time' => Carbon::now()->addDays(4),
                'available_seats' => 5,
                'price_per_km' => 1500,
                'latitude' => 7.4294,  // Latitude de départ (exemple)
                'longitude' => 2.4531, // Longitude de départ (exemple)
                'distance_travelled' => 0, // Pas encore de distance parcourue
                'passenger_count' => 0, // Aucune place réservée pour l'instant
                'is_nearby_ride' => false,
                'status' => 'cancelled',
                'driver_id' => 1,
                'commission_rate' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_ride' => random_int(100000, 999999),
                'departure' => 'Cotonou',
                'destination' => 'Bohicon',
                'departure_time' => Carbon::now()->addDays(5),
                'available_seats' => 1,
                'price_per_km' => 900,
                'latitude' => 6.3524,  // Latitude de départ (exemple)
                'longitude' => 2.0547, // Longitude de départ (exemple)
                'distance_travelled' => 0, // Pas encore de distance parcourue
                'passenger_count' => 0, // Aucune place réservée pour l'instant
                'is_nearby_ride' => true,
                'status' => 'suspend',
                'driver_id' => 2,
                'commission_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
