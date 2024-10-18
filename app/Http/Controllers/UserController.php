<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log; // Ajoutez ceci
use App\Helpers\BackHelper;

class UserController extends Controller
{
    public function checkUsername(Request $request)
    {
        $username = $request->query('username');
        $isUnique = !User::where('username', $username)->exists();

        return response()->json(['isUnique' => $isUnique]);
    }
}
