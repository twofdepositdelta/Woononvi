<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    // Relation avec les utilisateurs (une ville peut avoir plusieurs utilisateurs)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}