<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use App\Mail\ReclamationResolueMail;
use Illuminate\Support\Facades\Mail;

class ReclamationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reclamations = Reclamation::latest()->paginate(10);
        return view('back.pages.reclamation.index',compact('reclamations'));
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
    public function show(Reclamation $reclamation)
    {
        //
        return view('back.pages.reclamation.show',compact('reclamation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reclamation $reclamation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reclamation $reclamation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reclamation $reclamation)
    {
        //
    }

    public function updateStatut(Request $request, Reclamation $reclamation)
{
    $request->validate([
        'statut' => 'required|in:en_attente,en_cours,resolue',
    ]);

    $reclamation->update([
        'statut' => $request->statut,
    ]);

    if ($request->statut == 'resolue') {
        Mail::to($reclamation->user->email)->send(new ReclamationResolueMail($reclamation));
    }


    return back()->with('success', 'Statut mis à jour avec succès.');
}

}
