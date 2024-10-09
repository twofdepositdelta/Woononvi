<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'ride_id', // Clé étrangère pour le trajet associé
    ];

    // Relation avec le trajet
    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id'); // Assurez-vous d'importer le modèle Ride
    }
}