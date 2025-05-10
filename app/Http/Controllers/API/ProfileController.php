<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Preference;
use App\Models\Review;
use App\Models\Ride;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npi' => [
                'required',
                'string',
                Rule::unique('users')->ignore($request->user()->id)
            ],
            'lastname' => 'required|min:2|max:255|string',
            'firstname' => 'required|min:2|max:255|string',
            'gender' => 'required|max:255|string',
            'email' => 'required|max:255|email',
            'username' => 'max:255',
            'city_id' => 'required|max:255|string',
            'country_id' => 'required|max:255|string',
            'phone' => [
                'required',
                'string',
                Rule::unique('users')->ignore($request->user()->id)
            ],
            'date_of_birth' => 'required|max:12|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        // Vérification de l'âge de l'utilisateur (doit être au moins 18 ans)
        $birthDate = new \DateTime($request->date_of_birth);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;

        if ($age < 18) {
            return response()->json([
                'success' => false,
                'errors' => ["L'âge doit être supérieur ou égal à 18 ans."],
                'age' => $age
            ], 401); // Statut 401 pour indiquer que l'inscription est refusée
        }

        $user = User::whereEmail($request->email)->first();

        $country = Country::whereIndicatif($request->country_id)->first();
        $city = City::whereName($request->city_id)->first();

        if($user && $country && $city) {
            $user->update([
                'date_of_birth' => $request->date_of_birth,
                'npi' => $request->npi,
                'username' => $request->username,
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'country_id' => $country->id,
                'npi' => $request->npi,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'city_id' => $city->id,
            ]);

            $userArray = $this->formatUserArray($user);

            // $userArray = $user->toArray();

            // unset($userArray['roles']);

            // $userArray['username'] = $userArray['username'] ? $userArray['username'] : '';
            // $userArray['role'] = $user->roles->first() ? $user->roles->first()->name : null;
            // $country = Country::find($user->country_id);
            // $userArray['country_name'] = $user->country_name;
            // $userArray['city_name'] = $user->city_name;
            // $userArray['indicatif'] = $user->country_code;
            // $userArray['phone_number'] = $user->phone_number;

            return response()->json([
                'success' => true,
                'message' => 'Profil modifié avec succès.',
                'user' => $userArray,
                'cities' => City::whereCountryId($country->id)->pluck('name')
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['Il y a un soucis avec les informations de l\'utilisateur.'],
            ], 401);
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

    public function updateWishes(Request $request) {
        // Convertir les valeurs string en booléens pour les champs boolean
        $smokingAllowed = filter_var($request->input('smoking_allowed'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $petAllowed = filter_var($request->input('pet_allowed'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        // Vérifier si les conversions sont valides
        if (is_null($smokingAllowed) || is_null($petAllowed)) {
            return response()->json([
                'success' => false,
                'errors' => ['Valeurs booléennes invalides pour smoking_allowed ou pet_allowed.'],
            ], 422);
        }

        $rules = [
            'music_preference' => 'in:none,soft,loud,all',
            'other_preferences' => 'nullable|string',
            'prefered_amount' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        // Ajouter les champs boolean convertis
        $validatedData = $validator->validated();
        $validatedData['smoking_allowed'] = $smokingAllowed;
        $validatedData['pet_allowed'] = $petAllowed;

        $user = $request->user(); 

        // Récupérer ou créer les préférences pour l'utilisateur
        $preferences = Preference::firstOrCreate(['user_id' => $user->id]);
        
        // Mettre à jour les préférences avec les données validées
        $preferences->update($validatedData);

        // Mettre à jour les préférences avec les données validées
        $preferences->update($validatedData);

        // Retourner une réponse JSON
        return response()->json([
            'success' => true,
            'message' => 'Preférences modifiées avec succès.',
            'data' => $preferences,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}