<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'name',
        'status', // Pour l'état d'activation
        'country_id', // Pour la relation avec le pays
    ];

    /**
     * Relation avec le modèle Country.
     * Une ville appartient à un pays.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relation avec les utilisateurs (une ville peut avoir plusieurs utilisateurs)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}