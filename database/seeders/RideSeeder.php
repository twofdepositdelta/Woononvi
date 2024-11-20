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
        // Récupérer un conducteur existant et un véhicule
        $vehicle = Vehicle::first(); // Assure-toi qu'il y a des véhicules dans la base de données

        // Trajet 1: Cotonou -> Porto-Novo (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'regular',
            'start_location_name' => 'Cotonou',
            'start_location' => new Point(6.3574,2.4299), // Coordonnées géographiques pour Cotonou
            'end_location_name' => 'Porto-Novo',
            'end_location' => new Point(6.4463,2.6172), // Coordonnées géographiques pour Porto-Novo
            'days' => json_encode(['Lundi', 'Mercredi', 'Vendredi']),
            'return_trip' => true,
            'return_time' => '16:00:00',
            'available_seats' => 4,
            'departure_time' => '08:00:00',
            'arrival_time' => '09:00:00',
            'price_per_km' => 2000, // Prix par km en FCFA
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 2: Parakou -> Natitingou (trajet ponctuel)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 7,
            'type' => 'single',
            'start_location_name' => 'Parakou',
            'start_location' => new Point(9.3406,2.6217), // Coordonnées géographiques pour Parakou
            'end_location_name' => 'Natitingou',
            'end_location' => new Point(10.3034,1.3817), // Coordonnées géographiques pour Natitingou
            'days' => null,
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 3,
            'departure_time' => '07:30:00',
            'arrival_time' => '12:00:00',
            'price_per_km' => 2500,
            'is_nearby_ride' => true,
            'status' => 'pending',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 3: Cotonou -> Parakou (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 7,
            'type' => 'regular',
            'start_location_name' => 'Cotonou',
            'start_location' => new Point(6.3574, 2.4299),
            'end_location_name' => 'Parakou',
            'end_location' => new Point(9.3406, 2.6217),
            'days' => json_encode(['Lundi', 'Jeudi']),
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 5,
            'departure_time' => '06:30:00',
            'arrival_time' => '12:00:00',
            'price_per_km' => 2200,
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 4: Porto-Novo -> Cotonou (trajet ponctuel)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'single',
            'start_location_name' => 'Porto-Novo',
            'start_location' => new Point(6.4463 ,2.6172),
            'end_location_name' => 'Cotonou',
            'end_location' => new Point(6.3574 ,2.4299),
            'days' => null,
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 2,
            'departure_time' => '10:00:00',
            'arrival_time' => '11:00:00',
            'price_per_km' => 1800,
            'is_nearby_ride' => true,
            'status' => 'pending',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 5: Parakou -> Cotonou (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 7,
            'type' => 'regular',
            'start_location_name' => 'Parakou',
            'start_location' => new Point(9.3406, 2.6217),
            'end_location_name' => 'Cotonou',
            'end_location' => new Point(6.3574, 2.4299),
            'days' => json_encode(['Mardi', 'Mercredi']),
            'return_trip' => true,
            'return_time' => '18:00:00',
            'available_seats' => 6,
            'departure_time' => '09:00:00',
            'arrival_time' => '15:00:00',
            'price_per_km' => 2100,
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 6: Cotonou -> Porto-Novo (trajet ponctuel)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'single',
            'start_location_name' => 'Cotonou',
            'start_location' => new Point(6.3574, 2.4299),
            'end_location_name' => 'Porto-Novo',
            'end_location' => new Point(6.4463,2.6172),
            'days' => null,
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 4,
            'departure_time' => '14:00:00',
            'arrival_time' => '15:00:00',
            'price_per_km' => 1900,
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 7: Natitingou -> Parakou (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 7,
            'type' => 'regular',
            'start_location_name' => 'Natitingou',
            'start_location' => new Point(10.3034,1.3817),
            'end_location_name' => 'Parakou',
            'end_location' => new Point(9.3406,2.6217),
            'days' => json_encode(['Lundi', 'Mercredi']),
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 4,
            'departure_time' => '06:00:00',
            'arrival_time' => '08:30:00',
            'price_per_km' => 2300,
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 8: Cotonou -> Porto-Novo (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'regular',
            'start_location_name' => 'Cotonou',
            'start_location' => new Point(6.3574,2.4299),
            'end_location_name' => 'Porto-Novo',
            'end_location' => new Point(6.4463,2.6172),
            'days' => json_encode(['Lundi', 'Vendredi']),
            'return_trip' => true,
            'return_time' => '17:00:00',
            'available_seats' => 4,
            'departure_time' => '09:00:00',
            'arrival_time' => '10:00:00',
            'price_per_km' => 1800,
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 9: Porto-Novo -> Parakou (trajet ponctuel)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'single',
            'start_location_name' => 'Porto-Novo',
            'start_location' => new Point(6.4463, 2.6172),
            'end_location_name' => 'Parakou',
            'end_location' => new Point(9.3406,2.6217),
            'days' => null,
            'return_trip' => false,
            'return_time' => null,
            'available_seats' => 3,
            'departure_time' => '13:00:00',
            'arrival_time' => '17:30:00',
            'price_per_km' => 2400,
            'is_nearby_ride' => false,
            'status' => 'pending',
            'vehicle_id' => $vehicle->id,
        ]);

        // Trajet 10: Parakou -> Porto-Novo (trajet régulier)
        Ride::create([
            'numero_ride' => rand(1000, 9999),
            'driver_id' => 6,
            'type' => 'regular',
            'start_location_name' => 'Parakou',
            'start_location' => new Point(9.3406,2.6217),
            'end_location_name' => 'Porto-Novo',
            'end_location' => new Point(6.4463, 2.6172),
            'days' => json_encode(['Mardi', 'Jeudi']),
            'return_trip' => true,
            'return_time' => '18:00:00',
            'available_seats' => 5,
            'departure_time' => '08:00:00',
            'arrival_time' => '13:00:00',
            'price_per_km' => 2300,
            'is_nearby_ride' => false,
            'status' => 'active',
            'vehicle_id' => $vehicle->id,
        ]);
    }



}
