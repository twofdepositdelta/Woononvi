<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'avatar',
        'bio',
        'identy_card',
        'address',
        'user_id', // Clé étrangère pour l'utilisateur
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assurez-vous d'importer le modèle User
    }
}