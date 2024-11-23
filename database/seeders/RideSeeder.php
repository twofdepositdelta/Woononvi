<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Ride;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use TarfinLabs\LaravelSpatial\Types\Point;

class RideSeeder extends Seeder
{
    public function run()
    {
        // Exemple de véhicule et de conducteur
        $vehicle = Vehicle::first();

        // Trajet 1: Bohicon -> Dassa-Zoumé (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 7,
            'type' => 'regular',
            'start_location_name' => 'Bohicon',
            'start_location' => new Point(7.1783, 2.0667),
            'end_location_name' => 'Dassa-Zoumé',
            'end_location' => new Point(7.7355, 2.1834),
            'days' => json_encode(['Mardi', 'Jeudi']),
            'return_trip' => true,
            'return_time' => '17:00:00',
            'available_seats' => 5,
            'departure_time' => '08:30:00',
            'arrival_time' => '10:00:00',
            'price_per_km' => 1500,
            'total_price' => 1500,
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 2: Ouidah -> Cotonou (trajet ponctuel)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'single',
            'start_location_name' => 'Ouidah',
            'start_location' => new Point(6.3647, 2.0854),
            'end_location_name' => 'Cotonou',
            'end_location' => new Point(6.3703, 2.3912),
            'days' => null,
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 4,
            'departure_time' => '07:00:00',
            'arrival_time' => '08:00:00',
            'price_per_km' => 2000,
            'total_price' => 1200,
            'is_nearby_ride' => true,
            'status' => 'pending',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 3: Natitingou -> Djougou (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 8,
            'type' => 'regular',
            'start_location_name' => 'Natitingou',
            'start_location' => new Point(10.3042, 1.3796),
            'end_location_name' => 'Djougou',
            'end_location' => new Point(9.7085, 1.6656),
            'days' => json_encode(['Lundi', 'Vendredi']),
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 6,
            'departure_time' => '09:00:00',
            'arrival_time' => '11:30:00',
            'price_per_km' => 2500,
            'total_price' => 1100,
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 4: Abomey -> Bohicon (trajet ponctuel)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'single',
            'start_location_name' => 'Abomey',
            'start_location' => new Point(7.1823, 1.9912),
            'end_location_name' => 'Bohicon',
            'end_location' => new Point(7.1783, 2.0667),
            'days' => null,
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 2,
            'departure_time' => '12:00:00',
            'arrival_time' => '12:45:00',
            'price_per_km' => 1800,
            'total_price' => 1000,
            'is_nearby_ride' => true,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 5: Dassa-Zoumé -> Parakou (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'regular',
            'start_location_name' => 'Dassa-Zoumé',
            'start_location' => new Point(7.7355, 2.1834),
            'end_location_name' => 'Parakou',
            'end_location' => new Point(9.3373, 2.6301),
            'days' => json_encode(['Mercredi', 'Samedi']),
            'return_trip' => true,
            'return_time' => '18:00:00',
            'available_seats' => 5,
            'departure_time' => '08:30:00',
            'arrival_time' => '13:00:00',
            'price_per_km' => 2200,
            'total_price' => 1300,
            'is_nearby_ride' => false,
            'status' => 'pending',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 6: Cotonou -> Allada (trajet ponctuel)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 7,
            'type' => 'single',
            'start_location_name' => 'Cotonou',
            'start_location' => new Point(6.3703, 2.3912),
            'end_location_name' => 'Allada',
            'end_location' => new Point(6.6653, 2.1514),
            'days' => null,
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 3,
            'departure_time' => '14:00:00',
            'arrival_time' => '15:30:00',
            'price_per_km' => 2000,
            'total_price' => 1000,
            'is_nearby_ride' => true,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 7: Malanville -> Kandi (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 7,
            'type' => 'regular',
            'start_location_name' => 'Malanville',
            'start_location' => new Point(11.8615, 3.3896),
            'end_location_name' => 'Kandi',
            'end_location' => new Point(11.1342, 2.9362),
            'days' => json_encode(['Lundi', 'Jeudi']),
            'return_trip' => true,
            'return_time' => '16:00:00',
            'available_seats' => 4,
            'departure_time' => '08:00:00',
            'arrival_time' => '10:30:00',
            'price_per_km' => 2500,
            'total_price' => 1100,
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 8: Porto-Novo -> Ouidah (trajet ponctuel)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'single',
            'start_location_name' => 'Porto-Novo',
            'start_location' => new Point(6.4969, 2.6283),
            'end_location_name' => 'Ouidah',
            'end_location' => new Point(6.3647, 2.0854),
            'days' => null,
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 5,
            'departure_time' => '11:00:00',
            'arrival_time' => '12:30:00',
            'price_per_km' => 2000,
            'total_price' => 900,
            'is_nearby_ride' => false,
            'status' => 'pending',
            'vehicle_id' => $vehicle->id,
        ]);
    }

}