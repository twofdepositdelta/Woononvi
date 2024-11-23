<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelSpatial\Traits\HasSpatial;
use TarfinLabs\LaravelSpatial\Casts\LocationCast;
use Illuminate\Database\Eloquent\Builder;

class Ride extends Model
{
    use HasFactory, HasSpatial;

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
        'total_price',
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
        return $this->hasMany(AppNotification::class); // Assurez-vous d'importer le modèle Booking
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

    public static function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Rayon de la Terre en mètres.

        // Convertir les degrés en radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Calculer la différence des coordonnées
        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        // Appliquer la formule de Haversine
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Calculer la distance
        $distance = $earthRadius * $c; // en mètres

        return $distance;
    }

    public static function filterRidesByDistance($rides, $lat, $lng, $radius = 500)
    {
        return $rides->filter(function ($ride) use ($lat, $lng, $radius) {
            // Calculer la distance entre le point de départ et le trajet
            $distance = self::haversine($lat, $lng, $ride->start_location->getLat(), $ride->start_location->getLng());

            // Conserver le trajet si la distance est inférieure ou égale au rayon
            return $distance <= $radius;
        });
    }

}
