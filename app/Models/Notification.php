<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'user_id', // Clé étrangère pour l'utilisateur qui reçoit la notification
        'ride_id', // Clé étrangère pour le trajet associé
        'notification_type',
        'is_read', // Indicateur si la notification a été lue
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