<?php

namespace App\Http\Controllers;

use App\Models\Ride;
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
        $rides=Ride::orderBy('created_at','desc')->paginate(10);

        return view('back.pages.trajets.index',compact('rides'));
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
        return view('back.pages.trajets.show',compact('ride'));
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
        $user=Auth::user();

        $rides=Ride::where('driver_id',$user->id)->paginate(10);

        return view('back.pages.trajets.historique',compact('rides'));
    }


    public function updatestatus(Ride $ride, $status)
    {
        // Vérifier si le statut est valide
        if (!($status=='suspend')) {
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
        $rides = Ride::where('status', 'active')->get(['id', 'latitude', 'longitude', 'driver_id']);

        // Vérifiez que des trajets sont bien renvoyés
        if ($rides->isEmpty()) {
            return response()->json(['rides' => []]); // Renvoie un tableau vide si aucun trajet actif
        }

        return response()->json(['rides' => $rides]);
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
}
