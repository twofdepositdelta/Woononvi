<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'smoking_allowed',
        'music_preference',
        'pet_allowed',
        'other_preferences'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Assurez-vous d'importer le modèle User

    }


}
