<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeNew extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description'

    ];

    // Relation avec le modèle Actualite
    public function actualites()
    {
        return $this->hasMany(Actuality::class);
    }
}
