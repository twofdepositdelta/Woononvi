<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'passenger_id',
        'driver_id',
        'ride_id',
        'amount',
        'platform_fee',
        'commission',
        'status',
        'payment_method',
        'transaction_reference',
    ];

     // Relation avec le passager
     public function passenger()
     {
         return $this->belongsTo(User::class, 'passenger_id');
     }

     // Relation avec le conducteur
     public function driver()
     {
         return $this->belongsTo(User::class, 'driver_id');
     }

     // Relation avec le trajet
     public function ride()
     {
         return $this->belongsTo(Ride::class);
     }

}
