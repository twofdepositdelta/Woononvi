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
                'errors' => ['Il y a un soucis avec les informations de l\'utilisateur.'],
            ], 401);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function finalise(Request $request) {
        $rules = [
            'gender' => 'required|string|max:255',
            'npi' => 'required|string|max:255|unique:users',
            'birth_of_date' => 'required|date',
            'city_id' => 'required|string|max:255',
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
    
        $user = $request->user();
    
        $npiPath = null;
        if ($request->hasFile('npi_file')) {
            $npiPath = $request->file('npi_file')->store("api/users/$user->id/documents", 'public'); 
        }
    
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store("api/users/$user->id/documents", 'public'); 
        }
    
        // Vérification de l'âge de l'utilisateur (doit être au moins 18 ans)
        $birthDate = new \DateTime($request->birth_of_date);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;
    
        if ($age < 18) {
            return response()->json([
                'success' => false,
                'errors' => ["Vous devez avoir au moins 18 ans pour continuer."],
                'age' => $age
            ], 401); // Statut 401 pour indiquer que l'inscription est refusée
        }
    
        $city = City::whereName($request->city_id)->first();
    
        // Mise à jour en fonction du rôle de l'utilisateur
        $userUpdateData = [
            'date_of_birth' => $request->birth_of_date,
            'gender' => $request->gender,
            'city_id' => $city->id,
        ];
    
        if ($user->hasRole('passenger')) { // Si l'utilisateur est un passager
            $userUpdateData['npi'] = $request->npi;
            Profile::create([
                'user_id' => $user->id,
                'avatar' => $avatarPath,
                'identy_card' => $npiPath, // Enregistrement du fichier dans identity_card
            ]);
        } elseif ($user->hasRole('driver')) { // Si l'utilisateur est un conducteur
            $userUpdateData['driving_license_number'] = $request->npi;
            Profile::create([
                'user_id' => $user->id,
                'avatar' => $avatarPath,
                'driver_licence_card' => $npiPath, // Enregistrement du fichier dans driver_licence_card
            ]);
        }
    
        $user->update($userUpdateData);
    
        Preference::create([
            'user_id' => $user->id,
        ]);
    
        // Appeler la méthode privée pour formater l'utilisateur
        $userArray = $this->formatUserArray($user);
    
        return response()->json([
            'success' => true,
            'message' => 'Votre inscription a été finalisée avec succès.',
            'user' => $userArray,
        ], 201);
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