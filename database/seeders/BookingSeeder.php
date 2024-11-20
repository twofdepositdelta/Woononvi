<?php
namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Ride;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{


public function run()
{
    $users = User::all();
    $rides = Ride::inRandomOrder()->take(10)->get(); // Sélectionner 10 trajets aléatoires

    foreach ($rides as $ride) {
        foreach ($users->random(5) as $user) { // 5 passagers par trajet
            $uniqueNumber = random_int(1000000000, 9999999999);

            // Générer des dates aléatoires pour les 4 derniers semaines, mois, années et aujourd'hui
            $randomDate = $this->getRandomDate();

            // Générer des dates aléatoires pour les différents statuts de la réservation
            $acceptedAt = $this->getRandomDateForStatus();
            $rejectedAt = $this->getRandomDateForStatus();
            $validatedByPassengerAt = $this->getRandomDateForStatus();
            $validatedByDriverAt = $this->getRandomDateForStatus();
            $refundedAt = $this->getRandomDateForStatus();
            $cancelledAt = $this->getRandomDateForStatus();

            Booking::create([
                'seats_reserved' => rand(1, 4), // Réservations entre 1 et 4 sièges
                'total_price' => rand(1000, 20000), // Prix entre 1000 et 20000
                'price_maintain' => rand(1000, 20000), // Prix d'entretien en FCFA
                'status' => ['pending', 'accepted', 'rejected','completed', 'refunded', 'cancelled'][rand(0, 5)], // Statut aléatoire
                'ride_id' => $ride->id,
                'passenger_id' => $user->id,
                'booking_number' => $uniqueNumber,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
                'accepted_at' => $acceptedAt,
                'rejected_at' => $rejectedAt,
                'validated_by_passenger_at' => $validatedByPassengerAt,
                'validated_by_driver_at' => $validatedByDriverAt,
                'refunded_at' => $refundedAt,
                'cancelled_at' => $cancelledAt,
                'commission_rate'=>10
            ]);
        }
    }
}

private function getRandomDate()
{
    $today = Carbon::now();

    // 60% des réservations dans les 4 dernières semaines
    if (rand(0, 100) < 60) {
        return $today->copy()->subDays(rand(0, 28));
    }

    // 30% des réservations dans les 6 derniers mois
    if (rand(0, 100) < 90) {
        return $today->copy()->subMonths(rand(1, 6))->subDays(rand(0, 30));
    }

    // 10% des réservations dans les années précédentes
    return $today->copy()->subYears(rand(1, 3))->subMonths(rand(0, 11))->subDays(rand(0, 30));
}

private function getRandomDateForStatus()
{
    // 50% des statuts avec des dates valides (récentes)
    if (rand(0, 100) < 50) {
        return Carbon::now();
    }

    // 50% des statuts avec une date nulle
    return null;
}

}

