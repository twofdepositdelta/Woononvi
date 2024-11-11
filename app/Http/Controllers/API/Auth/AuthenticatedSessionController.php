<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\Preference;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

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
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'reason' => false,
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
                    'reason' => true,
                    'message' => "Votre compte n'est pas encore vérifié.",
                ], 401); // Statut 401 pour indiquer que l'authentification est refusée
            }

            $token = $user->createToken('mobile--token')->plainTextToken;

            if(!$user->npi || !$user->gender || !$user->city_id || !$user->date_of_birth) {
                return response()->json([
                    'success' => true,
                    'cities' => City::whereCountryId($user->country_id)->get(),
                    'token' => $token,
                    'reason' => true,
                    'message' => "Veuillez finaliser votre compte afin de continuer.",
                ], 200);
            }

            if($user->hasrole('passenger|driver|manager|super-admin')) {
                $token = $user->createToken('mobile--token')->plainTextToken;

                $userArray = $user->toArray();

                unset($userArray['roles']);

                $userArray['username'] = $userArray['username'] ? $userArray['username'] : '';
                $userArray['role'] = $user->roles->first() ? $user->roles->first()->name : null;
                $country = Country::find($user->country_id);
                $userArray['country_name'] = $user->country_name;
                $userArray['city_name'] = $user->city_name;
                $userArray['indicatif'] = $user->country_code;
                $userArray['phone_number'] = $user->phone_number;

                return response()->json([
                    'success' => true,
                    'reason' => false,
                    'message' => 'Authentification réussie.',
                    'token' => $token,
                    'user' => $userArray,
                    'cities' => City::whereCountryId($user->country_id)->pluck('name')
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
        $rules = [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users',
            'country_id' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $country = Country::whereIndicatif($request->country_id)->first();

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country_id' => $country->id
        ]);

        // Générer un OTP aléatoire (par exemple, 6 chiffres)
        $otp = rand(1000, 9999);

        DB::table('user_confirmations')->insert([
            'user_id' => $user->id,
            'otp_code' => $otp,
            'expired_at' => Carbon::now()->addMinutes(60),
            'created_at' => now(),
        ]);

        // Envoyer la notification de confirmation
        $user->sendAccountConfirmationNotification($otp);

        $role = $request->role == "Passager" ? "passenger" : "driver";

        $user->assignRole($role, 'admin');

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie, veuillez confirmer votre adresse email à travers le code OTP envoyé.',
        ], 201);
    }

    public function finalise(Request $request) {
        $rules = [
            'gender' => 'required|string|max:255',
            'npi' => 'required|string|size:9|unique:users',
            'birth_of_date' => 'required|date|max:10',
            'city_id' => 'required|string|max:255',
            'email' => 'required|string|email|max:255', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        // Vérification de l'âge de l'utilisateur (doit être au moins 18 ans)
        $birthDate = new \DateTime($request->birth_of_date);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;

        if ($age < 18) {
            return response()->json([
                'success' => false,
                'message' => "Vous devez avoir au moins 18 ans pour continuer.",
                'age' => $age
            ], 401); // Statut 401 pour indiquer que l'inscription est refusée
        }

        $user = User::whereEmail($request->email)->first();
        $city = City::whereName($request->city_id)->first();

        if($user) {
            $user->update([
                'date_of_birth' => $request->birth_of_date,
                'npi' => $request->npi,
                'gender' => $request->gender,
                'city_id' => $city->id,
            ]);

            Preference::create([
                'user_id' => $user->id,
            ]);

            $userArray = $user->toArray();

            unset($userArray['roles']);

            $userArray['username'] = $userArray['username'] ? $userArray['username'] : '';
            $userArray['role'] = $user->roles->first() ? $user->roles->first()->name : null;
            $country = Country::find($user->country_id);
            $userArray['country_name'] = $user->country_name;
            $userArray['city_name'] = $user->city_name;
            $userArray['indicatif'] = $user->country_code;
            $userArray['phone_number'] = $user->phone_number;

            return response()->json([
                'success' => true,
                'message' => 'Votre inscription a été finalisée avec succès.',
                'user' => $userArray,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Il y a un souci avec l\'utilisateur.',
            ], 422);
        }
    }

    public function verifyOtp(Request $request) {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|integer|size:4',
            'email' => 'required|email|max:255',
        ]);

        $user = User::whereEmail($request->email)->first();

        if($user) {
            $otp = DB::table('user_confirmations')
                ->where('user_id', $user->id)
                ->where('otp_code', $request->otp)
                ->where('expired_at', '>', Carbon::now())
                ->first();

            if (!$otp) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP invalide ou expiré !',
                ], 422);
            }

            $user->email_verified_at = Carbon::now();
            $user->is_verified = true;
            $user->balance = 0;
            $user->save();

            // Supprimer l'OTP après vérification
            DB::table('user_confirmations')
                ->where('user_id', $user->id)
                ->where('otp_code', $request->otp)
                ->where('expired_at', '>', Carbon::now())
                ->delete();

            return response()->json([
                'success' => true,
                'user' => $user,
                'message' => 'E-mail vérifié avec succès !',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nom d\'utilisateur invalide !',
            ], 422);
        }
    }
}
