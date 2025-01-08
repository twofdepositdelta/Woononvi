<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_number',
        'seats_reserved',
        'total_price',
        'commission_rate',
        'ride_id',
        'passenger_id',
        'status',
        'passenger_start_location',
        'passenger_start_location_name',
        'passenger_end_location',
        'passenger_end_location_name',
        'accepted_at',
        'cancelled_at',
        'arrived_at',
        'rejected_at',
        'validated_by_passenger_at',
        'validated_by_driver_at',
        'refunded_at',
        'cancelled_at',
        'is_by_passenger',
        'is_by_driver',
        'driving_license_number',
        'in_progress_at'
    ];

    public function ride()
    {
        return $this->belongsTo(Ride::class);
    }

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); // Assurez-vous d'importer le modèle User
    }
}
