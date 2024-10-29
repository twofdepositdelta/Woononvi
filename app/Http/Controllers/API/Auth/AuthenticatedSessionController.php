<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\City;
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
            'npi' => 'required_if:step,2|string|max:255|unique:users',
            'firstname' => 'required_if:step,1|string|max:255',
            'lastname' => 'required_if:step,1|string|max:255',
            'phone' => 'required_if:step,1|string|max:255|unique:users',
            'birth_of_date' => 'required_if:step,2|date|max:10',
            'city_id' => 'required_if:step,2|string|max:255',
            'role' => 'required_if:step,1|string|max:255',
            'email' => 'required_if:step,2|string|email|max:255|unique:users',
            'password' => ['required_if:step,1', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        if($request->step != 1) {
            // Vérification de l'âge de l'utilisateur (doit être au moins 18 ans)
            $birthDate = new \DateTime($request->birth_of_date);
            $today = new \DateTime();
            $age = $today->diff($birthDate)->y;

            if ($age < 18) {
                return response()->json([
                    'success' => false,
                    'message' => "Vous devez avoir au moins 18 ans pour vous inscrire.",
                    'age' => $age
                ], 401); // Statut 401 pour indiquer que l'inscription est refusée
            }
        }

        $city = City::whereIndicatif($request->city_id)->first();

        $user = User::create([
            // 'step' => $request->step,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'city_id' => $city->id
        ]);

        if($request->step == 1) {
            // Générer un OTP aléatoire (par exemple, 6 chiffres)
            $otp = rand(100000, 999999);

            DB::table('user_confirmations')->insert([
                'user_id' => $user->id,
                'otp_code' => $otp,
                'created_at' => now(),
            ]);

            // Envoyer la notification de confirmation
            $user->sendAccountConfirmationNotification($otp);

            $role = $request->role == "Passager" ? "passenger" : "driver";

            $user->assignRole($role);

            // $token = $user->createToken('mobile--token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Inscription réussie.',
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Vous vous êtes déjà inscrits.',
            ], 201);
        }
    }
}
