<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRide extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',

    ];
}