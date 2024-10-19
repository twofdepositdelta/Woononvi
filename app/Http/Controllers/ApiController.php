<?php

namespace App\Http\Controllers;

use App\Models\Api;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Api $api)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Api $api)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    // Valider les données soumises dans le formulaire
    $validatedData = $request->validate([
        'maps' => 'nullable|string|max:255',
        'feedpay_public' => 'nullable|string|max:255',
        'feedpay_private' => 'nullable|string|max:255',
        'feedpay_secret' => 'nullable|string|max:255',
        'kkiapay_public' => 'nullable|string|max:255',
        'kkiapay_private' => 'nullable|string|max:255',
        'kkiapay_secret' => 'nullable|string|max:255',
    ]);

    // Récupérer l'instance API à mettre à jour
    $api = Api::first();

    // Mettre à jour chaque champ validé
    $api->update($validatedData);

    // Redirection après la mise à jour avec un message de succès
    return redirect()->back()->with('success', 'Paramètres API mis à jour avec succès.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Api $api)
    {
        //
    }


    public function api()
    {
        //
        $api=Api::first();
        return view('back.pages.settings.api',compact('api'));
    }
}
