<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class RideSeeder extends Seeder
{
    public function run(): void
    {
        // Liste des conducteurs à vérifier
        $drivers = [6, 7]; // Conducteurs 6 et 7

        // Trajets disponibles avec des coordonnées différentes
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
            ],
            [
                'departure' => 'Cotonou',
                'destination' => 'Bohicon',
                'latitude' => 6.4500,
                'longitude' => 2.0800,
            ],
            [
                'departure' => 'Bohicon',
                'destination' => 'Ouidah',
                'latitude' => 6.3633,
                'longitude' => 2.0833,
            ],
            [
                'departure' => 'Porto-Novo',
                'destination' => 'Abomey-Calavi',
                'latitude' => 6.5000,
                'longitude' => 2.4200,
            ],
            [
                'departure' => 'Ouidah',
                'destination' => 'Cotonou',
                'latitude' => 6.3511,
                'longitude' => 2.0900,
            ],
            [
                'departure' => 'Bohicon',
                'destination' => 'Porto-Novo',
                'latitude' => 6.4411,
                'longitude' => 2.2056,
            ],
            [
                'departure' => 'Abomey',
                'destination' => 'Porto-Novo',
                'latitude' => 7.1300,
                'longitude' => 2.3356,
            ],
            [
                'departure' => 'Ouidah',
                'destination' => 'Abomey',
                'latitude' => 6.3811,
                'longitude' => 2.0733,
            ],
        ];

        // Statuts possibles
        $statuses = ['pending', 'active', 'completed'];

        // Boucle sur les conducteurs pour créer des trajets
        foreach ($drivers as $driver_id) {
            // Vérifie si le conducteur a un véhicule associé
            $vehicle = Vehicle::where('driver_id', $driver_id)->first();

            if ($vehicle) {
                for ($i = 0; $i < 10; $i++) {
                    // Sélection aléatoire d'un trajet
                    $route = $routes[$i]; // Utilisation des 10 trajets définis
                    // Sélection aléatoire d'un statut
                    $status = $statuses[array_rand($statuses)];

                    // Type de trajet aléatoire : 'regular' ou 'single'
                    $type = rand(0, 1) ? 'regular' : 'single';

                    // Si c'est un trajet régulier, ajouter des jours
                    $days = null;
                    if ($type == 'regular') {
                        $days = json_encode(['Lundi', 'Mardi', 'Mercredi']); // Exemple de jours réguliers
                    }

                    // Définir un retour de trajet aléatoire
                    $return_trip = rand(0, 1) === 1;
                    $return_time = $return_trip ? Carbon::now()->addHour() : null; // L'heure de retour est définie uniquement si le retour est activé

                    // Insertion dans la table 'rides'
                    DB::table('rides')->insert([
                        'numero_ride' => random_int(100000, 999999),
                        'type' => $type,
                        'start_location_name' => $route['departure'], // Nom de la ville de départ
                        'start_location' => DB::raw("ST_GeomFromText('POINT({$route['longitude']} {$route['latitude']})')"), // Coordonnées de départ
                        'end_location_name' => $route['destination'], // Nom de la ville de destination
                        'end_location' => DB::raw("ST_GeomFromText('POINT({$route['longitude']} {$route['latitude']})')"), // Coordonnées d'arrivée
                        'days' => $days,
                        'return_trip' => $return_trip,
                        'return_time' => $return_time,
                        'departure_time' => Carbon::now(),
                        'arrival_time' => $return_trip ? Carbon::now()->addMinutes(30) : null, // Si retour, on ajoute une arrivée fictive
                        'price_per_km' => 1000,
                        'available_seats'=>rand(1, 10),
                        'price_maintain' => 500, // Exemple de prix de maintenance
                        'is_nearby_ride' => rand(0, 1) === 1,
                        'status' => $status,
                        'driver_id' => $driver_id,
                        'vehicle_id' => $vehicle->id,
                        'created_at' => Carbon::now()->subDays(rand(1, 365)),
                        'updated_at' => now(),
                    ]);
                }
            } else {
                echo "Aucun véhicule trouvé pour le conducteur ID: {$driver_id}.";
            }
        }
    }



}
