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
        // $users = User::whereHas('roles', function($query) {
        //     $query->where('name', 'driver')->orWhere('name', 'passenger');
        // })->get();

        // $typeDocuments = TypeDocument::all();
        // $vehicles = Vehicle::all();

        // foreach ($users as $user) {
        //     // Si l'utilisateur a le rôle 'driver'
        //     if ($user->hasRole('driver')) {
        //         if ($typeDocuments->isNotEmpty()) {
        //             $documents = [
        //                 // Permis de conduire
        //                 [
        //                     'paper' => BackHelper::getEnvFolder() . 'storage/back/assets/images/doc/1.pdf',
        //                     'number' => random_int(100000, 999999),
        //                     'expiry_date' => Carbon::now()->addYear(),
        //                     'user_id' => $user->id,
        //                     'type_document_id' => $typeDocuments->where('label', 'Permis de conduire')->first()->id,
        //                     'is_validated' => false,
        //                     'is_rejected' => false,
        //                     'slug' => Str::slug($user->email) . '-' . Str::random(5), // Assure un slug unique
        //                     'reason' => null,
        //                     'vehicle_id' => null, // Vehicle_id null pour Permis de conduire
        //                 ],
        //                 // Cip
        //                 [
        //                     'paper' => BackHelper::getEnvFolder() . 'storage/back/assets/images/doc/2.pdf',
        //                     'number' => random_int(100000, 999999),
        //                     'expiry_date' => Carbon::now()->addYears(3),
        //                     'user_id' => $user->id,
        //                     'type_document_id' => $typeDocuments->where('label', 'Cip')->first()->id,
        //                     'is_validated' => false,
        //                     'is_rejected' => false,
        //                     'slug' => Str::slug($user->email) . '-' . Str::random(5), // Assure un slug unique
        //                     'reason' => null,
        //                     'vehicle_id' => null, // Vehicle_id null pour Cip
        //                 ],
        //                 // Autres documents, donc avec vehicle_id non null
        //                 [
        //                     'paper' => BackHelper::getEnvFolder() . 'storage/back/assets/images/doc/3.pdf',
        //                     'number' => random_int(100000, 999999),
        //                     'expiry_date' => Carbon::now()->addYear(),
        //                     'user_id' => $user->id,
        //                     'type_document_id' => $typeDocuments->where('label', 'Carte grise')->first()->id,
        //                     'is_validated' => false,
        //                     'is_rejected' => false,
        //                     'slug' => Str::slug($user->email) . '-' . Str::random(5), // Assure un slug unique
        //                     'reason' => null,
        //                     'vehicle_id' => $vehicles->random()->id, // Vehicle_id non null pour Carte grise
        //                 ],
        //                 [
        //                     'paper' => BackHelper::getEnvFolder() . 'storage/back/assets/images/doc/4.pdf',
        //                     'number' => random_int(100000, 999999),
        //                     'expiry_date' => Carbon::now()->addYear(),
        //                     'user_id' => $user->id,
        //                     'type_document_id' => $typeDocuments->where('label', 'Assurance')->first()->id,
        //                     'is_validated' => false,
        //                     'is_rejected' => false,
        //                     'slug' => Str::slug($user->email) . '-' . Str::random(5), // Assure un slug unique
        //                     'reason' => null,
        //                     'vehicle_id' => $vehicles->random()->id, // Vehicle_id non null pour Assurance
        //                 ],
        //                 [
        //                     'paper' => BackHelper::getEnvFolder() . 'storage/back/assets/images/doc/5.pdf',
        //                     'number' => random_int(100000, 999999),
        //                     'expiry_date' => Carbon::now()->addYear(),
        //                     'user_id' => $user->id,
        //                     'type_document_id' => $typeDocuments->where('label', 'Contrôle technique')->first()->id,
        //                     'is_validated' => false,
        //                     'is_rejected' => false,
        //                     'slug' => Str::slug($user->email) . '-' . Str::random(5), // Assure un slug unique
        //                     'reason' => null,
        //                     'vehicle_id' => $vehicles->random()->id, // Vehicle_id non null pour Contrôle technique
        //                 ]
        //             ];

        //             // Création des documents pour l'utilisateur
        //             foreach ($documents as $document) {
        //                 Document::create($document);
        //             }
        //         }
        //     }

        //     // Si l'utilisateur a le rôle 'passenger'
        //     if ($user->hasRole('passenger')) {
        //         if ($typeDocuments->isNotEmpty()) {
        //             $documents = [
        //                 // Cip seulement pour les passengers
        //                 [
        //                     'paper' => BackHelper::getEnvFolder() . 'storage/back/assets/images/doc/2.pdf',
        //                     'number' => random_int(100000, 999999),
        //                     'expiry_date' => Carbon::now()->addYears(3),
        //                     'user_id' => $user->id,
        //                     'type_document_id' => $typeDocuments->where('label', 'Cip')->first()->id,
        //                     'is_validated' => false,
        //                     'is_rejected' => false,
        //                     'slug' => Str::slug($user->email) . '-' . Str::random(5), // Assure un slug unique
        //                     'reason' => null,
        //                     'vehicle_id' => null, // Vehicle_id null pour Cip
        //                 ]
        //             ];

        //             // Création des documents pour l'utilisateur
        //             foreach ($documents as $document) {
        //                 Document::create($document);
        //             }
        //         }
        //     }
        // }

        }
    }




