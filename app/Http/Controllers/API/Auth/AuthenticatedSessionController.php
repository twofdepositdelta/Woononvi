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
use Illuminate\Validation\Rules;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle user authentication and return a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
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

            // Vérification si l'utilisateur est vérifié
            if (!$user->is_verified) {
                return response()->json([
                    'success' => false,
                    'message' => "Votre compte n'est pas encore vérifié.",
                ], 401); // Statut 401 pour indiquer que l'authentification est refusée
            }

            if($user->hasrole('passenger|driver|manager|super-admin')) {
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
            'npi' => 'required|string|max:255|unique:users',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users',
            'birth_of_date' => 'required|date|max:10',
            'city_id' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Vérification de l'âge de l'utilisateur (doit être au moins 18 ans)
        $birthDate = new \DateTime($request->birth_of_date);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;

        if ($age < 18) {
            return response()->json([
                'success' => false,
                'message' => "Vous devez avoir au moins 18 ans pour vous inscrire.",
            ], 401); // Statut 401 pour indiquer que l'inscription est refusée
        }

        $user = User::create([
            'npi' => $request->npi,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'date_of_birth' => $request->birth_of_date,
            'email' => $request->email,
            'city_id' => $request->city_id,
            'password' => Hash::make($request->password),
        ]);

        // $token = Str::random(60);

        // Générer un OTP aléatoire (par exemple, 6 chiffres)
        $otp = rand(100000, 999999);

        DB::table('user_confirmations')->insert([
            'user_id' => $user->id,
            'otp_code' => $otp,
            'created_at' => now(),
        ]);

        // DB::table('user_confirmations')->insert([
        //     'user_id' => $user->id,
        //     'code_otp' => hash('sha256', $token),
        //     'created_at' => now(),
        // ]);

        // Envoyer la notification de confirmation
        $user->sendAccountConfirmationNotification($otp);

        $user->assignRole('passenger');

        // $token = $user->createToken('mobile--token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie.',
        ], 201);
    }
}
