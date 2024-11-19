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
        'payment_number',
        'status',
        'booking_id', // Clé étrangère pour la réservation
        'user_id',
        'payment_type_id'
    ];

    // Relation avec la réservation
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function typepayment()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id'); // Assurez-vous d'importer le modèle Booking
    }
}
