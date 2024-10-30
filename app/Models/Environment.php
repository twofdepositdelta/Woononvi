<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Environment extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'environment_type',

    ];
}
