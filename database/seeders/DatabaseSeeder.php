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
            RolePermissionSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            UserNotificationSettingSeeder::class,
            SettingsSeeder::class,
            EnvironmentSeeder::class,
            ApiSeeder::class,
            RideSeeder::class,
            TypeNewSeeder::class,
            ActualitySeeder::class,
            BookingSeeder::class,
            ReviewSeeder::class,
            RideSearcheSeeder::class

        ]);
    }
}
