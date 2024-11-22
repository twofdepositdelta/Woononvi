<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppNotification extends Model
{
    use HasFactory;
    protected $table = 'notifications'; 
    protected $fillable = [
        'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
        'ride_id',
        'notification_type',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assurez-vous d'importer le modèle User
    }

    // Relation avec le trajet
    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id'); // Assurez-vous d'importer le modèle Ride
    }



}
