<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Document;
use App\Helpers\BackHelper;
use Illuminate\Support\Str;
use App\Models\TypeDocument;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // $users = User::whereHas('roles', function ($query) {
        //     $query->where('name', 'driver');
        // })->distinct()->get();

        // $typeDocuments = TypeDocument::all();

        // foreach ($users as $user) {
        //     if ($typeDocuments->isNotEmpty()) {
        //         // Récupère un seul type de document, par exemple le permis de conduire
        //         $typeDocument = $typeDocuments->where('label', 'Permis de conduire')->first();

        //         if ($typeDocument) {
        //             $document = [
        //                 'paper' => 'Permis de conduire numérique',
        //                 'number' => random_int(100000, 999999),
        //                 'expiry_date' => Carbon::now()->addYear(),
        //                 'user_id' => $user->id,
        //                 'type_document_id' => $typeDocument->id,
        //                 'is_validated' => false,
        //                 'is_rejected' => false,
        //                 'slug' => Str::slug($user->email), // Assure un slug unique
        //                 'reason' => null
        //             ];

        //             // Vérifie l'existence du document avant création
        //                 Document::create($document);

        //         }
        //     }
        // }
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->get();
        $typeDocuments = TypeDocument::all();
        $vehicles=Vehicle::all();

        foreach ($users as $user) {
        if ($typeDocuments->isNotEmpty()) {
            $documents = [
                [
                    'paper' => BackHelper::getEnvFolder() . 'storage/back/assets/images/doc/1.pdf',
                    'number' => random_int(100000, 999999),
                    'expiry_date' => Carbon::now()->addYear(),
                    'user_id' => $user->id,
                    'type_document_id' => $typeDocuments->where('label', 'Permis de conduire')->first()->id,
                    'is_validated' => false,
                    'is_rejected' => false,
                    'slug' => Str::slug($user->email). '-' . Str::random(5),// Assure un slu unique
                    // Ajoute une chaîne aléatoire pour assurer l'unicité
                    'reason' => null,
                    'vehicle_id' => $vehicles->random()->id,
                ],
                [
                    'paper' => BackHelper::getEnvFolder() . 'storage/back/assets/images/doc/2.pdf',
                    'number' => random_int(100000, 999999),
                    'expiry_date' => Carbon::now()->addYears(3),
                    'user_id' => $user->id,
                    'type_document_id' => $typeDocuments->where('label', 'Carte grise')->first()->id,
                    'is_validated' => false,
                    'is_rejected' => false,
                    'slug' => Str::slug($user->email). '-' . Str::random(5),// Assure un slu unique
                    'reason' => null,
                    'vehicle_id' => $vehicles->random()->id,
                ]
            ];
            foreach ($documents as $document) {
                // Vérifie l'existence du documen
                    Document::create($document);

            }
}
}
    }}





