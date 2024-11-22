<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Preference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
                'size:9',
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
                'max:13',
                'string',
                Rule::unique('users')->ignore($request->user()->id)
            ],
            'date_of_birth' => 'required|max:12|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
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
                'message' => "L'âge doit être supérieur ou égal à 18 ans.",
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
                'message' => 'Profil modifié avec succès.',
                'user' => $userArray,
                'cities' => City::whereCountryId($country->id)->pluck('name')
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Il y a un soucis avec les informations de l\'utilisateur.',
            ], 401);
        }
    }

    public function updateWishes(Request $request) {
        return $request;
        $rules = [
            'smoking_allowed' => 'boolean',
            'music_preference' => 'in:none,soft,loud,all',
            'pet_allowed' => 'boolean',
            'other_preferences' => 'nullable|string',
            'prefered_amount' => 'numeric|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user = $request->user(); 

        // Récupérer ou créer les préférences pour l'utilisateur
        $preferences = Preference::firstOrCreate(['user_id' => $user->id]);

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