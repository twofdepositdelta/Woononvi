<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RideSeeder extends Seeder
{
    public function run()
    {
        // Liste des conducteurs à vérifier
        $drivers = [6, 7]; // Conducteurs 6 et 7

        // Trajets disponibles entre les villes du Bénin
        $routes = [
            [
                'departure' => 'Cotonou',
                'destination' => 'Porto-Novo',
                'latitude' => 6.3656,
                'longitude' => 2.4188,
            ],
            [
                'departure' => 'Porto-Novo',
                'destination' => 'Abomey',
                'latitude' => 7.1833,
                'longitude' => 2.2833,
            ],
            [
                'departure' => 'Abomey',
                'destination' => 'Ouidah',
                'latitude' => 6.3611,
                'longitude' => 2.0811,
            ]
        ];

        // Boucle sur les conducteurs pour créer des trajets
        foreach ($drivers as $driver_id) {
            // Vérifie si le conducteur a un véhicule associé
            $vehicle = Vehicle::where('driver_id', $driver_id)->first();

            if ($vehicle) {
                // Boucle sur les trajets définis pour insérer les trajets
                foreach ($routes as $route) {
                    DB::table('rides')->insert([
                        [
                            'numero_ride' => random_int(100000, 999999),
                            'departure' => $route['departure'], // Ville de départ
                            'destination' => $route['destination'], // Ville de destination
                            'departure_time' => Carbon::now()->addDays(1),
                            'available_seats' => 3,
                            'price_per_km' => 1000,
                            'latitude' => $route['latitude'], // Latitude de la ville de départ
                            'longitude' => $route['longitude'], // Longitude de la ville de départ
                            'distance_travelled' => 0,
                            'passenger_count' => 0,
                            'is_nearby_ride' => true,
                            'status' => 'active',
                            'driver_id' => $driver_id,
                            'vehicle_id' => $vehicle->id,
                            'commission_rate' => 10,
                            'created_at' => Carbon::now()->subYear(),
                            'updated_at' => now(),
                        ],
                    ]);
                }
            } else {
                // Si aucun véhicule n'est trouvé pour le conducteur
                echo "Aucun véhicule trouvé pour le conducteur ID: {$driver_id}.";
            }
        }
    }
}
