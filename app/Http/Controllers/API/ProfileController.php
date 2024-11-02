<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
            'npi' => 'required|integer|size:9',
            'email' => 'required|email|max:255',
            'lastname' => 'required|min:2|max:255|string',
            'firstname' => 'required|min:2|max:255|string',
            'gender' => 'required|max:255|string',
            'username' => 'required|min:3|max:255|string',
            'city_id' => 'required|max:255|string',
            'country_id' => 'required|max:255|string',
            'phone' => 'required|max:12|string',
            'date_of_birth' => 'required|max:12|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()
            ], 422);
        }

        $country = Country::whereIndicatif($request->country_id)->first();
        $city = City::whereName($request->city_id)->first();

        $user->update([
            'date_of_birth' => $request->birth_of_date,
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
            'cities' => City::whereCountryId($request->country_id)->pluck('name')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
}