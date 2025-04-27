<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Assurez-vous d'avoir des utilisateurs et des réservations dans la base de données
        //  $users = User::all();
        //  $bookings = Booking::all();
        //  $review_type=['passenger', 'driver'];
        //  foreach ($bookings as $booking) {
        //      Review::create([
        //          'rating' => rand(1, 5), // Évaluation entre 1 et 5
        //          'comment' => $this->generateRandomComment(), // Générez un commentaire aléatoire
        //          'booking_id' => $booking->id,
        //          'reviewer_id' => $users->random()->id,// Un utilisateur aléatoire comme reviewer
        //          'reviewer_type'=>$review_type[array_rand($review_type)]
        //         ]);
        //  }
     }

     private function generateRandomComment()
     {
         $comments = [
             'Service excellent !',
             'Pourrait être mieux.',
             'J\'ai eu une excellente expérience.',
             'Le trajet était correct.',
             'Conducteur très sympathique !',
             'Je vais certainement utiliser ce service à nouveau.',
             'Pas ce que j\'attendais.',
             'Je recommande vivement !',
             'Le trajet était confortable.',
             'J\'ai eu un problème avec la réservation.',
         ];

         return $comments[array_rand($comments)];
     }

}
