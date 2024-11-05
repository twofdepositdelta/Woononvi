<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookings=Booking::orderBy('created_at','desc')->paginate(10);
        return view('back.pages.reservations.index',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $rides=Ride::orderBy('created_at','desc')->paginate(10);
        return view('back.pages.reservations.create',compact('rides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          // Validation des données
          $request->validate([
            'seats_reserved' => 'required|integer|min:1|max:10', // Assurez-vous que le nombre de places réservées est entre 1 et 4
            'ride_id' => 'required|exists:rides,id', // Assurez-vous que le trajet existe
            'total_price' => 'required|integer|min:1000', // Assurez-vous que le prix total est un entier positif
        ]);

        // Création de la réservation
        Booking::create([
            'seats_reserved' => $request->seats_reserved,
            'total_price' => $request->total_price,
            'ride_id' => $request->ride_id,
            'passenger_id' => Auth::id(), // Utilisateur connecté comme passager
        ]);

        // Redirection vers la liste des réservations avec un message de succès
        return redirect()->route('bookings.index')->with('success', 'Réservation créée avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
        return view('back.pages.reservations.show',compact('booking'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function historique()
    {
        //
        $user=Auth::user();

        $bookings=Booking::where('passenger_id',$user->id)->paginate(10);

        return view('back.pages.reservations.historique',compact('bookings'));
    }


    public function updatestatus(Booking $booking, $status)
{
    // Vérifier si le statut est valide
    if (!($status=='refunded')) {
        return redirect()->back()->with('error', 'Statut invalide.');
    }
    // Mettre à jour le statut
    $booking->status = $status;
    $booking->save();

    //  Mail::to($booking->passenger->email)->send(new UpdateStatusMail($booking));
    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'La reservation a été mis à jour.');
}

}
