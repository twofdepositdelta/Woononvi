<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Document;
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
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->get();
        $typeDocuments = TypeDocument::all();
    foreach ($users as $user) {
        if ( $typeDocuments->isNotEmpty()) {
            $documents = [
                [
                    'paper' => 'Permis de conduire numérique',
                    'number' => random_int(100000, 999999), // Génère un nombre unique
                    'expiry_date' => Carbon::now()->addYear(),
                    'user_id' => $user->id,
                    'type_document_id' => $typeDocuments->where('label', 'Permis de conduire')->first()->id,
                    'is_validated' => false,
                    'is_rejected'=>false,
                    'slug' => Str::slug(random_int(100000, 999999)),// Génère un slug unique
                    'reason'=>null
                ],
                [
                    'paper' => 'Carte grise',
                    'number' => random_int(100000, 999999), // Génère un nombre unique
                    'expiry_date' => Carbon::now()->addYears(3),
                    'user_id' => $user->id,
                    'type_document_id' => $typeDocuments->where('label', 'Carte grise')->first()->id,
                    'is_validated' => false,
                    'is_rejected'=>false,
                    'slug' => Str::slug(random_int(100000, 999999)), // Génère un slug unique
                    'reason'=> null
                ]
            ];

            foreach ($documents as $document) {
                Document::create($document);
            }
        }
        }
    }
}

