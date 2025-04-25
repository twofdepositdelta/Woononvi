<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actuality extends Model
{
    use HasFactory;

    // Champs modifiables
    protected $fillable = [
        'titre',
        'slug',
        'description',
        'image_url',
        'type_new_id',
        'published',
    ];

    // Relation avec le modèle TypeActualite
    public function typeNew()
    {
        return $this->belongsTo(TypeNew::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'actuality_role');
    }

    public function getImageUrlAttribute($value)
    {
        return asset($value);
    }
}