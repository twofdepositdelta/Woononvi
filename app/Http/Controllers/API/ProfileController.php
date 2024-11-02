<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Country;
use App\Models\City;
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
                'errors' => $validator->errors()
            ], 422);
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

            return response()->json([
                'success' => true,
                'message' => 'Profil modifié avec succès.',
                'user' => $user,
                'cities' => City::whereCountryId($country->id)->pluck('name')
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Il y a un soucis avec les informations de l\'utilisateur.',
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
}