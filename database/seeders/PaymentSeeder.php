<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Récupération des types de paiement
        $paymentTypes = PaymentType::all();

        // Récupération des utilisateurs et réservations pour lier les paiements
        $users = User::all();
        $bookings = Booking::all();

        // Création des paiements avec différents statuts et méthodes de paiement
        $payments = [
            [
                'amount' => $bookings->random()->total_price, // Utilisation du prix de la réservation
                'payment_number' => null,
                'reference' => 'REF123456',
                'payment_method' => 'CREDITCARD',
                'status' => 'SUCCESSFUL',
                'user_id' => $users->random()->id,
                'booking_id' => $bookings->random()->id,
                'payment_type_id' => $paymentTypes->random()->id,
            ],
            [
                'amount' => $bookings->random()->total_price, // Utilisation du prix de la réservation
                'payment_number' => null,
                'reference' => 'REF123457',
                'payment_method' => 'PAYPAL',
                'status' => 'PENDING',
                'user_id' => $users->random()->id,
                'booking_id' => $bookings->random()->id,
                'payment_type_id' => $paymentTypes->random()->id,
            ],
            [
                'amount' => $bookings->random()->total_price, // Utilisation du prix de la réservation
                'payment_number' => null,
                'reference' => 'REF123458',
                'payment_method' => 'CASH',
                'status' => 'FAILED',
                'user_id' => $users->random()->id,
                'booking_id' => $bookings->random()->id,
                'payment_type_id' => $paymentTypes->random()->id,
            ],
            [
                'amount' => $bookings->random()->total_price, // Utilisation du prix de la réservation
                'payment_number' => null,
                'reference' => 'REF123459',
                'payment_method' => 'MOMO',
                'status' => 'SUCCESSFUL',
                'user_id' => $users->random()->id,
                'booking_id' => $bookings->random()->id,
                'payment_type_id' => $paymentTypes->random()->id,
            ]
        ];

        // Création des paiements dans la base de données
        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }

    }
