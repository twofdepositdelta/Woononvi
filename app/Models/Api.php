<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    use HasFactory;

    

    // Les colonnes qui peuvent être massivement assignées
    protected $fillable = [
        'maps',
        'feedpay_public',
        'feedpay_private',
        'feedpay_secret',
        'kkiapay_public',
        'kkiapay_private',
        'kkiapay_secret',
    ];
}

