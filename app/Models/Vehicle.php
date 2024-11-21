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
        'is_active',
        'status',
        'main_image',
        'driver_id', // Clé étrangère pour le conducteur
        'slug',
        'type_vehicle_id', // Clé étrangère pour le type de véhicule
        'is_active'
    ];

    protected $appends = ['is_active_label', 'status_label'];

    // Relation avec le conducteur (utilisateur)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id'); // Assurez-vous d'importer le modèle User
    }

    // Relation avec le type de véhicule
    public function typeVehicle()
    {
        return $this->belongsTo(TypeVehicle::class);
    }


    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function rides()
    {
        return $this->hasMany(Ride::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function getMainImageAttribute($value)
    {
        return asset($value);
    }

    public function getLogbookAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function getIsActiveLabelAttribute()
    {
        return $this->is_active ? 'Actif' : 'Non actif';
    }

    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Validé' : 'Non validé';
    }
}
