<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ride;
use App\Models\City;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Document;
use App\Models\Country;
use App\Models\Preference;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

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
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'reason' => false,
                // 'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Vérification si l'utilisateur est vérifié
            if (!$user->is_verified) {
                return response()->json([
                    'success' => false,
                    'reason' => true,
                    'errors' => ["Votre compte n'est pas encore vérifié."],
                ], 401); // Statut 401 pour indiquer que l'authentification est refusée
            }

            $token = $user->createToken('mobile--token')->plainTextToken;

            if(!$user->npi || !$user->gender || !$user->city_id || !$user->date_of_birth) {
                $role = $user->roles->first() ? $user->roles->first()->name : null;
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'reason' => true,
                    'role' => $role,
                    'errors' => ["Veuillez finaliser votre compte afin de continuer."],
                    'cities' => City::whereCountryId($user->country_id)->get(),
                ], 200);
            }

            if($user->hasrole('passenger|driver|manager|super-admin')) {
                $token = $user->createToken('mobile--token')->plainTextToken;

                // Appeler la méthode privée pour formater l'utilisateur
                $userArray = $this->formatUserArray($user);

                return response()->json([
                    'success' => true,
                    'reason' => false,
                    'token' => $token,
                    'user' => $userArray,
                    'message' => 'Authentification réussie.',
                    'cities' => City::whereCountryId($user->country_id)->pluck('name')
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'errors' => ["Vous n'êtes pas autorisés à vous connecter !"],
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['Les identifiants ne correspondent pas.']
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
                // 'message' => 'Revoyez les champs svp.',
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

        $role = Role::findByName($role, 'api');
        $user->assignRole($role);

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie, veuillez confirmer votre adresse email à travers le code OTP envoyé.',
        ], 201);
    }

    public function finalise(Request $request) {
        $rules = [
            // 'gender' => ['required', 'string', Rule::in(['Masculin', 'Féminin', 'Autres'])],
            // // Validation du NPI (numéro d'identification professionnel)
            // 'npi' => [
            //     'required',
            //     'string',
            //     'regex:/^\d{8,13}$/', // Entre 8 et 13 chiffres
            //     'unique:users,npi' . (isset($this->user) ? ',' . $this->user->id : ''),
            // ],
            // // Date de naissance avec vérification d'âge minimum
            // 'birth_of_date' => [
            //     'required',
            //     'date',
            //     'before:' . now()->subYears(18)->format('Y-m-d'), // Vérifier que l'utilisateur a au moins 18 ans
            // ],
            // // Date d'expiration avec vérification qu'elle est dans le futur
            // 'expiry_date' => [
            //     'required',
            //     'date',
            //     'after:today', // S'assurer que la date d'expiration est future
            // ],
            // 'city_id' => [
            //     'required',
            //     'string',
            //     'exists:cities,id', // Vérifier que la ville existe dans la base de données
            // ],
            // // Fichier NPI limité en taille et format
            // 'npi_file' => [
            //     'required',
            //     'file',
            //     'mimes:pdf',
            //     'max:6000', // 6 MB max
            // ],
            // // Avatar avec validation de dimensions et taille
            // 'avatar' => [
            //     'required',
            //     'file',
            //     'mimes:jpeg,png,jpg,gif',
            //     'max:6000', // 2 MB max, réduit de 6 MB
            // ],
            'gender' => 'required|string|max:255',
            'npi' => 'required|string|min:8|max:13|unique:users',
            'birth_of_date' => 'required|date',
            'expiry_date' => 'required|date',
            'city_id' => 'required',
            'npi_file' => 'required|mimes:pdf|max:6000',
            'avatar' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:6000',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }
    
        // Vérification de l'âge de l'utilisateur
        $birthDate = new \DateTime($request->birth_of_date);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;
    
        if ($age < 18) {
            return response()->json([
                'success' => false,
                'errors' => ["Vous devez avoir au moins 18 ans pour continuer."],
                'age' => $age,
            ], 401);
        }
    
        $user = $request->user();
    
        $npiPath = $request->hasFile('npi_file')
            ? $request->file('npi_file')->store("api/users/$user->id/documents", 'public')
            : null;
    
        $avatarPath = $request->hasFile('avatar')
            ? $request->file('avatar')->store("api/users/$user->id/documents", 'public')
            : null;
    
        Profile::create([
            'user_id' => $user->id,
            'avatar' => $avatarPath,
            //'identy_card' => $npiPath
        ]);

        Preference::create([
            'user_id' => Auth::id()
        ]);
        
        $type = 1;
        if($user->roles->first()->name == "driver")
            $type = 1;
        else
            $type = 5;

        $number = Str::random(8);
        $document = Document::create([
            'slug' => Str::slug($number),
            'number' => $request->npi,
            'paper' => $npiPath,
            'user_id' => Auth::id(),
            'type_document_id' => $type,
            'expiry_date' => $request->expiry_date,
        ]);
    
        $city = City::whereName($request->city_id)->first();
    
        $user->update([
            'date_of_birth' => $request->birth_of_date,
            'npi' => $request->npi,
            'gender' => $request->gender,
            'city_id' => $city->id,
        ]);
        
        $userArray = $this->formatUserArray($user);
    
        return response()->json([
            'success' => true,
            'message' => 'Votre inscription a été finalisée avec succès.',
            'user' => $userArray,
            'cities' => City::whereCountryId($user->country_id)->pluck('name'),
        ], 201);
    }
    

    public function verifyOtp(Request $request) {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|integer|digits:4',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user = User::whereEmail($request->email)->first();

        if($user) {
            $otp = DB::table('user_confirmations')
                ->orderBy('id', 'desc')
                ->where('user_id', $user->id)
                ->where('otp_code', $request->otp)
                ->where('expired_at', '>', Carbon::now())
                ->first();

            if (!$otp) {
                return response()->json([
                    'success' => false,
                    'errors' => ['OTP invalide ou expiré !'],
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
                'errors' => ['Nom d\'utilisateur invalide !'],
            ], 422);
        }
    }

    public function formatUserArray(User $user)
    {
        $user->load(['profile', 'preferences', 'vehicles']);

        $userArray = $user->toArray();

        unset($userArray['roles']); // Assurez-vous que ceci est avant le return

        $userArray['username'] = $userArray['username'] ?? '';
        $userArray['role'] = $user->roles->first() ? $user->roles->first()->name : null;

        $userArray['country_name'] = $user->country_name;
        $userArray['city_name'] = $user->city_name;
        $userArray['indicatif'] = $user->country_code;
        $userArray['phone_number'] = $user->phone_number;

        $userArray['profile'] = $user->profile ? $user->profile->toArray() : null;
        $userArray['preferences'] = $user->preferences ? $user->preferences->toArray() : null;

        // Calcul de la note moyenne en tant que passager et conducteur
        $userArray['average_rating_as_passenger'] = $this->getAverageRating($user, 'passenger');
        $userArray['average_rating_as_driver'] = $this->getAverageRating($user, 'driver');

        // Calcul du nombre de covoiturages passés en tant que passager et conducteur
        $userArray['completed_rides_as_passenger'] = $this->getCompletedRidesCount($user, 'passenger');
        $userArray['completed_rides_as_driver'] = $this->getCompletedRidesCount($user, 'driver');

        $vehicles = $user->vehicles()->withCount('rides')->get();

        $userArray['vehicles_count'] = $vehicles->count();
        $userArray['vehicles'] = $user->vehicles;
        $userArray['total_rides_count'] = $vehicles->sum('rides_count');

        $rides = Ride::query()->whereDriverId($user->id)->get();
        $userArray['rides'] = $rides;

        // $userArray['vehicles'] = $vehicles->map(function ($vehicle) {
        //     return [
        //         'id' => $vehicle->id,
        //         'model' => $vehicle->model,
        //         'rides_count' => $vehicle->rides_count, // Correction ici
        //     ];
        // });

        return $userArray;
    }

    // Méthode pour calculer le nombre de covoiturages passés de l'utilisateur (en tant que passager ou conducteur)
    private function getCompletedRidesCount(User $user, $role)
    {
        if ($role == 'passenger') {
            // Nombre de réservations où l'utilisateur est un passager et où le statut est "completed"
            return Booking::where('passenger_id', $user->id)
                        ->where('status', 'completed')->OrWhere('status', '')
                        ->count();
        } elseif ($role == 'driver') {
            // Nombre de réservations où l'utilisateur est un conducteur et où le statut est "completed"
            return Ride::where('driver_id', $user->id)
                        ->whereHas('bookings', function($query) {
                            $query->where('status', 'completed')->OrWhere('status', '');
                        })
                        ->count();
        }

        return 0;
    }

    // Méthode pour calculer la note moyenne de l'utilisateur
    private function getAverageRating(User $user, $reviewerType)
    {
        $averageRating = Review::where('reviewer_id', $user->id)
                                ->where('reviewer_type', $reviewerType)
                                ->avg('rating');
        return round($averageRating * 2) / 2;
    }
}
