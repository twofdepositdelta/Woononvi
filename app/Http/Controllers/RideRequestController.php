<?php

namespace App\Http\Controllers;

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
        $rideRequests=RideRequest::orderBy('created_at','desc')->paginate(20);
        $rideRequestcount=RideRequest::count();
        $rideRequestcountpending=RideRequest::where('status','pending')->count();
        $rideRequestcountresponded=RideRequest::where('status','responded')->count();
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
