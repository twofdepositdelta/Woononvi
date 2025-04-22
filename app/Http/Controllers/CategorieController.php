<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct()
    {
        // Vérifier si l'utilisateur a l'un des rôles 'super admin' ou 'manager'
        if (!auth()->user()->hasAnyRole(['super admin', 'manager' ,'dev'])) {
            // Si l'utilisateur n'a pas le rôle requis, lancer une exception ou une erreur
            abort(401);
        }

        // Autres initialisations
        $this->var = 'valeur'; // Exemple de variable à initialiser
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::orderBy('created_at','desc')->paginate(20);
        return view('back.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255|unique:categories,label',
        ]);

        $categorie = Categorie::create([
            'label' => $request->label,
            'slug' => Str::slug($request->label),
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        return view('back.pages.categories.show', compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        return view('back.pages.categories.edit', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'label' => 'required|string|max:255|unique:categories,label,'.$categorie->id,
        ]);

        $categorie->update([
            'label' => $request->label,
            'slug' => Str::slug($request->label),
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégories mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
