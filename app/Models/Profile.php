<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'avatar',
        'bio',
        'identy_card',
        'address',
        'user_id',
        'driver_licence_card'
    ];

    protected $appends = ['avatar_full', 'identity_full'];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assurez-vous d'importer le modèle User
    }

    public function getAvatarFullAttribute()
    {
        return asset('storage/' . $this->avatar);
    }

    // public function getAvatarAttribute()
    // {
    //     return asset('storage/' . $this->avatar);
    // }

    public function getIdentityFullAttribute()
    {
        return asset('storage/' . $this->identy_card);
    }
}