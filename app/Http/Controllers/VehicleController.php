<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Mail\VehicleStatus;
use App\Models\TypeVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vehicles=Vehicle::orderBy('created_at','desc')->paginate(10);
        $typevehicles=TypeVehicle::orderBy('created_at','desc')->paginate(10);

        return view('back.pages.vehicules.index',compact('vehicles','typevehicles'));
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
    public function show($slug)
    {
        //
        $vehicle=Vehicle::where('slug',$slug)->first();
        return view('back.pages.vehicules.show',compact('vehicle'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $slug)
    {
        //
        $vehicle=Vehicle::where('slug',$slug)->first();
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'vehicule a été supprimé avec succès !');
    }

    public function filterByType(Request $request)
{
    // Récupérer le type de véhicule filtré
    $typeId = $request->input('type_id');

    // Si un type de véhicule est sélectionné, filtrer les véhicules
    if ($typeId) {
        $vehicles = Vehicle::where('type_vehicle_id', $typeId)->orderBy('created_at', 'desc')->get();
    } else {
        // Si aucun type n'est sélectionné, récupérer tous les véhicules
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();
    }

    // Retourner la vue partielle de la table avec les véhicules filtrés
    return view('back.pages.vehicules.table', compact('vehicles'));
}

    public function status($slug){
        $vehicle=Vehicle::where('slug',$slug)->first();
        $vehicle->is_active=!$vehicle->is_active;
        $vehicle->save();
        Mail::to($vehicle->drivver->email)->send(new VehicleStatus($vehicle));

        return redirect()->route('vehicles.index')->with('success', 'vehicule a été supprimé avec succès !');
        
    }

}
