<?php

namespace Database\Seeders;

use App\Models\Ride;
use App\Models\Commission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $rides = Ride::all();

        foreach ($rides as $ride) {
            // Calcul de la commission en fonction du taux de commission et du prix total
            $totalPrice = $ride->price_per_km * $ride->available_seats; // Exemple de calcul du prix total
            $commissionAmount = ($totalPrice * $ride->commission_rate) / 100;

            // Création de la commission pour chaque trajet
            Commission::create([
                'amount' => $commissionAmount,
                'commission_rate' => $ride->commission_rate,
                'ride_id' => $ride->id,
            ]);
        }
    }
}
