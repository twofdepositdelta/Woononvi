<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            CitySeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            UserNotificationSettingSeeder::class,
            SettingsSeeder::class,
            EnvironmentSeeder::class,
            TypeVehicleSeeder::class,
            VehicleSeeder::class,          // Ajoutez le véhicule avant les trajets
            RideSeeder::class,
            BookingSeeder::class,          // Ajoutez les réservations après les trajets
            ReportTypeSeeder::class,       // Ajoutez les types de rapports avant les rapports
            ReportSeeder::class,           // Ajoutez les rapports après les réservations
            RideRequestSeeder::class,
            ConversationSeeder::class,
            MessageSeeder::class,
            TypeNewSeeder::class,
            ActualitySeeder::class,
            ReviewSeeder::class,
            TransactionSeeder::class,
            FaqTypeSeeder::class,
            FaqSeeder::class,
            TypeDocumentSeeder::class,
            DocumentSeeder::class,
            ComissionSeeder::class,
            ApiSeeder::class,
            PaymentTypeSeeder::class,
            PaymentSeeder::class
        ]);
    }
}