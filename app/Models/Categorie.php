<?php

namespace App\Models;

use App\Models\TypeVehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'label',
        'slug',
    ];

    public function typeVehicles()
    {
        return $this->hasMany(TypeVehicle::class, 'type_vehicle_id');
    }
}
