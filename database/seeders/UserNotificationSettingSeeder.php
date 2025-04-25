<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserNotificationSetting;

class UserNotificationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // // Supposons que tes utilisateurs aient les IDs de 1 à 7
        // $userIds = range(1, 7); // Crée un tableau d'IDs de 1 à 7

        // foreach ($userIds as $userId) {
        //     // Crée des paramètres de notification pour chaque utilisateur
        //     UserNotificationSetting::create([
        //         'user_id' => $userId,
        //         'notification_type' => 'nouveau_trajet', // Type de notification pour les nouveaux trajets
        //         'is_enabled' => true,
        //         'frequency' => 'immédiat', // Notification immédiate pour les nouveaux trajets
        //     ]);
        //     UserNotificationSetting::create([
        //         'user_id' => $userId,
        //         'notification_type' => 'promotions', // Type de notification pour les promotions
        //         'is_enabled' => true,
        //         'frequency' => 'hebdomadaire', // Hebdomadaire pour les promotions
        //     ]);
        //     UserNotificationSetting::create([
        //         'user_id' => $userId,
        //         'notification_type' => 'mises_a_jour_trajet', // Type de notification pour les mises à jour de trajet
        //         'is_enabled' => true,
        //         'frequency' => 'quotidien', // Quotidien pour les mises à jour
        //     ]);
        //     UserNotificationSetting::create([
        //         'user_id' => $userId,
        //         'notification_type' => 'evenements', // Type de notification pour les événements
        //         'is_enabled' => false, // Désactivé par défaut
        //         'frequency' => 'jamais', // Jamais pour les événements
        //     ]);
        //     UserNotificationSetting::create([
        //         'user_id' => $userId,
        //         'notification_type' => 'actualites', // Type de notification pour les actualités de l'application
        //         'is_enabled' => true,
        //         'frequency' => 'hebdomadaire', // Hebdomadaire pour les actualités
        //     ]);
        //     UserNotificationSetting::create([
        //         'user_id' => $userId,
        //         'notification_type' => 'evaluations', // Type de notification pour les évaluations
        //         'is_enabled' => true,
        //         'frequency' => 'immédiat', // Notification immédiate pour les évaluations
        //     ]);
        //     UserNotificationSetting::create([
        //         'user_id' => $userId,
        //         'notification_type' => 'rappels_trajet', // Type de notification pour les rappels de trajet
        //         'is_enabled' => true,
        //         'frequency' => 'quotidien', // Quotidien pour les rappels
        //     ]);
        //     UserNotificationSetting::create([
        //         'user_id' => $userId,
        //         'notification_type' => 'mises_a_jour_statut', // Type de notification pour les mises à jour de statut de trajet
        //         'is_enabled' => true,
        //         'frequency' => 'immédiat', // Notification immédiate pour les mises à jour de statut
        //     ]);
        //     UserNotificationSetting::create([
        //         'user_id' => $userId,
        //         'notification_type' => 'notifications_commandes', // Type de notification pour les notifications de commandes
        //         'is_enabled' => true,
        //         'frequency' => 'hebdomadaire', // Hebdomadaire pour les notifications de commandes
        //     ]);
        //     // Ajoute d'autres types de notifications si nécessaire
        // }
    }
}
