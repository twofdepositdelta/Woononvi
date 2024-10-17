<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle user authentication and return a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()
            ], 422);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if($user->hasrole('passenger|driver')) {
                $token = $user->createToken('mobile--token')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'message' => 'Authentification réussie.',
                    'token' => $token
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Vous n'êtes pas autorisés à vous connecter !",
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Les identifiants ne correspondent pas.'
            ], 401);
        }
    }

    /**
     * Handle user registration and return a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npi' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users',
            'birth_of_date' => 'required|date|max:10',
            'city_id' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'npi' => $request->npi,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'date_of_birth' => $request->birth_of_date,
            'email' => $request->email,
            'city_id' => $request->city_id,
            // 'email_verified_at' => null,
            'password' => Hash::make($request->password),
        ]);

        $token = Str::random(60);

        DB::table('user_confirmations')->insert([
            'user_id' => $user->id,
            'token' => hash('sha256', $token),
            'created_at' => now(),
        ]);

        // Envoyer la notification de confirmation
        $user->sendAccountConfirmationNotification($token);

        $user->assignRole('passenger');

        $token = $user->createToken('mobile--token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie.',
            'token' => $token
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Quelque chose s\'est mal produite !.',
                'errors' => $validator->errors()
            ], 422);
        }

        $userId = $request->user_id;

        $user = User::findOrFail($userId);
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur déconnecté avec succès !'
        ], 200);
    }
}
