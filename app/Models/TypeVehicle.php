<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
        'taux_per_km',
        'slug',
        'categorie_id'

    ];

    public function Categorie()
    {
        return $this->belongsTo(Categorie::class);
    }


}
