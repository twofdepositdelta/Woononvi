<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelSpatial\Casts\LocationCast;

class Trip extends Model
{
    protected $fillable = [
        'driver_id', 'type', 'start_location', 'end_location', 'departure_time',
        'days', 'departure_in', 'return_trip', 'departure_time', 'return_time'
    ];

    protected $casts = [
        'days' => 'array',
        'start_location' => LocationCast::class,
        'end_location' => LocationCast::class
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
