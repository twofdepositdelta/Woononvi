<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'reference',
        'payment_number',
        'payment_method',
        'status',
        'booking_id',
        'user_id',
        'payment_type_id',
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
