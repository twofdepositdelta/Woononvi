<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;
use App\Helpers\BackHelper;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Récupérer les 7 premiers utilisateurs (ou les utilisateurs existants)
        $users = User::limit(7)->get();

        foreach ($users as $user) {
            Profile::create([
                'avatar' => BackHelper::getEnvFolder() . 'storage/back/assets/images/users/' . 'user' . $user->id . '.png', // Image fictive
                'bio' => 'Bio de ' . $user->name, // Bio dynamique basée sur le nom de l'utilisateur
                'identy_card' => Str::random(10), // Génération d'une carte d'identité aléatoire unique
                'address' => 'Adresse de ' . $user->name, // Adresse dynamique
                'user_id' => $user->id, // Association de l'utilisateur
            ]);
        }
    }
}