<?php

namespace App\Http\Controllers\API;

use App\Models\Trip;
use App\Models\TripRequest;
use App\Models\TripReview;
use App\Models\TripMessage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:regular,single',
            'start_lat' => 'required|numeric',
            'start_lng' => 'required|numeric',
            'end_lat' => 'required|numeric',
            'end_lng' => 'required|numeric',
            'days' => 'nullable|array',
            'return_trip' => 'required|boolean',
            'departure_time' => 'required|date_format:H:i',
            'return_time' => 'required|date_format:H:i',
            'is_nearby_ride' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Création des objets Point pour les coordonnées géographiques
        $startLocation = new Point($request->start_lat, $request->start_lng);
        $endLocation = new Point($request->end_lat, $request->end_lng);

        // Enregistrement du trajet dans la base de données
        $trip = Trip::create([
            'driver_id' => Auth::id(), // ID de l'utilisateur (conducteur) connecté
            'type' => $request->type,
            'start_location' => $startLocation,  // Coordonnées de départ
            'end_location' => $endLocation,      // Coordonnées d'arrivée
            'days' => $request->days ? json_encode($request->days) : null,
            'return_trip' => $request->return_trip,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'price_per_km' => $request->price_per_km,
            'is_nearby_ride' => $request->is_nearby_ride,
            'commission_rate' => $request->commission_rate,
            'status' => 'pending', // Statut initial du trajet
        ]);

        // Retourner une réponse avec succès
        return response()->json([
            'success' => true,
            'message' => 'Le trajet a été créé avec succès.',
            'trip' => $trip,
        ], 201);
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
    public function destroy(Request $request)
    {
        
    }
}