<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Vehicle;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drivers = [6, 7]; // Liste des conducteurs à vérifier

        foreach ($drivers as $driver_id) {
            // Vérifiez si le conducteur a un véhicule associé
            $vehicle = Vehicle::where('driver_id', $driver_id)->first();

            if ($vehicle) {
                DB::table('rides')->insert([
                    [
                        'numero_ride' => random_int(100000, 999999),
                        'departure' => 'Cotonou',
                        'destination' => 'Porto-Novo',
                        'departure_time' => Carbon::now()->addDays(1),
                        'available_seats' => 3,
                        'price_per_km' => 1000,
                        'latitude' => 6.3656,
                        'longitude' => 2.4188,
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
                    // Répétez pour les autres trajets, en vérifiant toujours si un véhicule existe pour chaque conducteur
                ]);
            } else {
                // Si aucun véhicule n'est trouvé pour le conducteur, affichez un message d'erreur ou gérez cette situation
                echo "Aucun véhicule trouvé pour le conducteur ID: {$driver_id}.";
            }
        }

    }



}