<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'paper',
        'number',
        'expiry_date',
        'user_id', // Clé étrangère pour l'utilisateur
        'type_document_id', // Clé étrangère pour le type de document
        'is_validated',
        'slug',
        'reason',
        'is_rejected'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Assurez-vous d'importer le modèle User
    }

    // Relation avec le type de document
    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class); // Assurez-vous d'importer le modèle TypeDocument
    }
}
