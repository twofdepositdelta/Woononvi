<?php

namespace App\Helpers;

use App;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use App\Models\RideSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
}
