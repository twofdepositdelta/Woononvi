<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'total_price',
        'payment_method',
        'status',
        'booking_id', // Clé étrangère pour la réservation
    ];

    // Relation avec la réservation
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id'); // Assurez-vous d'importer le modèle Booking
    }
}