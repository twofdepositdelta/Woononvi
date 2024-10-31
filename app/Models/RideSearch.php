<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RideSearch extends Model
{
    //

    use HasFactory;
    protected $fillable = [
        'departure',
        'destination',
        'passenger_id',
    ];

    /**
     * Relation avec le modèle User.
     * Un RideSearch appartient à un utilisateur qui effectue la recherche.
     */
    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }
}
