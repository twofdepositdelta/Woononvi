<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        'settings.company_name' => 'required|string|max:255',
        'settings.company_phone' => 'required|string|max:20',
        'settings.company_email' => 'required|email|max:255',
        'settings.company_address' => 'nullable|string|max:255',
        'settings.default_language' => 'nullable|string|max:255',
        'settings.timezone' => 'nullable|string|max:255',
        'settings.commission_rate' => 'nullable|numeric|min:0',
        'settings.currency' => 'nullable|string|max:10',
        'settings.company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    foreach ($validatedData['settings'] as $key => $value) {
        // Si le paramètre concerne le logo de l'entreprise
        if ($key === 'company_logo' && $request->hasFile('settings.company_logo')) {
            // Upload du fichier et récupération du chemin
            $logoPath = $request->file('settings.company_logo')->store('logos', 'public');
            $value = $logoPath;
        }

        // Mettre à jour chaque paramètre dans la base de données
        Setting::where('key', $key)->update(['value' => $value]);
    }

    // Redirection après la mise à jour
    return redirect()->back()->with('success', 'Paramètres mis à jour avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function setting()
    {
        //
        $settings=Setting::all();
        return view('back.pages.setting_edit',compact('settings'));
    }
}