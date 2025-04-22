<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ride;
use App\Helpers\BackHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $rides = Ride::orderBy('created_at', 'desc')->paginate(10);

        // Récupérer le pays sélectionné de la session

        if (auth()->user()->hasRole(['support', 'manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $rides = Ride::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $rides = Ride::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }


      return view('back.pages.trajets.index', compact('rides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('back.pages.trajets.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'available_seats' => 'required|integer|min:1',
            'price_per_km' => 'required|integer|min:0',
            'is_nearby_ride' => 'boolean',
        ]);

        // Create a new ride entry in the database
        Ride::create([
            'departure' => $request->departure,
            'destination' => $request->destination,
            'departure_time' => $request->departure_time,
            'available_seats' => $request->available_seats,
            'price_per_km' => $request->price_per_km,
            'is_nearby_ride' => $request->has('is_nearby_ride') ? true : false, // Check if the checkbox is checked
            'driver_id' => auth()->id(), // Assuming the driver is the currently authenticated user
        ]);

        // Redirect back to a suitable route with a success message
        return redirect()->route('rides.index')->with('success', 'Trajet créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ride $ride)
    {
        return view('back.pages.trajets.show', compact('ride'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ride $ride)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ride $ride)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ride $ride)
    {
        //
    }

    public function historique()
    {
        //
        $user = Auth::user();

        $rides = Ride::where('driver_id', $user->id)->paginate(10);

        return view('back.pages.trajets.historique', compact('rides'));
    }

    public function updatestatus(Ride $ride, $status)
    {
        // Vérifier si le statut est valide
        if (! ($status == 'suspend')) {
            return redirect()->back()->with('error', 'Statut invalide.');
        }
        // Mettre à jour le statut
        $ride->status = $status;
        $ride->save();

        // Mail::to($order->user->email)->send(new UpdateStatusMail($order));
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le trajet  a été mis à jour.');
    }

    public function getActiveRides()
    {
        // Récupère les trajets actifs avec les informations nécessaires
        $rides = Ride::where('status', 'active')
            ->with(['driver:id,firstname,lastname,phone']) // Charger uniquement les champs nécessaires du conducteur
            ->get(['id', 'start_location', 'end_location', 'driver_id', 'numero_ride']); // Inclure 'end_location'

        // Vérifiez que des trajets sont bien renvoyés
        if ($rides->isEmpty()) {
            return response()->json(['rides' => []]); // Renvoie un tableau vide si aucun trajet actif
        }

        // Transforme les trajets pour inclure les informations du conducteur et les coordonnées d'arrivée
        $ridesWithDriver = $rides->map(function ($ride) {
            return [
                'id' => $ride->id,
                'start_latitude' => $ride->start_location->getLat(),  // Extraire la latitude du point de départ
                'start_longitude' => $ride->start_location->getLng(), // Extraire la longitude du point de départ
                'end_latitude' => $ride->end_location->getLat(),  // Extraire la latitude du point d'arrivée
                'end_longitude' => $ride->end_location->getLng(), // Extraire la longitude du point d'arrivée
                'start_location_name' => $ride->start_location_name,
                'end_location_name' => $ride->end_location_name,
                'numero' => $ride->numero_ride,
                'phone' => $ride->driver->phone ?? 'Non défini', // Vérifie si le téléphone existe
                'driver_name' => $ride->driver
                    ? $ride->driver->firstname . ' ' . $ride->driver->lastname
                    : 'Non défini', // Vérifie si le conducteur existe
            ];
        });

        return response()->json(['rides' => $ridesWithDriver]);
    }

    // Fonction pour mettre à jour la localisation d'un trajet
    public function updateLocation(Request $request, $rideId)
    {
        // Valider les données envoyées
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'distance_travelled' => 'nullable|integer',
        ]);

        // Appeler la méthode pour mettre à jour la position
        $this->updateRideLocation(
            $rideId,
            $request->latitude,
            $request->longitude,
            $request->distance_travelled
        );

        return response()->json(['message' => 'Position mise à jour avec succès']);
    }

    // Fonction qui met à jour la position du trajet dans la base de données
    public function updateRideLocation($rideId, $latitude, $longitude, $distanceTravelled)
    {
        // Trouver le trajet par son ID
        $ride = Ride::find($rideId);

        if ($ride) {
            // Mettre à jour la latitude, la longitude et la distance parcourue
            $ride->latitude = $latitude;
            $ride->longitude = $longitude;
            $ride->distance_travelled = $distanceTravelled;

            // Sauvegarder les changements dans la base de données
            $ride->save();
        } else {
            return response()->json(['message' => 'Trajet introuvable'], 404);
        }
    }

    public function statistique()
    {
        if (auth()->user()->hasRole('super admin')) {
            //

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné
            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $ridecount = Ride::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->count();
            $ridecountactive = Ride::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->where('status', 'active')->count();


            $ridecountcomplete = Ride::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->where('status', 'suspend')->count();

        }else{

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null;

            $ridecount = Ride::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                $query->where('id', $auth_country_id);
            })->count();
            $ridecountactive = Ride::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                $query->where('id', $auth_country_id);
            })->where('status', 'active')->count();


            $ridecountcomplete = Ride::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                $query->where('id', $auth_country_id);
            })->where('status', 'suspend')->count();


        }

            return view('back.pages.rapports.trajet.statistique', compact('ridecount', 'ridecountactive', 'ridecountcomplete'));

    }

    public function getRidesReport(Request $request)
    {


            if (auth()->user()->hasAnyRole(['super admin', 'dev'])) {
                $period = $request->get('period');
                $selectedCountry = session('selected_country', 'benin'); // 'benin' par défaut
                $country = BackHelper::getCountryByName($selectedCountry);
                $countryId = $country->id ?? null;

                $query = Ride::query();
                if ($countryId) {
                    $query->whereHas('driver.city.country', function ($q) use ($countryId) {
                        $q->where('id', $countryId);
                    });
                }

            }else {

                $auth_user = auth()->user();
                $auth_country_id = $auth_user->city->country->id ?? null;

                $period = $request->get('period');
                $query = Ride::query();
                if ($auth_country_id) {
                    $query->whereHas('driver.city.country', function ($q) use ($auth_country_id) {
                        $q->where('id', $auth_country_id);
                    });
                }



            }

            switch ($period) {
                case 'weeklyride':
                    // Définir les 4 dernières semaines
                    $startDate = Carbon::now()->subWeeks(4)->startOfWeek();
                    $endDate = Carbon::now()->endOfWeek();

                    // Réservations des 4 dernières semaines
                    $data = $query->whereBetween('created_at', [$startDate, $endDate])
                        ->selectRaw('WEEK(created_at) as label, COUNT(id) as total')
                        ->groupBy('label')
                        ->orderBy('label', 'asc')
                        ->get();

                    // Générer les labels "Semaine X"
                    $labels = $data->pluck('label')->map(function ($weekNumber) {
                        return 'Semaine '.$weekNumber;
                    })->toArray();
                    break;

                case 'monthlyride':
                    // Réservations par mois
                    $data = $query->selectRaw('MONTH(created_at) as label, COUNT(id) as total')
                        ->groupBy('label')
                        ->get();

                    $labels = $data->pluck('label')->map(function ($month) {
                        $monthNames = [
                            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
                            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
                            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre',
                        ];

                        return $monthNames[$month];
                    })->toArray();
                    break;

                case 'yearlyride':
                    // Réservations par année
                    $data = $query->selectRaw('YEAR(created_at) as label, COUNT(id) as total')
                        ->groupBy('label')
                        ->get();

                    $labels = $data->pluck('label')->toArray();
                    break;

                case 'todayride':
                    // Réservations pour aujourd'hui
                    $data = $query->whereDate('created_at', today())
                        ->selectRaw('COUNT(id) as total')
                        ->get();

                    $labels = ['Aujourd\'hui'];
                    break;

                default:
                    $data = [];
                    $labels = [];
            }

            $amounts = $data->pluck('total')->toArray();
            $total = array_sum($amounts);

            return response()->json([
                'labels' => $labels,
                'amounts' => $amounts,
                'total' => $total,
            ]);

    }


    // private function getCityFromLocation($location)
    // {
    //     // Convertir la géographie en point
    //     $point = json_decode($location);

    //     // Utiliser un service de géocodage pour obtenir le nom de la ville
    //     $geocoder = new \Geocoder\Provider\GoogleMaps\GoogleMaps($client, $adapter);

    //     $result = $geocoder->reverse($point->coordinates[1], $point->coordinates[0])->first();

    //     return $result ? $result->getLocality() : 'Inconnu';
    // }

}
