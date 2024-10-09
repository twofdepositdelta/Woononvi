<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'licence_plate',
        'vehicle_mark',
        'vehicle_model',
        'vehicle_year',
        'seats',
        'logbook',
        'color',
        'main_image',
        'driver_id', // Clé étrangère pour le conducteur
        'type_vehicle_id', // Clé étrangère pour le type de véhicule
    ];

    // Relation avec le conducteur (utilisateur)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id'); // Assurez-vous d'importer le modèle User
    }

    // Relation avec le type de véhicule
    public function typeVehicle()
    {
        return $this->belongsTo(TypeVehicle::class); // Assurez-vous d'importer le modèle TypeVehicle
    }


    public function images()
    {
        return $this->hasMany(Image::class); // Assurez-vous d'importer le modèle TypeVehicle
    }
}