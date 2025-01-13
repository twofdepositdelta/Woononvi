<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelSpatial\Casts\LocationCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RideRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_location_name',
        'start_location',
        'end_location_name',
        'end_location',
        'seats',
        'preferred_time',
        'preferred_amount',
        'commission_rate',
        'status',
        'mode',
        'passenger_id',
        'driver_id',
        'accepted_at',
        'rejected_at',
        'is_by_passenger_at',
        'is_by_driver_at',
        'refunded_at',
        'cancelled_at',
    ];

    protected $casts = [
        'start_location' => LocationCast::class,
        'end_location' => LocationCast::class
    ];

    // Relation avec le passager (utilisateur)
    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id'); // Assurez-vous d'importer le modèle User
    }

    // Relation avec le passager (utilisateur)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id'); // Assurez-vous d'importer le modèle User
    }
}
