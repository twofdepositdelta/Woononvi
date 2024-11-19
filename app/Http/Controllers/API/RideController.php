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
            // 'days' => 'required_if:type,regular|array',
            // 'days.*' => 'string|in:Lu,Ma,Me,Je,Ve,Sa,Di',
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

        $days = $request->input('days');
        if (!$days) {
            return response()->json(['message' => 'Les jours ne sont pas définis ou invalides.'], 422);
        }

        // Log or inspect the data
        logger(json_encode($days));

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
        $startLocation = DB::raw("ST_GeomFromText('POINT({$request->start_lng} {$request->start_lat})')");
        $endLocation = DB::raw("ST_GeomFromText('POINT({$request->end_lng} {$request->end_lat})')");

        // Si les jours sont fournis, les convertir en chaîne JSON
        $daysJson = $request->days ? json_encode($request->days) : null;

        // Enregistrement du trajet dans la base de données
        $trip = Ride::create([
            'driver_id' => Auth::id(), // ID de l'utilisateur (conducteur) connecté
            'vehicle_id' => $activeVehicle->id, 
            'days' => $daysJson,
            'type' => $request->type,
            'departure_time' => $request->departure_time,
            'return_time' => $request->arrival_time,
            'price_per_km' => $request->price_per_km,
            'is_nearby_ride' => $request->is_nearby_ride,
            'status' => 'active', 
            'start_location' => $startLocation,  // Coordonnées de départ
            'end_location' => $endLocation,      // Coordonnées d'arrivée
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