<?php

namespace App\Http\Controllers\API;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Models\Review;
use App\Models\RideMessage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RideController extends Controller
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
            'departure_time' => 'required|date',
            'return_time' => 'required|date',
            'is_nearby_ride' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Vérifier si le conducteur a un véhicule actif
        $driver = Auth::user();
        $activeVehicle = $driver->vehicles()->where('is_active', true)->first();

        if (!$activeVehicle) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez avoir un véhicule actif pour créer un trajet.',
            ], 403);
        }

        // Vérifier si les localisations se trouvent au Bénin
        if (!$this->isWithinBenin($request->start_lat, $request->start_lng)) {
            return response()->json([
                'success' => false,
                'message' => 'Les coordonnées de départ doivent être situées au Bénin.',
            ], 422);
        }

        if (!$this->isWithinBenin($request->end_lat, $request->end_lng)) {
            return response()->json([
                'success' => false,
                'message' => 'Les coordonnées d\'arrivée doivent être situées au Bénin.',
            ], 422);
        }

        // Création des objets Point pour les coordonnées géographiques
        $startLocation = new Point($request->start_lat, $request->start_lng);
        $endLocation = new Point($request->end_lat, $request->end_lng);

        // Enregistrement du trajet dans la base de données
        $trip = Ride::create([
            'driver_id' => Auth::id(), // ID de l'utilisateur (conducteur) connecté
            'vehicle_id' => $activeVehicle->id, 
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
            'status' => 'active', // Statut initial du trajet
        ]);

        // Retourner une réponse avec succès
        return response()->json([
            'success' => true,
            'message' => 'Le trajet a été créé avec succès.',
            'trip' => $trip,
        ], 201);
    }

    private function isWithinBenin(float $latitude, float $longitude): bool
    {
        $apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key=AIzaSyDcA6TWg_F0YRmwkoiBLQNQEA9m69aLgQY";
        
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);

        if (!empty($data['results'])) {
            foreach ($data['results'] as $result) {
                if (in_array('Benin', $result['formatted_address'])) {
                    return true;
                }
            }
        }

        return false;
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