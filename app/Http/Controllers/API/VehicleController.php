<?php

namespace App\Http\Controllers\API;

use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function getVehicleType()
    {
        $data = VehicleType::orderBy('name')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'licence_plate' => 'required|max:255|string',
            'mark' => 'required|max:255|string',
            'seats' => 'required|max:255|string',
            'color' => 'required|max:255|string',
            'model' => 'required|max:255|string',
            'year' => 'required|max:255|date',
            'logbook' => 'required|mimes:pdf|max:2048',
            'image' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:1024',
            'vehicle_type' => 'required|max:255|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $vehiculeType = TypeVehicle::whereLabel($request->vehicle_type)->first();

        if($vehiculeType) {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store("drivers/$user->id/images", 'public'); 
            }

            $logbookPath = null;
            if ($request->hasFile('logbook')) {
                $logbookPath = $request->file('logbook')->store("drivers/$user->id/logbooks", 'public'); 
            }

            $vehicle = Vehicle::create([
                'licence_plate' => $request->licence_plate,
                'seats' => $request->seats,
                'vehicle_mark' => $request->mark,
                'vehicle_model' => $request->model,
                'vehicle_year' => $request->year,
                'color' => $request->color,
                'main_image' => $imagePath,
                'logbook' => $logbookPath,
                'slug' => Str::slug($request->licence_plate),
                'type_vehicle_id' => $vehiculeType->id,
                'driver_id' => $user->id,
            ]);

            // $document = Document::create([

            // ]);

            return response()->json([
                'success' => true,
                'vehicle' => $vehicle,
                'message' => 'Véhicule ajouté avec succès !',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez revoir les informations du type de véhicule !',
            ], 422);
        }
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
}