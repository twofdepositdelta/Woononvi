<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'rating',
        'comment',
        'booking_id', // Clé étrangère pour le trajet
        'reviewer_id',// Clé étrangère pour l'utilisateur qui laisse le commentaire
        'reviewer_type'
    ];

    // Relation avec la reservation
    public function booking()
    {
        return $this->belongsTo(Booking::class); // Assurez-vous d'importer le modèle Ride
    }

    // Relation avec l'utilisateur qui a laissé l'avis
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id'); // Assurez-vous d'importer le modèle User
    }
}
