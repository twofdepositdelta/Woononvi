<?php

namespace App\Http\Controllers;

use App\Models\TypeNew;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TypeNewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typenews = TypeNew::orderBy('created_at','desc')->paginate(20);
        return view('back.pages.typeactualite.index', compact('typenews'));
    }

    /**
     * Affiche le formulaire pour créer un nouveau type d'actualité.
     */
    public function create()
    {
        return view('back.pages.typeactualite.create');
    }

    /**
     * Enregistre un nouveau type d'actualité dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        TypeNew::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'description'=>$request->description
        ]);

        return redirect()->route('typenews.index')->with('success', 'Type d\'actualité créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un type d'actualité existant.
     */
    public function edit( $slug)
    {
        $typenew=TypeNew::where('slug',$slug)->first();
        return view('back.pages.typeactualite.edit', compact('typenew'));
    }

    /**
     * Met à jour le type d'actualité existant dans la base de données.
     */
    public function update(Request $request,  $slug)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',

        ]);

        $typenew=TypeNew::where('slug',$slug)->first();

        $typenew->update([
            'name'=>$request->name,
            'slug' => Str::slug($request->name),
            'description'=>$request->description
        ]);

        return redirect()->route('typenews.index')->with('success', 'Type d\'actualité mis à jour avec succès.');
    }

    /**
     * Supprime un type d'actualité de la base de données.
     */
    public function destroy( $slug)
    {

        $typenew=TypeNew::where('slug',$slug)->first();

        $typenew->delete();

        return redirect()->route('typenews.index')->with('success', 'Type d\'actualité supprimé avec succès.');
    }
}
