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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TarfinLabs\LaravelSpatial\Types\Point;

class RideController extends Controller
{
    public function getRides(Request $request)
    {
        $user = $request->user();
        $data = $user->rides()->get();
        return $data;
        // return response()->json([
        //     'success' => true,
        //     'data' => $data,
        // ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:Régulier,Ponctuel',
            'start_lat' => 'required|numeric',
            'start_location_name' => 'required|string',
            'end_location_name' => 'required|string',
            'start_lng' => 'required|numeric',
            'end_lat' => 'required|numeric',
            'end_lng' => 'required|numeric',
            'departure_time' => 'required|date',
            'return_time' => 'required|date',
            'is_nearby_ride' => 'required|boolean',
            'total_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $days = $request->input('days');
        if (!$days) {
            return response()->json(['message' => 'Les jours ne sont pas définis ou invalides.'], 422);
        }

        // Log or inspect the data
        // logger(json_encode($days));

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

        $request->type = ($request->type == "Régulier" ? 'regular' : 'ponctual');

        $startLocation = new Point(lat: $request->start_lng, lng: $request->start_lat, srid: 4326);
        $endLocation = new Point(lat: $request->end_lng, lng: $request->end_lat, srid: 4326);

        // Si les jours sont fournis, les convertir en chaîne JSON
        $daysJson = $request->days ? json_encode($request->days) : null;

        $numeroRide = $this->generateUniqueRideNumber();

        // Enregistrement du trajet dans la base de données
        $ride = Ride::create([
            'numero_ride' => $numeroRide,
            'driver_id' => Auth::id(), // ID de l'utilisateur (conducteur) connecté
            'vehicle_id' => $activeVehicle->id, 
            'days' => $daysJson,
            'type' => $request->type,
            'departure_time' => $request->departure_time,
            'return_time' => $request->return_time,
            'price_per_km' => 100,
            'is_nearby_ride' => $request->is_nearby_ride,
            'status' => 'active', 
            'start_location_name' => $request->start_location_name,  
            'end_location_name' => $request->end_location_name,  
            'start_location' => $startLocation,  // Coordonnées de départ
            'end_location' => $endLocation,      // Coordonnées d'arrivée
            'total_price' => $request->total_price,  
            'status' => 'active'
        ]);

        // Retourner une réponse avec succès
        return response()->json([
            'success' => true,
            'message' => 'Le trajet a été créé avec succès.',
            'ride' => $ride,
        ], 201);
    }

    private function generateUniqueRideNumber()
    {
        do {
            // Générer un numéro aléatoire de 8 caractères
            $numeroRide = Str::random(8);
        } while (Ride::where('numero_ride', $numeroRide)->exists()); // Vérifier son unicité

        return $numeroRide;
    }

    private function isWithinBenin(float $latitude, float $longitude): bool
    {
        $beninBounds = [
            'min_lat' => 6.142,  // Latitude minimale approximative du Bénin
            'max_lat' => 12.409, // Latitude maximale approximative du Bénin
            'min_lng' => 0.774,  // Longitude minimale approximative du Bénin
            'max_lng' => 3.844,  // Longitude maximale approximative du Bénin
        ];
    
        return $latitude >= $beninBounds['min_lat'] && $latitude <= $beninBounds['max_lat']
            && $longitude >= $beninBounds['min_lng'] && $longitude <= $beninBounds['max_lng'];
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