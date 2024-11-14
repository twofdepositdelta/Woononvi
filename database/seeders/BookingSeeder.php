<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ride;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $rides = Ride::inRandomOrder()->take(10)->get(); // Sélectionner 10 trajets aléatoires

        // Insérer des réservations pour les 10 trajets sélectionnés
        foreach ($rides as $ride) {
            foreach ($users->random(5) as $user) { // 5 passagers par trajet
                $uniqueNumber = random_int(1000000000, 9999999999);
                Booking::create([
                    'seats_reserved' => rand(1, 4), // Réservations entre 1 et 4 sièges
                    'total_price' => rand(1000, 20000), // Prix entre 1000 et 20000
                    'status' => ['pending', 'confirmed', 'cancelled', 'refunded'][rand(0, 3)], // Statut aléatoire
                    'ride_id' => $ride->id,
                    'passenger_id' => $user->id,
                    'booking_number' => $uniqueNumber
                ]);
            }
        }
    }
}