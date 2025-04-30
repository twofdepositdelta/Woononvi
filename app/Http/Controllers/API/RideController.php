<?php

namespace App\Http\Controllers\API;

use App\Models\Ride;
use App\Models\Kilometrage;
use App\Models\RideRequest;
use App\Models\Review;
use App\Models\RideMessage;
use App\Models\User;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TarfinLabs\LaravelSpatial\Types\Point;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RideController extends Controller
{
    public function getRides(Request $request)
    {
        $data = DB::table('rides')->join('vehicles', 'rides.vehicle_id', '=', 'vehicles.id')
            ->where('rides.driver_id', $request->user()->id)->select([
            'rides.id',
            'rides.driver_id',
            'vehicle_id',
            'licence_plate',
            'days',
            'type',
            'rides.total_price',
            'departure_time',
            'return_time',
            'price_per_km',
            'is_nearby_ride',
            'rides.status',
            'start_location_name',
            'end_location_name',
            DB::raw('ST_AsText(start_location) as start_location'),
            DB::raw('ST_AsText(end_location) as end_location'),
            DB::raw('CEIL(ST_Distance_Sphere(start_location, end_location) / 1000) AS distance_km'),
            'rides.available_seats',
            'rides.created_at',
            'rides.updated_at'
        ])->get();

        $data->transform(function ($ride) {
            // Supprimer les guillemets externes
            $rawDays = trim($ride->days, '"'); 
        
            // Décoder les caractères échappés
            $decodedRawDays = stripslashes($rawDays);
        
            // Décoder la chaîne JSON pour obtenir un tableau
            $decodedDays = json_decode($decodedRawDays, true);
        
            // Vérifier si le décodage est réussi et si le résultat est un tableau
            if (is_array($decodedDays)) {
                $ride->days_string = implode(' ', $decodedDays); // Joindre les jours avec des espaces
            } else {
                $ride->days_string = null; // Si la valeur n'est pas valide, définir comme null
            }

            // Formater departure_time en "HH:MM"
            if (!empty($ride->departure_time)) {
                $ride->departure_time = \Carbon\Carbon::parse($ride->departure_time)->format('H:i');
            } else {
                $ride->departure_time = '-';
            }

            // Formater return_time ou mettre "-"
            if (!empty($ride->return_time)) {
                $ride->return_time = \Carbon\Carbon::parse($ride->return_time)->format('H:i');
            } else {
                $ride->return_time = '-';
            }
        
            return $ride;
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function getReservations(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_lat' => 'required|numeric',
            'start_lng' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Les données envoyées ne sont pas valides.',
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
                ["POINT(2.6217 9.3405)"]
            )
        ->whereRaw('ST_Distance_Sphere(ST_GeomFromText(?, 4326), start_location) <= ?', 
        ["POINT(2.6217 9.3405)", 5000])->get();

        // Retourner les trajets qui correspondent
        return response()->json([
            'success' => true,
            'rides' => [],
            // 'rides' => $rides,
            'message' => count($rides) > 0 ? 'Trajets disponibles trouvés.' : 'Aucun trajet disponible trouvé.',
        ]);
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
            'vehicle_id' => 'required',
            'seats' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'reason' => false,
                // 'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $driver = Auth::user();

        // Vérifier si le solde de l'utilisateur est suffisant
        // if ($driver->balance < 1000) {
        //     return response()->json([
        //         'success' => false,
        //         'reason' => true,
        //         'message' => 'Votre solde est insuffisant pour ajouter un véhicule. Veuillez recharger votre compte d\'au moins 1.000 FCFA.',
        //     ], 422);
        // }

        $countryId = $driver->country_id;
        if (!$countryId) {
            // Loguer l'erreur
            logger()->error('Le conducteur n\'a pas de pays associé.', ['user_id' => $user->id]);
            return response()->json(['message' => 'Vous n\'avez pas de pays associé.'], 422);
        }

        if (!$this->isWithinCountry($request->start_lat, $request->start_lng, $countryId)) {
            return response()->json([
                'success' => false,
                'errors' => ['Les coordonnées de départ ne sont pas dans le pays du conducteur.'],
            ], 422);
        }

        if (!$this->isWithinCountry($request->end_lat, $request->end_lng, $countryId)) {
            return response()->json([
                'success' => false,
                'errors' => ['Les coordonnées d\'arrivée ne sont pas dans le pays du conducteur.'],
            ], 422);
        }

        // Récupérer la valeur du paramètre 'suggested_price_per_km' dans la table settings
        // $setting = \DB::table('settings')->where('key', 'suggested_price_per_km')->first();

        // Si la clé n'existe pas, retourner une erreur
        // if (!$setting) {
        //     // Loguer l'incident
        //     logger()->error("Paramètre 'suggested_price_per_km' non trouvé dans la table settings.");

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Une erreur est survenue, veuillez réessayer plus tard.',
        //     ], 422);
        // }

        // Affecter la valeur de 'value' à 'price_per_km'
        // $pricePerKm = $setting->value;

        $days = $request->input('days');
        if ($request->type === 'Régulier') {
            // S'assurer que $days est un tableau
            if (is_string($days)) {
                $days = json_decode($days, true); // Décoder la chaîne JSON en tableau
            }

            // Vérifier que les jours sont fournis
            if (!$days || !is_array($days)) {
                return response()->json([
                    'success' => false,
                    'errors' => ['Les jours doivent être définis pour un trajet régulier.'],
                ], 422);
            }

            // Correspondance des abréviations des jours avec les jours complets
            $dayMapping = [
                'Lun' => 'Lundi',
                'Mar' => 'Mardi',
                'Mer' => 'Mercredi',
                'Jeu' => 'Jeudi',
                'Ven' => 'Vendredi',
                'Sam' => 'Samedi',
                'Dim' => 'Dimanche'
            ];

            $convertedDays = [];
            foreach ($days as $day) {
                $day = ucfirst(strtolower($day)); // Normaliser la casse
                if (array_key_exists($day, $dayMapping)) {
                    $convertedDays[] = $dayMapping[$day];
                } else {
                    return response()->json([
                        'success' => false,
                        'errors' => ["Le jour fourni '{$day}' n'est pas valide."],
                    ], 422);
                }
            }

            // Convertir les jours en JSON
            $daysJson = json_encode($convertedDays);
        } else {
            // Si le trajet est ponctuel, ne pas enregistrer les jours
            $daysJson = null;
        }

        // Vérifier si le conducteur a un véhicule actif
        $activeVehicle = $driver->vehicles()->where('is_active', true)->first();

        if (!$activeVehicle) {
            return response()->json([
                'success' => false,
                'errors' => ['Vous devez avoir un véhicule actif pour créer un trajet.'],
            ], 403);
        }

        $type = ($request->type == "Régulier" ? 'regular' : 'single');
        $startLocation = new Point(lng: $request->start_lng, lat: $request->start_lat, srid: 4326);
        $endLocation = new Point(lng: $request->end_lng, lat: $request->end_lat, srid: 4326);
        $numeroRide = $this->generateUniqueRideNumber();

        // Enregistrement du trajet dans la base de données
        $ride = Ride::create([
            'numero_ride' => $numeroRide,
            'driver_id' => Auth::id(), // ID de l'utilisateur (conducteur) connecté
            'vehicle_id' => $request->vehicle_id, 
            'type' => $type,
            'days' => $daysJson,
            'departure_time' => $request->departure_time,
            'return_time' => $request->return_time,
            // 'price_per_km' => $pricePerKm,
            'is_nearby_ride' => $request->is_nearby_ride,
            'status' => 'active', 
            'start_location_name' => $request->start_location_name,  
            'end_location_name' => $request->end_location_name,  
            'start_location' => $startLocation,  // Coordonnées de départ
            'end_location' => $endLocation,      // Coordonnées d'arrivée
            // 'total_price' => $request->total_price,  
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
                // 'message' => 'Les données envoyées ne sont pas valides.',
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
        if ($request->has('mode')) {
            $request->merge([
                'mode' => $request->mode === 'En espèce' ? 'in cash' : 'wallet',
            ]);
        }

        // Validation des données envoyées
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required|exists:rides,id', // Vérifie que le trajet existe
            'seats_reserved' => 'required|integer|min:1', // Vérifie le nombre de places réservées
            'mode' => 'required|in:in cash,wallet',
            'start_lat' => 'required',
            'start_lng' => 'required',
            'end_lat' => 'required',
            'end_lng' => 'required',
            'start_location_name' => 'required',
            'end_location_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        // Récupérer le trajet
        // $ride = DB::table('rides')->where('id', $request->ride_id)->first();
        $ride = Ride::with('vehicle.typeVehicle.categorie')->find($request->ride_id);

        if (!$ride || $ride->available_seats < $request->seats_reserved) {
            return response()->json([
                'success' => false,
                'errors' => ['Le trajet sélectionné n\'a pas assez de places disponibles.'],
            ], 400);
        }

        // Calcul du prix total
        // $total_price = (int) $ride->total_price * (int) $request->seats_reserved;
        // if($total_price / 2 < $request->amount) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Le montant que vous avez fixé ne semble pas raisonnable !',
        //     ], 400);
        // }

        // Vérification du solde si le mode de paiement est "wallet"
        // if ($request->mode === 'wallet') {
        //     $passenger = $request->user(); // Récupérer l'utilisateur connecté

        //     if ($passenger->balance < $request->amount) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Votre solde est insuffisant pour effectuer cette réservation !',
        //         ], 400);
        //     }
        // }

        // Génération d'un numéro unique de réservation
        $booking_number = 'BOOK-' . strtoupper(Str::random(10));

        $commissionRate = DB::table('settings')
            ->where('key', 'commission_rate')
            ->value('value'); // Récupère uniquement la colonne "value" pour `commission_rate`

        $startLocation = new Point(lng: $request->start_lng, lat: $request->start_lat, srid: 4326);
        $endLocation = new Point(lng: $request->end_lng, lat: $request->end_lat, srid: 4326);

        $distance = $this->haversineDistance(
            $startLocation->getLat(),
            $startLocation->getLng(),
            $endLocation->getLat(),
            $endLocation->getLng()
        );

        $tarif = DB::table('kilometrages')
            ->where('categorie_id', $ride->vehicle->typeVehicle->categorie->id)
            ->where('min_km', '<=', $distance)
            ->where('max_km', '>=', $distance)
            ->first();       
            
        if (!$tarif) {
            return response()->json([
                'success' => false,
                'errors' => ['Aucune tarification disponible pour cette distance.'],
            ], 400);
        }

        // Calcul du prix total
        $total_price = $tarif->taux_par_km * $distance * (int) $request->seats_reserved;
        $request->merge(['amount' => ceil($total_price / 5) * 5]);

        // Création de la réservation
        $booking = DB::table('bookings')->insert([
            'booking_number' => $booking_number,
            'seats_reserved' => $request->seats_reserved,
            'total_price' => $request->amount,
            'price_maintain' => $request->amount, 
            'commission_rate' => $commissionRate,
            'ride_id' => $request->ride_id,
            'passenger_start_location_name' => $request->start_location_name,  
            'passenger_end_location_name' => $request->end_location_name,  
            'passenger_start_location' => DB::raw("ST_GeomFromText('POINT($request->start_lng $request->start_lat)', 4326)"),
            'passenger_end_location' => DB::raw("ST_GeomFromText('POINT($request->end_lng $request->end_lat)', 4326)"), 
            'passenger_id' => $request->user()->id,
            'mode' => $request->mode,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Réservation effectuée avec succès.',
            'booking' => $booking,
        ]);
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2, $unit = 'km') {
        $earthRadius = ($unit === 'km') ? 6371 : 3958.8; // Rayon de la Terre en kilomètres ou miles
    
        // Convertir les degrés en radians
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);
    
        // Calcul des différences
        $deltaLat = $lat2Rad - $lat1Rad;
        $deltaLon = $lon2Rad - $lon1Rad;
    
        // Formule de Haversine
        $a = sin($deltaLat / 2) ** 2 +
             cos($lat1Rad) * cos($lat2Rad) *
             sin($deltaLon / 2) ** 2;
    
        $c = 2 * asin(sqrt($a));
    
        // Calcul de la distance
        $distance = $earthRadius * $c;
    
        return $distance;
    }
    

    public function getDriverBookings(Request $request)
    {
        // Validation des données d'entrée
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $statusNames = [
            'pending' => 'En attente',
            'in progress' => 'En cours',
            'accepted' => 'Acceptée',
            'rejected' => 'Rejetée',
            'completed' => 'Terminée',
            'refunded' => 'Remboursée',
            'cancelled' => 'Annulée',
        ];

        // Construction de la requête de base
        $query = DB::table('bookings')
            ->select([
                'bookings.id',
                'bookings.booking_number',
                'bookings.validated_by_driver_at',
                'bookings.seats_reserved',
                'users.firstname',
                'users.lastname',
                'users.phone',
                DB::raw("CONCAT('" . asset('storage') . "/', profiles.avatar) as avatar"),
                'bookings.total_price',
                'bookings.price_maintain',
                'bookings.commission_rate',
                'bookings.passenger_id',
                'bookings.status',
                'bookings.created_at',
                'bookings.updated_at',
                'bookings.arrived_at',
                DB::raw('ST_AsText(rides.start_location) as start_location'),
                DB::raw('ST_AsText(rides.end_location) as end_location'),
                DB::raw('ST_AsText(bookings.passenger_start_location) as passenger_start_location'),
                DB::raw('ST_AsText(bookings.passenger_end_location) as passenger_end_location'),
                'rides.start_location_name',
                'rides.end_location_name',
                'bookings.passenger_start_location_name',
                'bookings.passenger_end_location_name',
                'rides.departure_time',
                'rides.return_time',
                'rides.type',
                'rides.price_per_km',
            ])
            ->join('rides', 'bookings.ride_id', '=', 'rides.id') // Liaison avec les trajets
            ->join('users', 'rides.driver_id', '=', 'users.id') // Liaison avec la table `users` pour les conducteurs
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('rides.driver_id', $request->user()->id); // Filtrer par conducteur

        // Appliquer les filtres de statut selon la condition
        if ($request->status != "accepted") {
            $query->where('bookings.status', $request->status);
        } else {
            $query->whereIn('bookings.status', ['accepted', 'in progress']);
        }

        // Grouper les résultats
        $query->groupBy('bookings.id');
        // Si le statut est 'in progress', récupérer uniquement la première réservation
        // if ($request->status === 'in progress') {
        //     $booking = $query->first();

        //     if (!$booking) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Aucune réservation en cours trouvée.',
        //         ], 404);
        //     }

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Réservation en cours trouvée.',
        //         'booking' => $booking,
        //     ]);
        // }

        // Si le statut est différent de 'in progress', récupérer toutes les réservations correspondantes
        $bookings = $query->get()->map(function ($booking) use ($statusNames) {
            // Ajouter le nom du statut à chaque réservation
            $booking->status_name = $statusNames[$booking->status] ?? 'Inconnu';

            $booking->amount_received = $booking->total_price * (1 - ($booking->commission_rate / 100));

            // Formater departure_time et return_time
            $booking->departure_time = $booking->departure_time 
                ? Carbon::parse($booking->departure_time)->format('H:i') 
                : null;
            $booking->return_time = $booking->return_time 
                ? Carbon::parse($booking->return_time)->format('H:i') 
                : null;

            // Récupérer les informations du passager
            $passenger = DB::table('users')
                ->select([
                    'users.firstname as passenger_firstname',
                    'users.lastname as passenger_lastname',
                    'users.phone as passenger_phone',
                    DB::raw("CONCAT('" . asset('storage') . "/', profiles.avatar) as passenger_avatar")
                ])
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->where('users.id', $booking->passenger_id)
                ->first();

                // Ajouter les infos du passager à la réservation
                if ($passenger) {
                    $booking->passenger_firstname = $passenger->passenger_firstname;
                    $booking->passenger_lastname = $passenger->passenger_lastname;
                    $booking->passenger_phone = $passenger->passenger_phone;
                    $booking->passenger_avatar = $passenger->passenger_avatar;
                }

            return $booking;
        });

        return response()->json([
            'success' => true,
            'message' => count($bookings) > 0 ? 'Réservations trouvées.' : 'Aucune réservation trouvée.',
            'bookings' => $bookings,
        ]);
    }

    public function getPassengerBookings(Request $request)
    {
        $statusNames = [
            'pending' => 'En attente',
            'in progress' => 'En cours',
            'accepted' => 'Acceptée',
            'rejected' => 'Rejetée',
            'completed' => 'Terminée',
            'refunded' => 'Remboursée',
            'cancelled' => 'Annulée',
        ];
        
        // Récupération des réservations liées au passager
        $passengerBookings = DB::table('bookings')
            ->select([
                'bookings.id',
                'bookings.booking_number',
                'bookings.validated_by_passenger_at',
                'bookings.validated_by_driver_at',
                'bookings.seats_reserved',
                DB::raw("CONCAT(users.firstname, ' ', users.lastname) as driver_name"),
                DB::raw("CONCAT('" . asset('storage/') . "/', profiles.avatar) as driver_avatar"),
                'bookings.total_price',
                'bookings.price_maintain',
                'bookings.commission_rate',
                'bookings.status',
                'bookings.created_at',
                'bookings.updated_at',
                DB::raw('ST_AsText(rides.start_location) as start_location'),
                DB::raw('ST_AsText(rides.end_location) as end_location'),
                DB::raw('ST_AsText(bookings.passenger_start_location) as passenger_start_location'),
                DB::raw('ST_AsText(bookings.passenger_end_location) as passenger_end_location'),
                'rides.start_location_name',
                'rides.end_location_name',
                'bookings.passenger_start_location_name',
                'bookings.passenger_end_location_name',
                'rides.departure_time',
                'rides.return_time',
                'rides.type',
                'rides.price_per_km',
            ])
            ->join('rides', 'bookings.ride_id', '=', 'rides.id') // Jointure pour relier les trajets
            ->join('users', 'rides.driver_id', '=', 'users.id') // Jointure avec la table `users` pour les conducteurs
            ->join('profiles', 'profiles.user_id', '=', 'users.id') // Jointure avec les profils des conducteurs
            ->where('bookings.passenger_id', $request->user()->id) // Filtrer par passager connecté
            ->orderBy('bookings.id', 'desc')
            ->groupBy('bookings.id')
            ->get()
            ->map(function ($booking) use ($statusNames) {
                // Ajouter le nom du statut à chaque réservation
                $booking->status_name = $statusNames[$booking->status] ?? 'Inconnu';

                // Formater departure_time et return_time
                $booking->departure_time = $booking->departure_time 
                    ? Carbon::parse($booking->departure_time)->format('H:i') 
                    : null;
                $booking->return_time = $booking->return_time 
                    ? Carbon::parse($booking->return_time)->format('H:i') 
                    : null;

                return $booking;
            });

        return response()->json([
            'success' => true,
            'message' => count($passengerBookings) > 0 ? 'Réservations trouvées.' : 'Aucune réservation trouvée.',
            'bookings' => $passengerBookings,
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
            // 'seats_reserved' => 'required|min:1',
            // 'departure_time' => 'required|date',
            // 'tolerance' => 'nullable|integer|min:100|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        // Enregistrer la recherche
        $this->storeRideSearch($request);

        // Chercher des trajets
        $rides = $this->findAvailableRides($request);

        if ($rides->isEmpty()) {
            // Créer une demande si aucun trajet n'est trouvé
            $this->createRideRequest($request);
    
            return response()->json([
                'success' => false,
                'rides' => [],
                'errors' => ['Aucun trajet disponible trouvé. Une demande a été créée.'],
            ]);
        }

        return response()->json([
            'success' => true,
            'rides' => $rides,
            'message' => 'Trajets disponibles trouvés.',
        ]);
    }

    private function calculateBearing($lat1, $lng1, $lat2, $lng2)
    {
        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $deltaLng = deg2rad($lng2 - $lng1);

        $y = sin($deltaLng) * cos($lat2);
        $x = cos($lat1) * sin($lat2) - sin($lat1) * cos($lat2) * cos($deltaLng);

        $bearing = atan2($y, $x);
        $bearing = rad2deg($bearing);
        return ($bearing + 360) % 360; // Normaliser entre 0 et 360°
    }

    /**
     * Enregistre les données de la recherche dans la table ride_searches.
     */
    private function storeRideSearch(Request $request)
    {
        DB::table('ride_searches')->insert([
            'start_location' => DB::raw("ST_GeomFromText('POINT({$request->start_lng} {$request->start_lat})', 4326)"),
            'end_location' => DB::raw("ST_GeomFromText('POINT({$request->end_lng} {$request->end_lat})', 4326)"),
            'passenger_id' => $request->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Cherche des trajets disponibles basés sur la recherche.
     */
    private function findAvailableRides(Request $request)
    {
        Carbon::setLocale('fr'); // Configure la locale de Carbon en français
        $currentDay = ucfirst(now()->translatedFormat('l')); // Obtenir le jour actuel en français
        $currentDate = now()->toDateString(); // Obtenir la date actuelle au format 'YYYY-MM-DD'
        $now = Carbon::now()->format('H:i:s'); // Heure actuelle au format "HH:MM:SS"

        $rides = DB::table('rides')->select([
            'rides.id',
            'rides.driver_id',
            'rides.available_seats',
            'rides.vehicle_id',
            'users.firstname',
            'users.lastname',
            'users.gender',
            DB::raw("DATE_FORMAT(users.created_at, '%d-%m-%Y') as user_created_at"),
            'vehicles.licence_plate',
            'vehicles.vehicle_mark',
            'vehicles.vehicle_model',
            'vehicles.color',
            'vehicles.seats',
            'vehicles.vehicle_year',
            DB::raw("CONCAT('" . asset('storage') . "/', vehicles.main_image) as main_image"),
            DB::raw("CONCAT('" . asset('storage') . "/', profiles.avatar) as avatar"),
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
            'rides.updated_at',
        ])
        ->join('users', 'rides.driver_id', '=', 'users.id')
        ->join('profiles', 'profiles.user_id', '=', 'users.id')
        ->join('vehicles', 'rides.vehicle_id', '=', 'vehicles.id')
        ->selectRaw('
                CAST(ST_Distance_Sphere(ST_GeomFromText(?, 4326), start_location) AS SIGNED) AS distance',
                ["POINT($request->start_lng $request->start_lat)"]
            )
        ->whereRaw('ST_Distance_Sphere(ST_GeomFromText(?, 4326), start_location) <= ?', 
            ["POINT($request->start_lng $request->start_lat)", 5000])
        ->where('rides.driver_id', '!=', Auth::id())
        // ->where('rides.available_seats', '>=', $request->seats_reserved)
        ->where(function ($query) use ($currentDay, $currentDate, $now) {
            $query->where(function ($subQuery) use ($currentDate, $now) {
                $subQuery->where('type', 'single')
                        ->where('rides.status', 'active')
                        ->whereDate('rides.created_at', $currentDate)
                        ->where('departure_time', '>=', $now);
            })
            ->orWhere(function ($subQuery) use ($currentDay, $now) {
                $subQuery->where('type', 'regular')
                        ->where('rides.status', 'active')
                        ->whereRaw('JSON_CONTAINS(JSON_UNQUOTE(days), JSON_QUOTE(?))', [$currentDay])
                        ->where('departure_time', '>=', $now);
            });
        })
        ->groupBy('rides.id')
        ->get();

        // 2. Filtrage avancé en PHP
        $rides = $rides->filter(function ($ride) use ($request) {
            preg_match('/POINT\(([-\d\.]+) ([-\d\.]+)\)/', $ride->start_location, $startMatch);
            preg_match('/POINT\(([-\d\.]+) ([-\d\.]+)\)/', $ride->end_location, $endMatch);

            if (!$startMatch || !$endMatch) {
                return false;
            }

            $driverStartLng = $startMatch[1];
            $driverStartLat = $startMatch[2];
            $driverEndLng = $endMatch[1];
            $driverEndLat = $endMatch[2];

            $passengerStartLng = $request->start_lng;
            $passengerStartLat = $request->start_lat;
            $passengerEndLng = $request->end_lng;
            $passengerEndLat = $request->end_lat;

            // Direction de trajet (non utilisé ici, mais prêt pour plus tard)

            // Vérification que l'arrivée du passager est proche de la route
            $distanceToPath = $this->distanceToSegment(
                $passengerEndLng,
                $passengerEndLat,
                $driverStartLng,
                $driverStartLat,
                $driverEndLng,
                $driverEndLat
            );

            if ($distanceToPath > 5000) { // 5km tolérance sur le chemin
                return false;
            }

            return true;
        });

        return $rides->values(); // réindexer
    }

    private function distanceToSegment($px, $py, $ax, $ay, $bx, $by)
    {
        $A = $px - $ax;
        $B = $py - $ay;
        $C = $bx - $ax;
        $D = $by - $ay;

        $dot = $A * $C + $B * $D;
        $len_sq = $C * $C + $D * $D;
        $param = $len_sq != 0 ? $dot / $len_sq : -1;

        if ($param < 0) {
            $xx = $ax;
            $yy = $ay;
        } elseif ($param > 1) {
            $xx = $bx;
            $yy = $by;
        } else {
            $xx = $ax + $param * $C;
            $yy = $ay + $param * $D;
        }

        $dx = $px - $xx;
        $dy = $py - $yy;
        return sqrt($dx * $dx + $dy * $dy) * 111320; // 111.32 km ≈ 1°
    }

    /**
     * Crée une demande dans la table ride_requests si aucun trajet n'est trouvé.
     */
    private function createRideRequest(Request $request)
    {
        try {
            // Vérifier si le taux de commission existe
            $commissionRateSetting = DB::table('settings')
                ->where('key', 'commission_rate')
                ->first();

            if (!$commissionRateSetting) {
                // Journaliser l'erreur si le paramètre n'existe pas
                logger()->error('Le paramètre commission_rate est introuvable dans la table settings.', [
                    'user_id' => $request->user()->id,
                ]);
                return response()->json(['errors' => ['Le paramètre de commission est manquant.']], 422);
            }

            // Extraire la valeur du commission_rate depuis la table settings
            $commissionRate = $commissionRateSetting->value;

            // Insérer la demande de trajet dans la table 'ride_requests'
            DB::table('ride_requests')->insert([
                'start_location_name' => $request->start_location_name,
                'start_location' => DB::raw("ST_GeomFromText('POINT({$request->start_lng} {$request->start_lat})', 4326)"),
                'end_location_name' => $request->end_location_name,
                'end_location' => DB::raw("ST_GeomFromText('POINT({$request->end_lng} {$request->end_lat})', 4326)"),
                'seats' => $request->seats ?? 1,
                'preferred_time' => now(),
                'preferred_amount' => $request->preferred_amount ?? 800,
                'commission_rate' => $commissionRate,
                'status' => 'pending',
                'passenger_id' => $request->user()->id,
                'mode' => 'wallet',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Demande de trajet créée avec succès.',
            ], 201);
        } catch (\Exception $e) {
            // Loguer l'exception pour le suivi
            logger()->error('Erreur lors de la création de la demande de trajet.', [
                'error' => $e->getMessage(),
                'user_id' => $request->user()->id ?? null,
            ]);

            return response()->json([
                'success' => false,
                'errors' => ['Une erreur est survenue lors de la création de la demande de trajet.'],
            ], 500);
        }
    }


    private function generateUniqueRideNumber()
    {
        do {
            // Générer un numéro aléatoire de 8 caractères
            $numeroRide = Str::random(8);
        } while (Ride::where('numero_ride', $numeroRide)->exists()); // Vérifier son unicité

        return $numeroRide;
    }

    public function isWithinCountry(float $latitude, float $longitude, int $countryId): bool
    {
        // Récupérer le pays du conducteur
        $country = Country::find($countryId);

        // Vérifier si le pays existe
        if (!$country) {
            return false; // Retourner false si le pays n'est pas trouvé
        }

        // Si le pays est le Bénin
        if ($country->name === 'Bénin') {
            return $this->isWithinBenin($latitude, $longitude);
        }

        // Si le pays est le Togo
        if ($country->name === 'Togo') {
            return $this->isWithinTogo($latitude, $longitude);
        }

        // Retourner false si le pays n'est ni Bénin ni Togo
        return false;
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

    private function isWithinTogo(float $latitude, float $longitude): bool
    {
        $togoBounds = [
            'min_lat' => 6.122,  // Latitude minimale approximative du Togo
            'max_lat' => 11.130, // Latitude maximale approximative du Togo
            'min_lng' => 0.748,  // Longitude minimale approximative du Togo
            'max_lng' => 1.673,  // Longitude maximale approximative du Togo
        ];

        return $latitude >= $togoBounds['min_lat'] && $latitude <= $togoBounds['max_lat']
            && $longitude >= $togoBounds['min_lng'] && $longitude <= $togoBounds['max_lng'];
    }

    public function updateBookingStatus(Request $request)
    {
        // Validation des données
        $rules = [
            'booking_id' => 'required|exists:bookings,id', // L'ID de la réservation doit exister
            'status' => 'required|in:accepted,rejected,completed,suspended,in progress,cancelled,arrived,validated_by_passenger,validated_by_driver',
            'comment' => 'nullable|string|max:1000', // Le commentaire est facultatif mais doit respecter les contraintes s'il est présent
        ];

        // Ajouter une règle conditionnelle pour le champ "rating"
        if (in_array($request->status, ['validated_by_passenger', 'validated_by_driver'])) {
            $rules['rating'] = 'required|integer|between:1,5'; // Rating est requis uniquement pour ces statuts
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Les données envoyées ne sont pas valides.',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $user = auth()->user();

        // Récupérer la réservation
        $booking = Booking::find($request->booking_id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'errors' => ['Réservation introuvable.'],
            ], 404);
        }

        //Règles de modification de statut
        if ($booking->status === 'pending' && $request->status !== 'cancelled' && $request->status !== 'accepted') {
            return response()->json([
                'success' => false,
                'reason' => 'error',
                'errors' => ['Vous ne pouvez pas modifier la réservation !'],
            ], 400);
        }

        if ($booking->status === 'accepted' && $request->status !== 'in progress') {
            return response()->json([
                'success' => false,
                'errors' => ['Vous ne pouvez pas modifier la réservation !'],
            ], 400);
        }

        if ($request->status === 'rejected') {
            $booking->rejected_at = now();
        } elseif ($request->status === 'cancelled') {
            $booking->cancelled_at = now();
        }

        if ($request->status === 'accepted') {
            try {
                // Récupérer le taux de commission en float
                $commissionRate = (float) DB::table('settings')
                    ->where('key', 'commission_rate')
                    ->value('value');
        
                // Calcul de la commission
                $commission = $booking->total_price * $booking->seats_reserved * $commissionRate / 100;
                $commission = floor($commission / 5) * 5;

                // Vérifier si le solde de l'utilisateur est suffisant
                if ($booking->ride->available_seats < $booking->seats_reserved) {
                    return response()->json([
                        'success' => false,
                        'reason' => 'seats',
                        'errors' => ['Vous n\avez plus assez de place disponible pour accepter cette réservation. Veuillez recharger votre compte.'],
                    ], 400);
                }

                // Vérifier si le solde de l'utilisateur est suffisant
                if ($user->balance < $commission) {
                    return response()->json([
                        'success' => false,
                        'reason' => 'balance',
                        'errors' => ['Veuillez recharger votre compte afin d\'accepter cette réservation.'],
                    ], 400);
                }
        
                // Gérer la transaction
                DB::transaction(function () use ($user, $booking, $commission) {
                    // Déduire la commission du solde utilisateur
                    $user->balance -= $commission;
                    $user->save();
        
                    // Enregistrer le paiement
                    Payment::create([
                        'amount' => $commission,
                        'reference' => uniqid('PAY_'),
                        'payment_method' => 'MOMO',
                        'status' => 'SUCCESSFUL',
                        'booking_id' => $booking->id,
                        'payment_type_id' => 3,
                    ]);
        
                    // Mettre à jour la réservation
                    $booking->status = 'accepted';
                    $booking->accepted_at = now();
                    $booking->save();
        
                    // Mettre à jour les sièges disponibles du trajet
                    $ride = $booking->ride;
                    $ride->available_seats -= $booking->seats_reserved;
                    // if($ride->available_seats === 0)
                    //     $ride->status = 'pending';

                    $ride->save();
                });
        
                return response()->json([
                    'success' => true,
                    'balance' => $user->balance,
                    'message' => "Réservation acceptée avec succès.",
                ]);
            } catch (\Exception $e) {
                // Enregistrer l'erreur dans les logs avec des détails pertinents
                Log::error('Erreur lors de la transaction de réservation : ' . $e->getMessage(), [
                    'exception' => $e,
                    'booking_id' => $booking->id ?? null,
                    'user_balance' => $user->balance ?? null,
                    'booking_price' => $booking->total_price ?? null,
                ]);
        
                return response()->json([
                    'success' => false,
                    'errors' => ['Une erreur est survenue lors du paiement. Veuillez réessayer.'],
                ], 500);
            }
        }
        

        if ($request->status === 'in progress') {
            $booking->status = $request->status;
            $booking->in_progress_at = now();
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => "Arrivée enregistrée avec succès !",
            ], 400);
        }

        if(!$booking->is_by_passenger) {
            if ($booking->status == 'in progress' && $request->status !== 'validated_by_passenger') {
                return response()->json([
                    'success' => false,
                    'errors' => ['Vous ne pouvez pas modifier la réservation.'],
                ], 400);
            }
        }

        if ($booking->is_by_passenger && $request->status !== 'validated_by_driver') {
            return response()->json([
                'success' => false,
                'errors' => ['Vous ne pouvez pas modifier la réservation.'],
            ], 400);
        } elseif ($request->status === 'validated_by_passenger') {
            $booking->is_by_passenger = true;
            $booking->validated_by_passenger_at = now();
            $booking->save();

            try {
                $this->createReview(
                    $booking->id,
                    $request->input('rating'),
                    $request->input('comment'),
                    'passenger'
                );
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'errors' => ['Une erreur est survenue lors de la création de l\'avis : ' . $e->getMessage()],
                ], 500);
            }

            $this->proccessPayment($booking->id);

        } elseif ($request->status === 'validated_by_driver') {
            if (!$booking->is_by_passenger) {
                return response()->json([
                    'success' => false,
                    'errors' => ['La réservation doit être validée par le passager avant d\'être validée par le conducteur.'],
                ], 400);
            }

            $booking->is_by_driver = true;
            $booking->validated_by_driver_at = now();
            $booking->save();

            // Créer l'avis
            try {
                $this->createReview(
                    $booking->id,
                    $request->input('rating'),
                    $request->input('comment'),
                    'driver'
                );
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'errors' => ['Une erreur est survenue lors de la création de l\'avis : ' . $e->getMessage()],
                ], 500);
            }
        } else {
            // Mettre à jour le statut uniquement pour les autres statuts
            $booking->status = $request->status;
        }

        if ($booking->is_by_passenger && $booking->is_by_driver) {
            $booking->status = 'completed';
            // $user->balance += $booking->total_price * $booking->seats_reserved * (100 - $commissionRate) / 100;

            $ride = Ride::find($booking->ride_id);
            if ($ride) {
                DB::transaction(function () use ($ride, $booking) {
                    if ($ride) {
                        $this->makePayment($booking->id);
                        $ride->available_seats += $booking->seats_reserved;
                        $ride->save();
                    }
                });
            }
        }

        $booking->save();

        return response()->json([
            'success' => true,
            'balance' => $user->balance,
            'message' => 'Mises à jour effectuée avec succès.',
        ]);

    }

    private function createReview($bookingId, $rating, $comment, $role)
    {
        // Récupérer la réservation
        $booking = Booking::find($bookingId);

        if (!$booking) {
            throw new \Exception('Réservation introuvable.');
        }

        // Vérifier si la réservation est liée à un passager et un conducteur
        // if (!$booking->passenger_id || !$booking->driver_id) {
        //     throw new \Exception('Impossible de créer un avis, le passager ou le conducteur est manquant.');
        // }

        // Créer l'évaluation
        $review = new Review();
        $review->rating = $rating;
        $review->comment = $comment;
        $review->booking_id = $bookingId;
        $review->reviewer_id = Auth::id();
        $review->reviewer_type = $role;
        $review->save();

        return $review;
    }

    private function proccessPayment(int $bookingId)
    {
        DB::beginTransaction(); // Début de la transaction

        try {
            // Récupérer la réservation
            $booking = Booking::find($bookingId);
            if (!$booking) {
                return [
                    'success' => false,
                    'errors' => ['Réservation introuvable.'],
                ];
            }

            // Récupérer l'utilisateur lié à la réservation
            $user = $booking->passenger;
            if (!$user) {
                return [
                    'success' => false,
                    'errors' => ['Utilisateur introuvable.'],
                ];
            }

            // Traiter le paiement en fonction du mode
            if ($booking->mode === "wallet") {
                if ($user->balance < $booking->total_price) {
                    return [
                        'success' => false,
                        'errors' => ['Solde insuffisant pour effectuer le paiement.'],
                    ];
                }

                // Mettre à jour le solde
                $user->balance -= $booking->total_price;
                $user->save(); // Sauvegarder les changements

                Payment::create([
                    'amount' => $booking->total_price,
                    'reference' => uniqid('PAY_'),
                    'payment_method' => 'MOMO',
                    'status' => 'SUCCESSFUL',
                    'booking_id' => $booking->id,
                    'user_id' => $user->id,
                    'payment_type_id' => 1,
                ]);
            }

            // Si tout est correct, valider la transaction
            DB::commit();

            return [
                'success' => true,
                'message' => 'Paiement effectué avec succès.',
            ];
        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();

            // Journaliser l'erreur pour le suivi
            \Log::error('Erreur lors du traitement du paiement : ' . $e->getMessage());

            // Relancer l'exception pour l'appelant
            throw $e;
        }
    }

    private function makePayment(int $bookingId)
    {
        DB::beginTransaction(); // Début de la transaction

        try {
            // Récupérer la réservation
            $booking = Booking::find($bookingId);
            if (!$booking) {
                return [
                    'success' => false,
                    'errors' => ['Réservation introuvable !'],
                ];
            }

            // Récupérer le conducteur lié à la réservation
            $ride = $booking->ride;
            $user = $ride->driver;
            if (!$user) {
                return [
                    'success' => false,
                    'errors' => ['Utilisateur introuvable !'],
                ];
            }

            // Traiter le paiement en fonction du mode
            if ($booking->mode === "wallet") {
                // Mettre à jour le solde
                $user->balance += $booking->total_price;
                $user->save(); // Sauvegarder les changements

                Payment::create([
                    'amount' => $booking->total_price,
                    'reference' => uniqid('PAY_'),
                    'payment_method' => 'MOMO',
                    'status' => 'SUCCESSFUL',
                    'booking_id' => $booking->id,
                    'user_id' => $user->id,
                    'payment_type_id' => 1,
                ]);

                if ($ride) {
                    $ride->available_seats += $booking->seats_reserved;
                    $ride->save();
                } else {
                    return [
                        'success' => false,
                        'errors' => ['Trajet introuvable !'],
                    ];
                }
            }

            // Si tout est correct, valider la transaction
            DB::commit();

            return [
                'success' => true,
                'message' => 'Paiement effectué avec succès.',
            ];
        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();

            // Journaliser l'erreur pour le suivi
            \Log::error('Erreur lors du traitement du paiement : ' . $e->getMessage());

            // Relancer l'exception pour l'appelant
            throw $e;
        }
    }

    public function getKms()
    {
        $data = Kilometrage::whereCategorieId(1)->get();
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function calculateRidePrice(Request $request) {
        // Validation de la requête
        $validated = $request->validate([
            'distance' => 'required|numeric|min:1',
            'categorie_id' => 'sometimes|exists:categories,id'
        ]);
        
        $distance = (int) $validated['distance'];
        $categorieId = $validated['categorie_id'] ?? 1; // Valeur par défaut si non fournie
        
        try {
            // Récupération des tranches kilométriques depuis la base de données
            $kilometers = DB::table('kilometrages')
                ->where('categorie_id', $categorieId)
                ->orderBy('min_km', 'asc')
                ->get();
            
            if ($kilometers->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['Aucune tranche kilométrique trouvée pour cette catégorie']
                ], 404);
            }
            
            $totalPrice = 0;
            
            // Pour chaque km de la distance totale, trouver le taux applicable
            for ($currentKm = 1; $currentKm <= $distance; $currentKm++) {
                // Trouver la tranche applicable pour ce km
                foreach ($kilometers as $tranche) {
                    $minKm = (int) $tranche->min_km;
                    $maxKm = (int) $tranche->max_km;
                    
                    if ($currentKm >= $minKm && $currentKm <= $maxKm) {
                        $totalPrice += (int) $tranche->taux_par_km;
                        break;
                    }
                }
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'distance' => $distance,
                    'price' => $totalPrice,
                    'currency' => 'XOF' 
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => ['Une erreur est survenue lors du calcul du prix'],
                'error' => $e->getMessage()
            ], 500);
        }
    }
}