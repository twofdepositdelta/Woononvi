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
    public function typeactualite()
    {
        return $this->belongsTo(TypeNew::class, 'type_new_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'actuality_role');
    }
}