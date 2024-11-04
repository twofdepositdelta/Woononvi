<?php

namespace Database\Seeders;

use App\Models\Ride;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Obtenez quelques utilisateurs pour les passagers et les conducteurs
        $passengers = User::role('passenger')->take(2)->get();
        $drivers = User::role('driver')->take(2)->get();
        $rides = Ride::all();
        $amount=rand(1000, 10000);
        $commissionPercentage = 10;
        $platformFee = ($amount * $commissionPercentage) / 100;
        // Créer des transactions de test
        foreach ($passengers as $passenger) {
            foreach ($drivers as $driver) {
                foreach ($rides as $ride) {
                    Transaction::create([
                        'passenger_id' => $passenger->id,
                        'driver_id' => $driver->id,
                        'ride_id' => $ride->id,
                        'amount' => $amount ,// Montant entre 10.00 et 100.00
                        'platform_fee'=>  $platformFee,
                        'commission' => rand(50, 500) / 100, // Commission entre 0.50 et 5.00
                        'status' => ['pending', 'completed', 'cancelled', 'refunded'][rand(0, 3)],
                        'payment_method' => ['card', 'mobile money', 'cash'][rand(0, 2)],
                        'transaction_reference' => Str::uuid(), // Référence unique
                    ]);
                }
            }
        }
    }
}

