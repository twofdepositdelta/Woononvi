<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelSpatial\Traits\HasSpatial;
use TarfinLabs\LaravelSpatial\Casts\LocationCast;

class Ride extends Model
{
    use HasFactory;
    protected $fillable = [
        'driver_id',
        'type',
        'start_location',
        'end_location',
        'days',
        'return_trip',
        'return_time',
        'departure_time',
        'arrival_time',
        'price_per_km',
        'is_nearby_ride',
        'commission_rate',
        'status',
    ];

    protected $casts = [
        'days' => 'array',
        'start_location' => LocationCast::class,
        'end_location' => LocationCast::class
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


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id'); // Assurez-vous d'importer le modèle User
    }
}
