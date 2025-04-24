<?php

namespace App\Models;

use App\Models\Vehicle;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeVehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
        'slug',
        'categorie_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
