<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripMessage extends Model
{
    protected $fillable = ['trip_id', 'sender_id', 'receiver_id', 'message'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}