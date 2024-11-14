<?php

namespace App\Helpers;

use App;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use App\Models\RideSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\City;
use App\Models\Country;
use App\Models\Ride;
use App\Models\Booking;
use App\Models\RideRequest;

class BackHelper
{
    public static function getEnvFolder()
    {
        $folder = null;
        if (! App::environment('local')) {
            $folder = 'public/';
        }

        return $folder;
    }

    public static function getFullname(User $user)
    {
        return strtoupper($user->firstname) . ' ' . ucfirst(strtolower($user->lastname));
    }

    public static function deleteOldSearches()
    {
        // Récupère la date d'un an en arrière
        $oneYearAgo = Carbon::now()->subYear();

        // Supprime les recherches plus anciennes d'un an
        RideSearch::where('created_at', '<', $oneYearAgo)->delete();
    }

    public static function getSetting()
    {
        $setting = Setting::where('key' ,'company_name')->first();
        return $setting;
    }

    // Les statistiques

    // 1 . Nombre des utilisateurs

    public static function getUsersTotal()
    {
        return User::count();
    }

    public static function getPassengersTotal()
    {
        $total = User::role('passenger')->count();

        return $total;
    }

    public static function getDriversTotal()
    {
        $total = User::role('driver')->count();

        return $total;
    }

    // 2 . Trajet

    public static function getRidesTotal()
    {
        return Ride::count();
    }

    public static function getRidesActive()
    {
        $now = Carbon::now();  // Récupérer la date et l'heure actuelles

        // Récupérer les trajets créés aujourd'hui
        $rides = Ride::where('status', 'active')->get();

        // Compter les trajets
        $total = $rides->count();

        return $total;
    }

    public static function getBooking()
    {
        $total = Booking::count();

        return $total;
    }

    public static function getRideRequest()
    {
        $total = RideRequest::count();

        return $total;
    }
}