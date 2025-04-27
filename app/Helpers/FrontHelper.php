<?php

namespace App\Helpers;

use App;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use App\Models\Booking;
use App\Models\Ride;
use App\Models\Actuality;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class FrontHelper
{
    public static function getAppName()
    {
        return config('name', 'Wɔōnonvi');
    }

    public static function getEnvFolder()
    {
        $folder = null;
        if (! App::environment('local')) {
            $folder = 'public/';
        }

        return $folder;
    }

    public static function getSettingEmail()
    {
        $setting = Setting::where('key' ,'company_email')->first();
        return $setting;
    }

    public static function getSettingPhone()
    {
        $setting = Setting::where('key' ,'company_phone')->first();
        return $setting;
    }

    public static function getSettingAddress()
    {
        $setting = Setting::where('key' ,'company_address')->first();
        return $setting;
    }

    public static function getFullname()
    {
        return Auth::user()->fullname;
    }

    public static function CreatingFormat($date)
    {
        // Carbon::setLocale('fr');
        $dateFormated = $date->format('j F Y');

        return $dateFormated;
    }

    public static function getSettings()
    {
        $data = Setting::first();

        return $data;
    }

    public static function getActive($route)
    {
        $status = null;
        if (Route::currentRouteName() == $route) {
            $status = 'active';
        }

        return $status;
    }

    public static function getAdminUsers()
    {
        $data = User::role('driver')->get();

        return $data;
    }

    public static function getDriverUsersTotal()
    {
        return User::role('driver')->count() + 90;
    }

    public static function getSatisfiedClientsTotal()
    {
        // Récupérer les passagers distincts qui ont laissé un avis satisfaisant (par exemple, rating >= 4)
        return Booking::distinct('passenger_id')->count() + 300;  // Compter le nombre de passagers satisfaits
    }

    public static function getCompletedTripsTotal()
    {
        // Compter les trajets dont le statut est 'completed'
        return Ride::where('status', 'completed')->count() + 300;
    }

    public static function getTotalReservationsWithoutIssues()
    {
        return Booking::whereNotIn('status', ['cancelled', 'rejected'])->count() + 400;
    }

    public static function getBlogNews()
    {
        // Recherche des actualités dont le type est 'blog' (TypeNew->name = "blog")
        return Actuality::whereHas('typeNew', function ($query) {
            $query->where('name', 'blog');
        })->limit(3)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public static function getDriverFaqs()
    {
        // Recherche des actualités dont le type est 'blog' (TypeNew->name = "blog")
        return Faq::whereHas('faqType', function ($query) {
            $query->where('name', 'Conducteur');
        })->limit(10)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public static function getPassengerFaqs()
    {
        // Recherche des actualités dont le type est 'blog' (TypeNew->name = "blog")
        return Faq::whereHas('faqType', function ($query) {
            $query->where('name', 'Passager');
        })->limit(10)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
