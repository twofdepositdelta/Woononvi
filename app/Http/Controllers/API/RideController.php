<?php

namespace App\Http\Controllers\API;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Models\Review;
use App\Models\RideMessage;
use App\Models\User;
use App\Models\Booking;
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
        $user = Auth::user();
        $data = DB::table('rides')->whereDriverId($user->id)->select([
            'id',
            'driver_id',
            'vehicle_id',
            'days',
            'type',
            'departure_time',
            'return_time',
            'price_per_km',
            'is_nearby_ride',
            'status',
            'start_location_name',
            'end_location_name',
            DB::raw('ST_AsText(start_location) as start_location'),
            DB::raw('ST_AsText(end_location) as end_location'),
            'available_seats',
            'created_at',
            'updated_at'
        ])->get();

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
            'return_time' => 'required',
            'is_nearby_ride' => 'required|boolean',
            'total_price' => 'required',
            'seats' => 'required',
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

        $request->type = ($request->type == "Régulier" ? 'regular' : 'single');

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
            'type' => $request->type,
            'days' => $daysJson,
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
            'status' => 'active',
            'available_seats' => $request->seats
        ]);

        // Retourner une réponse avec succès
        return response()->json([
            'success' => true,
            'message' => 'Le trajet a été créé avec succès.',
            'ride' => $ride,
        ], 201);
    }

    public function searchRides2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_lat' => 'required|numeric',
            'start_lng' => 'required|numeric',
            'end_lat' => 'required|numeric',
            'end_lng' => 'required|numeric',
            'departure_time' => 'required|date',
            // 'tolerance' => 'nullable|integer|min:100|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $rides = Ride::query()
       ->withinDistanceTo('start_location', new Point(lat: $request->start_lat, lng: $request->start_lng, srid: 4326), 1000)
       ->get();

        return response()->json([
            'success' => true,
            'message' => count($rides) ? 'Trajets disponibles trouvés.' : 'Aucun trajet disponible trouvé.',
            'rides' => $rides,
        ], 200);
    }

    public function bookRide(Request $request)
    {
        // Validation des données envoyées
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required|exists:rides,id', // Vérifie que le trajet existe
            'seats_reserved' => 'required|integer|min:1', // Vérifie le nombre de places réservées
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        // Récupérer le trajet
        $ride = DB::table('rides')->where('id', $request->ride_id)->first();

        if (!$ride || $ride->available_seats < $request->seats_reserved) {
            return response()->json([
                'success' => false,
                'message' => 'Le trajet sélectionné n\'a pas assez de places disponibles.',
            ], 400);
        }

        // Calcul du prix total
        $total_price = $ride->price_per_km * $request->seats_reserved;

        // Génération d'un numéro unique de réservation
        $booking_number = 'BOOK-' . strtoupper(Str::random(10));

        // Création de la réservation
        $booking = DB::table('bookings')->insert([
            'booking_number' => $booking_number,
            'seats_reserved' => $request->seats_reserved,
            'total_price' => $total_price,
            'price_maintain' => $total_price, // Ajoutez une logique ici si nécessaire
            'commission_rate' => 10, // Exemple de taux de commission, ajustez en fonction de votre application
            'ride_id' => $request->ride_id,
            'passenger_id' => $request->user()->id,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Mise à jour des places disponibles pour le trajet
        DB::table('rides')->where('id', $request->ride_id)->decrement('available_seats', $request->seats_reserved);

        return response()->json([
            'success' => true,
            'message' => 'Réservation effectuée avec succès.',
            'booking' => $booking,
        ]);
    }

    public function getDriverPendingBookings(Request $request)
    {
        //Validation des données d'entrée
        $validator = Validator::make($request->all(), [
            'status' => 'required', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        // Récupération des réservations liées au conducteur
        $pendingBookings = DB::table('bookings')
            ->select([
                'bookings.id',
                'bookings.booking_number',
                'bookings.seats_reserved',
                'users.firstname',
                'users.lastname',
                DB::raw("CONCAT('" . asset('storage') . "/', profiles.avatar) as avatar"),
                'bookings.total_price',
                'bookings.price_maintain',
                'bookings.commission_rate',
                'bookings.status',
                'bookings.created_at',
                'bookings.updated_at',
                DB::raw('ST_AsText(rides.start_location) as start_location'),
                DB::raw('ST_AsText(rides.end_location) as end_location'),
                'rides.start_location_name',
                'rides.end_location_name',
                'rides.departure_time',
                'rides.return_time',
                'rides.type',
                'rides.price_per_km',
            ])
            ->join('rides', 'bookings.ride_id', '=', 'rides.id') // Jointure pour relier les trajets
            ->join('users', 'rides.driver_id', '=', 'users.id') // Jointure avec la table `users` pour les conducteurs
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('rides.driver_id', $request->user()->id) // Filtrer par conducteur
            ->where('bookings.status', 'pending') // Filtrer par statut 'pending'
            ->get();

        return response()->json([
            'success' => true,
            'message' => count($pendingBookings) > 0 ? 'Réservations trouvées.' : 'Aucune réservation en attente trouvée.',
            'bookings' => $pendingBookings,
        ]);
    }


    public function searchRides(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_lat' => 'required|numeric',
            'start_lng' => 'required|numeric',
            'start_location_name' => 'required|string',
            'end_location_name' => 'required|string',
            'end_lat' => 'required|numeric',
            'end_lng' => 'required|numeric',
            // 'departure_time' => 'required|date',
            // 'tolerance' => 'nullable|integer|min:100|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $rides = DB::table('rides')->select([
            'rides.id',
            'rides.driver_id',
            'rides.vehicle_id',
            'users.firstname',
            'users.lastname',
            'vehicles.licence_plate',
            'vehicles.vehicle_mark',
            'vehicles.vehicle_model',
            DB::raw("CONCAT('" . asset('') . "', profiles.avatar) as avatar"),
            'days',
            'type',
            'departure_time',
            'return_time',
            'price_per_km',
            'total_price',
            'is_nearby_ride',
            'rides.status',
            'start_location_name',
            'end_location_name',
            DB::raw('ST_AsText(start_location) as start_location'),
            DB::raw('ST_AsText(end_location) as end_location'),
            'available_seats',
            'rides.created_at',
            'rides.updated_at'
        ])->join('users', 'rides.driver_id', '=', 'users.id') // Jointure avec la table `users` pour les conducteurs
        ->join('profiles', 'profiles.user_id', '=', 'users.id')
        ->join('vehicles', 'rides.vehicle_id', '=', 'vehicles.id') // Jointure avec la table `vehicles`
        ->selectRaw('
                CAST(ST_Distance_Sphere(ST_GeomFromText(?, 4326), start_location) AS SIGNED) AS distance',
                ["POINT($request->start_lng $request->start_lat)"]
            )
        ->whereRaw('ST_Distance_Sphere(ST_GeomFromText(?, 4326), start_location) <= ?', 
        ["POINT($request->start_lng $request->start_lat)", 2000])->get();

        // Retourner les trajets qui correspondent
        return response()->json([
            'success' => true,
            'rides' => $rides,
            'message' => count($rides) > 0 ? 'Trajets disponibles trouvés.' : 'Aucun trajet disponible trouvé.',
        ]);
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

    public function updateBookingStatus(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:bookings,id', // L'ID de la réservation doit exister
            'status' => 'required|in:accepted,rejected', // Statut accepté uniquement : 'accepted' ou 'rejected'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        // Récupérer la réservation
        $booking = Booking::find($request->booking_id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Réservation introuvable.',
            ], 404);
        }

        // Vérification du statut actuel
        if ($booking->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Seules les réservations en attente peuvent être modifiées.',
            ], 400);
        }

        // Mise à jour du statut
        $booking->status = $request->status;

        if ($request->status === 'accepted') {
            $booking->accepted_at = now();
        } elseif ($request->status === 'rejected') {
            $booking->rejected_at = now();
        }

        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Le statut de la réservation a été mis à jour avec succès.',
            'booking' => $booking,
        ]);
    }

}