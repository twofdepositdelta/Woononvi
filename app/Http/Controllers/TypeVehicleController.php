<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\TypeVehicle;
use Illuminate\Support\Str;
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
        $categories = Categorie::get();
        return view('back.pages.TypeVehicules.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'label' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        // Create a new ride entry in the database
            TypeVehicle::create([
            'label' => $request->label,
            'slug'=>Str::slug($request->label),
            'categorie_id' => $request->categorie_id,
        ]);


        // Redirect back to a suitable route with a success message
        return redirect()->route('typevehicles.index')->with('success', 'Créé avec succès !');
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
        $typevehicle=TypeVehicle::where('slug',$slug)->first();
        $categories = Categorie::get();
       return view('back.pages.TypeVehicules.edit', compact('typevehicle', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $typeVehicle=TypeVehicle::where('slug',$slug)->first();
        if(!$typeVehicle){
            return redirect()->back()->with('warning', 'Type de véhicule non trouvé');
        }

        //
        $request->validate([
            'label' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        // Create a new ride entry in the database
        $typeVehicle->update([
            'label' => $request->label,
            'slug'=>Str::slug($request->label),
            'categorie_id' => $request->categorie_id,
        ]);

        // Redirect back to a suitable route with a success message
        return redirect()->route('typevehicles.index')->with('success', 'Mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $typevehicle=TypeVehicle::where('slug',$slug)->firstOrFail();

        if($typevehicle->vehicles()->count() > 0){
            return redirect()->back()->with('error', 'Impossible de supprimer le type du véhicule.');
        }else{
            $typevehicle->delete();

            return redirect()->route('typevehicles.index')->with('success', 'Type supprimé avec succès !');
        }
    }
}
