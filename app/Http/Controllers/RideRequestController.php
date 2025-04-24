<?php

namespace App\Http\Controllers;

use App\Helpers\BackHelper;
use App\Models\RideRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RideRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $rideRequests=RideRequest::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->orderBy('created_at', 'desc')
                                  ->paginate(20);

                                  $rideRequestcount=RideRequest::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                      $query->where('id', $auth_country_id);
                                  })->count();
                                  $rideRequestcountpending=RideRequest::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                      $query->where('id', $auth_country_id);
                                  })->where('status','pending')->count();
                                  $rideRequestcountresponded=RideRequest::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                      $query->where('id', $auth_country_id);
                                  })->where('status','responded')->count();
                }

        }else{
          // $rideRequests=RideRequest::orderBy('created_at','desc')->paginate(20);

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;


            $rideRequests=RideRequest::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->orderBy('created_at', 'desc')
            ->paginate(20);

            $rideRequestcount=RideRequest::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->count();
            $rideRequestcountpending=RideRequest::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->where('status','pending')->count();
            $rideRequestcountresponded=RideRequest::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->where('status','responded')->count();


        }

        return view('back.pages.demandes.index',compact('rideRequests','rideRequestcount','rideRequestcountpending','rideRequestcountresponded'));
    }

    public function historique()
    {
        //
        $user=Auth::user();
        $rideRequests=RideRequest::where('passenger_id',$user->id)->paginate(20);
        return view('back.pages.demandes.historique',compact('rideRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('back.pages.demandes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'departure' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'preferred_time' => 'required|date',
        'preferred_amount' => 'required|integer|min:1',
    ]);

    // Création de la demande de trajet
    RideRequest::create([
        'departure' => $validatedData['departure'],
        'destination' => $validatedData['destination'],
        'preferred_time' => $validatedData['preferred_time'],
        'preferred_amount' => $validatedData['preferred_amount'],
        'passenger_id' => auth()->user()->id,  // L'utilisateur connecté est défini comme passager
    ]);

    // Redirection après l'enregistrement avec un message de succès
    return redirect()->route('ride_requests.index')->with('success', 'Demande de trajet créée avec succès.');
}


    /**
     * Display the specified resource.
     */
    public function show(RideRequest $rideRequest)
    {
        //
        return view('back.pages.demandes.show',compact('rideRequest'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RideRequest $rideRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RideRequest $rideRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RideRequest $rideRequest)
    {
        //
    }

    public function updatestatus(RideRequest $rideRequest, $status)
{
    // Vérifier si le statut est valide
    if (!($status=='refunded')) {
        return redirect()->back()->with('error', 'Statut invalide.');
    }
    // Mettre à jour le statut
    $rideRequest->status = $status;
    $rideRequest->save();

    // Mail::to($order->user->email)->send(new UpdateStatusMail($order));
    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'La demande  a été mis à jour.');
}
}
