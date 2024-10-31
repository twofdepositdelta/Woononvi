<?php

namespace App\Http\Controllers;

use App\Models\RideSearch;
use App\Helpers\BackHelper;
use Illuminate\Http\Request;

class RideSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Appelle la fonction pour supprimer les recherches anciennes et récupère le nombre de recherches supprimées
    $deletedCount = BackHelper::deleteOldSearches();

    // Récupère les recherches de trajets, triées par date de création, avec pagination
    $ridesearches = RideSearch::orderBy('created_at', 'desc')->paginate(20);

    // Prépare le message de succès
    if ($deletedCount > 0) {
        return view('back.pages.trajets.searche', compact('ridesearches'))
            ->with('success', "{$deletedCount} recherche(s) supprimée(s) avec succès.");
    }

    // Renvoyer la vue avec les recherches sans message
    return view('back.pages.trajets.searche', compact('ridesearches'));
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
    public function show(RideSearch $rideSearch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RideSearch $rideSearch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RideSearch $rideSearch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RideSearch $rideSearch)
    {
        //
    }
}
