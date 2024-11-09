<?php

namespace Database\Seeders;

use App\Models\TypeDocument;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $types = [
            ['label' => 'Permis de conduire'],
            ['label' => 'Carte grise'],
            ['label' => 'Assurance'],
            ['label' => 'Contrôle technique'],
            ['label' => 'Cip'],
        ];

        foreach ($types as $type) {
            TypeDocument::create($type);
        }
    }
    }

