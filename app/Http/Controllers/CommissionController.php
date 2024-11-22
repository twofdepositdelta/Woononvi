<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasAnyRole(['super admin', 'manager'])){
            /// Récupérer toutes les commissions
            $commissions = Booking::all();

            // Calcul du total des commissions (toutes)
            $totalcommission = $commissions->sum(function ($booking) {
                return $booking->total_price * ($booking->commission_rate / 100);
            });

            // Récupérer les commissions associées aux trajets en attente et actifs
            $commission_pending = Booking::where('status', 'pending')->get();
            $commission_actif = Booking::where('status', 'accepted')->get();

            // Calcul des totaux pour les commissions "pending" et "active"
            $totalpendingcomiss = $commission_pending->sum(function ($booking) {
                return $booking->total_price * ($booking->commission_rate / 100);
            });

            $totalactifcomiss = $commission_actif->sum(function ($booking) {
                return $booking->total_price * ($booking->commission_rate / 100);
            });


            return view('back.pages.commission.index',compact('totalpendingcomiss','totalactifcomiss','totalcommission'));
       }else{

        abort(401);
       }

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commission $commission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commission $commission)
    {
        //
    }





}
