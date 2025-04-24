<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\City; // Assurez-vous que le modèle City est importé
use Spatie\Permission\Models\Role; // Importez le modèle Role de Spatie
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Récupérer les villes actives
        $activeCities = City::where('status', true)->get();

        // Définition des utilisateurs avec leurs rôles
        $roles = [
            'super admin',
            'developer',
            'manager',
            'sales',
            'support',
            'driver',
            'passenger',
        ];

        // Création d'utilisateurs avec des NPI uniques
        // foreach ($roles as $index => $role) {
        //     // Vérifier si le rôle est 'driver' ou 'passenger'
        //     $iterations = in_array($role, ['driver', 'passenger']) ? 2 : 1;

        //     for ($i = 0; $i < $iterations; $i++) {
        //         $user = User::create([
        //             'firstname' => ucfirst($role), // Mettre la première lettre en majuscule
        //             'lastname' => 'Test',
        //             'username' => strtolower($role) . 'user' . ($i > 0 ? ($i + 1) : ''), // Format d'utilisateur unique
        //             'email' => strtolower(str_replace(' ', '', trim($role))) . ($i > 0 ? ($i + 1) : '') . '@woononvi.com', // Format d'email unique
        //             'password' => Hash::make('Pass*24'), // Hasher le mot de passe
        //             'phone' => '600000' . $index . $i, // Numéro de téléphone unique par occurrence
        //             'date_of_birth' => now()->subYears(rand(18, 60))->format('Y-m-d'), // Date de naissance aléatoire
        //             'gender' => $index % 2 != 0 ? 'male' : 'female', // Alternance entre les genres
        //             'npi' => rand(1000000000, 9999999999), // Générer un NPI aléatoire de 10 chiffres
        //             'city_id' => $activeCities->random()->id, // Associer à une ville active aléatoire
        //             'is_verified' => true,
        //             'status' => $i % 2 == 0 ? true : false, // Alternance entre les statuts
        //             'balance' => $role == 'driver' ? 2000 : null,
        //             'is_certified' => $role == 'driver' ? true : false,
        //             'email_verified_at' => now(),
        //         ]);

        //         // Associer le rôle à l'utilisateur
        //         $user->assignRole($role);
        //     }
        // }


        for ($i = 0; $i < 2; $i++) {
            $user = User::create([
                'firstname' => 'Driver',
                'lastname' => 'Test',
                'username' => 'driveruser' . ($i + 1),
                'email' => 'driver' . ($i + 1) . '@woononvi.com',
                'password' => Hash::make('Pass*24'),
                'phone' => '6000001' . $i,
                'date_of_birth' => now()->subYears(rand(18, 60))->format('Y-m-d'),
                'gender' => $i % 2 != 0 ? 'male' : 'female',
                'npi' => rand(1000000000, 9999999999),
                'city_id' => $activeCities->random()->id,
                'is_verified' => true,
                'status' => $i % 2 == 0,
                'balance' => 2000,
                'is_certified' => true,
                'email_verified_at' => now(),
            ]);
            $user->assignRole('driver');
        }

        // PASSENGERS (2 fois)
        for ($i = 0; $i < 2; $i++) {
            $user = User::create([
                'firstname' => 'Passenger',
                'lastname' => 'Test',
                'username' => 'passengeruser' . ($i + 1),
                'email' => 'passenger' . ($i + 1) . '@woononvi.com',
                'password' => Hash::make('Pass*24'),
                'phone' => '6000002' . $i,
                'date_of_birth' => now()->subYears(rand(18, 60))->format('Y-m-d'),
                'gender' => $i % 2 != 0 ? 'male' : 'female',
                'npi' => rand(1000000000, 9999999999),
                'city_id' => $activeCities->random()->id,
                'is_verified' => true,
                'status' => $i % 2 == 0,
                'balance' => null,
                'is_certified' => false,
                'email_verified_at' => now(),
            ]);
            $user->assignRole('passenger');
        }

        $user4 = User::create([
            'firstname' => 'Super admin',
            'lastname' => 'Test',
            'username' => 'superadmin',
            'email' => 'ceo@woononvi.com',
            'password' => Hash::make('Pass*24'),
            'phone' => '60010203',
            'date_of_birth' => now()->subYears(rand(18, 60))->format('Y-m-d'),
            'gender' => 'male',
            'npi' => rand(1000000000, 9999999999),
            'city_id' => $activeCities->random()->id,
            'is_verified' => true,
            'status' =>1,
            'balance' => null,
            'is_certified' => false,
            'email_verified_at' => now(),
        ]);
        $user4->assignRole('super admin');

        $user5 = User::create([
            'firstname' => 'Manager',
            'lastname' => 'Test',
            'username' => 'managertest',
            'email' => 'manager@woononvi.com',
            'password' => Hash::make('Pass*24'),
            'phone' => '60040203',
            'date_of_birth' => now()->subYears(rand(18, 60))->format('Y-m-d'),
            'gender' => 'male',
            'npi' => rand(1000000000, 9999999999),
            'city_id' => $activeCities->random()->id,
            'is_verified' => true,
            'status' =>1,
            'balance' => null,
            'is_certified' => false,
            'email_verified_at' => now(),
        ]);
        $user5->assignRole('manager');

        $user6 = User::create([
            'firstname' => 'Support',
            'lastname' => 'Test',
            'username' => 'supportest',
            'email' => 'support@woononvi.com',
            'password' => Hash::make('Pass*24'),
            'phone' => '60020103',
            'date_of_birth' => now()->subYears(rand(18, 60))->format('Y-m-d'),
            'gender' => 'female',
            'npi' => rand(1000000000, 9999999999),
            'city_id' => $activeCities->random()->id,
            'is_verified' => true,
            'status' =>1,
            'balance' => null,
            'is_certified' => false,
            'email_verified_at' => now(),
        ]);
        $user6->assignRole('support');

        $user7 = User::create([
            'firstname' => 'Forester',
            'lastname' => 'CODJO',
            'username' => 'forestercodjo',
            'email' => 'forestercodjo@woononvi.com',
            'password' => Hash::make('Pass*24'),
            'phone' => '60050301',
            'date_of_birth' => now()->subYears(rand(18, 60))->format('Y-m-d'),
            'gender' => 'male',
            'npi' => rand(1000000000, 9999999999),
            'city_id' => $activeCities->random()->id,
            'is_verified' => true,
            'status' =>1,
            'balance' => null,
            'is_certified' => false,
            'email_verified_at' => now(),
        ]);
        $user7->assignRole('developer');

        $user8 = User::create([
            'firstname' => 'Fabrice',
            'lastname' => 'DEGLA',
            'username' => 'fabricedegla',
            'email' => 'fabricedegla@woononvi.com',
            'password' => Hash::make('Pass*24'),
            'phone' => '60060301',
            'date_of_birth' => now()->subYears(rand(18, 60))->format('Y-m-d'),
            'gender' => 'male',
            'npi' => rand(1000000000, 9999999999),
            'city_id' => $activeCities->random()->id,
            'is_verified' => true,
            'status' =>1,
            'balance' => null,
            'is_certified' => false,
            'email_verified_at' => now(),
        ]);
        $user8->assignRole('developer');
    }
}
