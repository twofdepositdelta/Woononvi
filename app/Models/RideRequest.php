<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'departure',
        'destination',
        'preferred_time',
        'preferred_amount',
        'status',
        'passenger_id', // Clé étrangère pour le passager
    ];

    // Relation avec le passager (utilisateur)
    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id'); // Assurez-vous d'importer le modèle User
    }
}