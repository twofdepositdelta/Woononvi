<?php

namespace Database\Seeders;

use App\Models\Ride;
use Illuminate\Support\Str;
use App\Models\AppNotification;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Exemple de notifications pour différentes situations
        $notifications = [
            [
                'id' => Str::uuid(),
                'type' => 'App\\Notifications\\RideUpdated',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1, // Remplacez par l'ID d'un utilisateur valide
                'data' => json_encode(['message' => 'Votre trajet a été mis à jour.']),
                'read_at' => null,
                'ride_id' => Ride::inRandomOrder()->first()?->id, // Trajet aléatoire
                'notification_type' => 'ride_update',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'type' => 'App\\Notifications\\NewRideAvailable',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2, // Remplacez par un autre ID utilisateur valide
                'data' => json_encode(['message' => 'Un nouveau trajet est disponible.']),
                'read_at' => now(),
                'ride_id' => Ride::inRandomOrder()->first()?->id, // Trajet aléatoire
                'notification_type' => 'new_ride_available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'type' => 'App\\Notifications\\DemandRideResponse',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 3, // Remplacez par un autre ID utilisateur valide
                'data' => json_encode(['message' => 'Votre demande de trajet a reçu une réponse.']),
                'read_at' => null,
                'ride_id' => Ride::inRandomOrder()->first()?->id, // Trajet aléatoire
                'notification_type' => 'demand_ride_response',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insérer les données dans la base
        AppNotification::insert($notifications);
    }

    }

