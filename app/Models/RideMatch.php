<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideMatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'match_type',
        'passenger_id', // Clé étrangère pour l'utilisateur qui reçoit la notification
        'ride_id', // Clé étrangère pour le trajet associé
    ];

    // Relation avec l'utilisateur
    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id'); // Assurez-vous d'importer le modèle User
    }

    // Relation avec le trajet
    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id'); // Assurez-vous d'importer le modèle Ride
    }



}