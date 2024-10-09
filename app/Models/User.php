<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'firstname',
        'lastname',
        'phone',
        'date_of_birth',
        'city_id', // Assurez-vous que ce champ correspond au nom de la clé étrangère
        'gender',
        'npi',
        'is_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function city()
    {
        return $this->belongsTo(City::class); // Assurez-vous d'importer le modèle City
    }

    public function rides()
    {
        return $this->hasMany(Ride::class); // Assurez-vous d'importer le modèle Booking
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class); // Assurez-vous d'importer le modèle Booking
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); // Assurez-vous d'importer le modèle Booking
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class); // Assurez-vous d'importer le modèle Booking
    }

    public function profile()
    {
        return $this->hasOne(Profile::class); // Assurez-vous d'importer le modèle Booking
    }

    public function ride_requests()
    {
        return $this->hasMany(RideRequest::class); // Assurez-vous d'importer le modèle Booking
    }

    public function ride_matches()
    {
        return $this->hasMany(RideMatch::class); // Assurez-vous d'importer le modèle Booking
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class); // Assurez-vous d'importer le modèle Booking
    }

    public function preferences()

   {
        return $this->hasMany(Prefernce::class); // Assurez-vous d'importer le modèle Booking
    }
}