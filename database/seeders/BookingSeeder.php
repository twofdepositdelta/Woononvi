<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Ride;
use App\Models\User;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Assurez-vous d'avoir des utilisateurs et des trajets dans la base de données
        $users = User::all();
        $rides = Ride::all();

        foreach ($rides as $ride) {
            foreach ($users->random(5) as $user) { // Random 5 passagers pour chaque trajet
                do {
                    $uniqueNumber = random_int(1000000000, 9999999999); // Génère un nombre à 10 chiffres
                } while (Booking::where('booking_number', $uniqueNumber)->exists()); // Vérifie l'unicité en base

                Booking::create([
                    'seats_reserved' => rand(1, 4), // Réservant entre 1 et 4 sièges
                    'total_price' => rand(1000, 20000), // Prix total entre 20 et 100
                    'status' => ['pending', 'confirmed', 'cancelled', 'refunded'][rand(0, 3)],
                    'ride_id' => $ride->id,
                    'passenger_id' => $user->id,
                    'booking_number'=>$uniqueNumber
                ]);
            }
        }
    }
}
