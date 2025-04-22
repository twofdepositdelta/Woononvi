<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kilometrage extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'min_km',
        'max_km',
        'taux_par_km',
        'categorie_id',
    ];

    /**
     * Relation avec la catégorie.
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

}
