<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'passenger_id',
        'driver_id',
        'accepted_at',
        'rejected_at',
        'validated_by_passenger_at',
        'validated_by_driver_at',
        'refunded_at',
        'cancelled_at',
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
