<?php

namespace App\Http\Controllers;

use App\Models\TypeVehicle;
use Illuminate\Http\Request;

class TypeVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $typevehicles=TypeVehicle::orderBy('created_at','desc')->paginate(10);
        return view('back.pages.TypeVehicules.index',compact('typevehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('back.pages.TypeVehicules.create');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'label' => 'required|string|max:255',
            'taux_per_km' => 'required|numeric',
        ]);

        // Create a new ride entry in the database
            TypeVehicle::create([
            'label' => $request->label,
            'taux_per_km' => $request->question,
            'slug'=>Str::slug($request->label),
        ]);


        // Redirect back to a suitable route with a success message
        return redirect()->route('typevehicles.index')->with('success', 'créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeVehicle $typeVehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $slug)
    {
        //

        $typevehicle=TypeVehicle::where('slug',$slug)->first();
       return view('back.pages.TypeVehicules.edit', compact('typevehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeVehicle $typeVehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        //
        $typevehicle=TypeVehicle::where('slug',$slug)->first();
        $typevehicle->delete();

        return redirect()->route('typevehicles.index')->with('success', 'Faq a été supprimé avec succès !');

    }
}
