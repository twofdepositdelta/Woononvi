<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'seats_reserved',
        'total_price',
        'status',
        'ride_id', // Clé étrangère pour le trajet
        'passenger_id', // Clé étrangère pour le passager
    ];

    // Relation avec le trajet
    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id'); // Assurez-vous d'importer le modèle Ride
    }

    // Relation avec le passager
    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id'); // Assurez-vous d'importer le modèle User
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id'); // Assurez-vous d'importer le modèle Booking
    }
}