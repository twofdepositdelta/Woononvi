<?php

namespace Database\Seeders;

use App\Models\Ride;
use App\Models\User;
use App\Models\Booking;
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


        $drivers = User::role('driver')->take(2)->get();
        $bookings = Booking::all();
        // Créer des transactions de test
            foreach ($drivers as $driver) {
                foreach ($bookings as $booking) {
                    Transaction::create([
                        'passenger_id' => $booking->passenger->id,
                        'driver_id' => $driver->id,
                        'booking_id' => $booking->id,
                        'status' => ['pending', 'completed', 'cancelled', 'refunded'][rand(0, 3)],
                        'payment_method' => ['card', 'mobile money', 'cash'][rand(0, 2)],
                        'transaction_reference' => Str::uuid(), // Référence unique
                    ]);
                }
            }
        }
    }

