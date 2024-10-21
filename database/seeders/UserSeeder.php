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
        foreach ($roles as $index => $role) {
            // Vérifier si le rôle est 'driver' ou 'passenger'
            $iterations = in_array($role, ['driver', 'passenger']) ? 2 : 1;

            // Répéter la création d'utilisateur pour 1 ou 2 occurrences selon le rôle
            for ($i = 0; $i < $iterations; $i++) {
                $user = User::create([
                    'firstname' => ucfirst($role), // Mettre la première lettre en majuscule
                    'lastname' => 'Test',
                    'username' => strtolower($role) . 'user' . ($i > 0 ? ($i + 1) : ''), // Format d'utilisateur unique
                    'email' => strtolower(str_replace(' ', '', trim($role))) . ($i > 0 ? ($i + 1) : '') . '@wononvi.com', // Format d'email unique
                    'password' => Hash::make('Pass*24'), // Hasher le mot de passe
                    'phone' => '600000' . $index . $i, // Numéro de téléphone unique par occurrence
                    'date_of_birth' => now()->subYears(rand(18, 60))->format('Y-m-d'), // Date de naissance aléatoire
                    'gender' => $index % 2 != 0 ? 'male' : 'female', // Alternance entre les genres
                    'npi' => rand(1000000000, 9999999999), // Générer un NPI aléatoire de 10 chiffres
                    'city_id' => $activeCities->random()->id, // Associer à une ville active aléatoire
                    'is_verified' => true,
                    'balance' => $role == 'driver' ? 2000 : null,
                    'email_verified_at' => now(),
                ]);

                // Associer le rôle à l'utilisateur
                $user->assignRole($role);
            }
        }
    }
}