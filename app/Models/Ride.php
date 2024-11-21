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

    function isDepartureMatching($passengerStart, $driverStart, $radius = 500)
    {
        // Calculez la distance entre le point de départ du passager et celui du conducteur
        $startDistance = calculateDistance("$passengerStart[lat],$passengerStart[lng]", "$driverStart[lat],$driverStart[lng]");

        // Vérifiez si la distance est dans le rayon acceptable
        return $startDistance <= $radius;
    }

    function calculateDistance($origin, $destination)
    {
        $apiKey = 'AIzaSyDcA6TWg_F0YRmwkoiBLQNQEA9m69aLgQY';
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json";

        $response = Http::get($url, [
            'origins' => $origin,
            'destinations' => $destination,
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['rows'][0]['elements'][0]['distance'])) {
                return $data['rows'][0]['elements'][0]['distance']['value']; // Distance en mètres
            }
        }

        return null; // Erreur ou absence de données
    }
}
