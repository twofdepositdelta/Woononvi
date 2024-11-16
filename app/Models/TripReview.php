<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripReview extends Model
{
    protected $fillable = ['trip_id', 'user_id', 'reviewed_user_id', 'comment', 'rating'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewedUser()
    {
        return $this->belongsTo(User::class, 'reviewed_user_id');
    }
}