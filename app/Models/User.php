<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomResetPassword;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\AccountConfirmation;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'firstname',
        'lastname',
        'phone',
        'date_of_birth',
        'city_id',
        'gender',
        'npi',
        'is_verified',
        'status',
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
        return $this->hasMany(Ride::class, 'driver_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'passenger_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'driver_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function profile()
    {
        return $this->hasOne(Profile::class); // Assurez-vous d'importer le modèle Booking
    }

    public function ride_requests()
    {
        return $this->hasMany(RideRequest::class, 'passenger_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function ride_matches()
    {
        return $this->hasMany(RideMatch::class, 'passenger_id'); // Assurez-vous d'importer le modèle Booking
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class); // Assurez-vous d'importer le modèle Booking
    }

    public function preferences()
    {
        return $this->hasMany(Preference::class); // Assurez-vous d'importer le modèle Booking
    }

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new CustomResetPassword($token));
    // }

    public function sendAccountConfirmationNotification($token)
    {
        $this->notify(new AccountConfirmation($this, $token));
    }
}