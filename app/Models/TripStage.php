<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripStage extends Model
{
    protected $fillable = ['trip_id', 'stage'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
