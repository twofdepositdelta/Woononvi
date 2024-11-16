<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'seats_reserved',
        'total_price',
        'status',
        'trip_id', // Clé étrangère pour le trajet
        'passenger_id', // Clé étrangère pour le passager
        'booking_number'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    // protected $fillable = [
    //     'seats_reserved',
    //     'total_price',
    //     'status',
    //     'ride_id', // Clé étrangère pour le trajet
    //     'passenger_id', // Clé étrangère pour le passager
    //     'booking_number'
    // ];

    // Relation avec le trajet
    // public function ride()
    // {
    //     return $this->belongsTo(Ride::class); // Assurez-vous d'importer le modèle Ride
    // }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); // Assurez-vous d'importer le modèle User
    }
}
