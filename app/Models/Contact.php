<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'subject',
        'message',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
