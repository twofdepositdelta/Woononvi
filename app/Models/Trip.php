<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'driver_id', 'type', 'start_location', 'end_location',
        'days', 'departure_in', 'return_trip', 'departure_time', 'arrival_time'
    ];

    protected $casts = [
        'days' => 'array',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function stages()
    {
        return $this->hasMany(TripStage::class);
    }
}
