<?php

namespace App\Helpers;

use App;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class FrontHelper
{
    public static function getAppName()
    {
        return config('name', 'Citygo');
    }

    public static function getEnvFolder()
    {
        $folder = null;
        if (! App::environment('local')) {
            $folder = 'public/';
        }

        return $folder;
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
}
