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
        'numero_ride',
        'driver_id',
        'vehicle_id',
        'type',
        'start_location',
        'start_location_name',
        'end_location',
        'end_location_name',
        'days',
        'return_time',
        'departure_time',
        'price_per_km',
        'available_seats',
        'is_nearby_ride',
        'vehicle_id',
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

    public function getFormattedTypeAttribute()
    {
        // Retourne "Régulier" ou "Ponctuel" en fonction de la valeur du type
        return $this->type == 'regular' ? 'Régulier' : 'Ponctuel';
    }

    public function scopeWithinDistance($query, $latitude, $longitude, $columnLat, $columnLng, $radius = 1)
    {
        return $query
            ->select('*') // Vous pouvez ajuster selon les colonnes nécessaires
            ->selectRaw(
                "(6371 * acos(cos(radians(?)) * cos(radians($columnLat)) * cos(radians($columnLng) - radians(?)) + sin(radians(?)) * sin(radians($columnLat)))) AS distance",
                [$latitude, $longitude, $latitude]
            )
            ->having('distance', '<=', $radius)
            ->orderBy('distance');
    }
}
