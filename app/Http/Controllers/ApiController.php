<?php

namespace App\Http\Controllers;

use App\Models\Api;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function __construct()
    {
        // Vérifier si l'utilisateur a l'un des rôles 'super admin' ou 'manager'
        if (!auth()->user()->hasAnyRole(['super admin','dev'])) {
            // Si l'utilisateur n'a pas le rôle requis, lancer une exception ou une erreur
            abort(401);
        }

        // Autres initialisations
        $this->var = 'valeur'; // Exemple de variable à initialiser
    }
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
        // Validation des champs
        $validatedData = $request->validate([
            'maps' => 'nullable|string|max:255',
            'feedpay_public' => 'nullable|string|max:255',
            'feedpay_private_sandbox' => 'nullable|string|max:255',
            'feedpay_secret_sandbox' => 'nullable|string|max:255',
            'feedpay_private_production' => 'nullable|string|max:255',
            'feedpay_secret_production' => 'nullable|string|max:255',

            'kkiapay_public' => 'nullable|string|max:255',
            'kkiapay_private_sandbox' => 'nullable|string|max:255',
            'kkiapay_secret_sandbox' => 'nullable|string|max:255',
            'kkiapay_private_production' => 'nullable|string|max:255',
            'kkiapay_secret_production' => 'nullable|string|max:255',

        ]);

        // Mettre à jour Google Maps
        Api::where('name', 'google')->update(['maps' => $validatedData['maps'] ?? null]);

        // Mettre à jour Feedpay pour chaque environnement
        Api::where('name', 'feedpay')
            ->where('environment_id', 1)
            ->update([
                'feedpay_public' => $validatedData['feedpay_public'] ?? null,
                'feedpay_private' => $validatedData['feedpay_private_sandbox'] ?? null,
                'feedpay_secret' => $validatedData['feedpay_secret_sandbox'] ?? null,
            ]);

        Api::where('name', 'feedpay')
            ->where('environment_id', 2)
            ->update([
                'feedpay_private' => $validatedData['feedpay_private_production'] ?? null,
                'feedpay_secret' => $validatedData['feedpay_secret_production'] ?? null,
            ]);

        // Mettre à jour Kkiapay pour chaque environnement
        Api::where('name', 'kkiapay')
            ->where('environment_id', 1)
            ->update([
                'kkiapay_public' => $validatedData['kkiapay_public'] ?? null,
                'kkiapay_private' => $validatedData['kkiapay_private_sandbox'] ?? null,
                'kkiapay_secret' => $validatedData['kkiapay_secret_sandbox'] ?? null,
            ]);

        Api::where('name', 'kkiapay')
            ->where('environment_id', 2)
            ->update([
                'kkiapay_private' => $validatedData['kkiapay_private_production'] ?? null,
                'kkiapay_secret' => $validatedData['kkiapay_secret_production'] ?? null,
            ]);

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
        $apimaps=Api::where('name','google')->first();
        $apifeedpays=Api::where('name','feedpay')->get();
        $apikkiapays=Api::where('name','kkiapay')->get();
        return view('back.pages.settings.api',compact('api','apifeedpays','apikkiapays','apimaps'));
    }
}
