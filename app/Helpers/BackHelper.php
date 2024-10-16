<?php

namespace App\Helpers;

use App;
use App\Models\Setting;
use Carbon\Carbon;
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
}