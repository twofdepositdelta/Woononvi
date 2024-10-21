<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    protected $fillable = [
        'departure',
        'destination',
        'departure_time',
        'available_seats',
        'price_per_km',
        'is_nearby_ride',
        'status',
        'driver_id', // Clé étrangère pour le conducteur
    ];

    // Relation avec le conducteur (utilisateur)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id'); // Assurez-vous d'importer le modèle User
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class); // Assurez-vous d'importer le modèle User
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class); // Assurez-vous d'importer le modèle User
    }

    public function ride_matches()
    {
        return $this->hasMany(RideMacth::class); // Assurez-vous d'importer le modèle User
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class); // Assurez-vous d'importer le modèle Booking
    }
}