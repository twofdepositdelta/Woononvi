<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            foreach($ride->bookings as $booking){

                // Calcul de la commission en fonction du taux de commission et du prix total
                $totalPrice =$booking->total_price ; // Exemple de calcul du prix total
                $commissionAmount = ($totalPrice * $ride->commission_rate) / 100;
            }

                // Génération de la date aléatoire pour la commission
            $randomDate = Carbon::createFromTimestamp(rand(strtotime('-3 years'), strtotime('now')))
            ->startOfDay(); // Crée une date aléatoire entre 3 ans avant et aujourd'hui

            // Création de la commission pour chaque trajet
            Commission::create([
            'amount' => $commissionAmount,
            'commission_rate' => $ride->commission_rate,
            'ride_id' => $ride->id,
            'created_at' => $randomDate, // Affecte la date aléatoire générée
            'updated_at' => $randomDate, // Garde la même date pour la mise à jour
            ]);
        }
    }
}
