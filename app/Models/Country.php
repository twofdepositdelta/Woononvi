<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'name',
        'code', // Si vous avez un code de pays
        'icon', // Si vous avez un attribut pour l'icône
        'status', // Pour l'état d'activation
    ];

    /**
     * Relation avec le modèle City.
     * Un pays peut avoir plusieurs villes.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}