<?php

namespace App\Http\Controllers;

use App\Models\TypeNew;
use App\Models\Actuality;
use Illuminate\Support\Str;
use App\Helpers\FrontHelper;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

class ActualityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actualities = Actuality::orderBy('created_at','desc')->paginate(20); // Récupère toutes les actualités avec le type d'actualité
        return view('back.pages.actualities.index', compact('actualities'));
    }

    // Afficher le formulaire de création d'une nouvelle actualité
    public function create()
    {
        $typenews = TypeNew::orderBy('created_at','desc')->paginate(20);

        return view('back.pages.actualities.create', compact('typenews'));
    }

    // Sauvegarder une nouvelle actualité
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|image',
            'published' => 'boolean',
            'type_new_id' => 'required|exists:type_news,id',
        ]);

        $imageHelper = new ImageHelper();
        $imagePath = $imageHelper->enregistrerImage($request->image_url,'images/Actualité');
        Actuality::create([
            'titre' => $request->titre,
            'slug' => Str::slug($request->titre), // Générer un slug basé sur le titre
            'description' => $request->description,
            'image_url' =>FrontHelper::getEnvFolder().$imagePath,
            'published' => $request->has('published'),
            'type_new_id' => $request->type_new_id,
        ]);

        return redirect()->route('actualities.index')->with('success', 'Actualité créée avec succès.');
    }

    // Afficher les détails d'une actualité spécifique
    public function show( $slug)
    {
        $actuality=Actuality::where('slug',$slug)->first();
        return view('back.pages.actualities.show', compact('actuality'));
    }

    // Afficher le formulaire d'édition d'une actualité
    public function edit( $slug)
    {
        $typenews = TypeNew::orderBy('created_at','desc')->paginate(20);

        $actuality=Actuality::where('slug',$slug)->first();

        return view('back.pages.actualities.edit', compact('actuality', 'typenews'));
    }

    // Mettre à jour une actualité existante
    public function update(Request $request, $slug)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image',
            'published' => 'boolean',
            'type_new_id' => 'required|exists:type_news,id',
        ]);
        $actuality=Actuality::where('slug',$slug)->first();

        $imagePath = null;
        $imageHelper = new ImageHelper();
        if ($request->hasFile('image_url') && $request->file('image_url')->isValid()) {
            $imagePath = $imageHelper->enregistrerImage($request->image_url, 'images/realisations/');

            $imageHelper->removeImage($actuality->image_url);
        }

        $actuality->update([
            'titre' => $request->titre,
            'slug' => Str::slug($request->titre), // Générer un slug basé sur le titre
            'description' => $request->description,
            'image_url' => $imagePath ? $imagePath :$actuality->image_url,
            'published' => $request->has('published'),
            'type_new_id' => $request->type_new_id,
        ]);

        return redirect()->route('actualities.index')->with('success', 'Actualité mise à jour avec succès.');
    }

    // Supprimer une actualité
    public function destroy( $slug)
    {
        $actuality=Actuality::where('slug',$slug)->first();

        $actuality->delete();
        return redirect()->route('actualities.index')->with('success', 'Actualité supprimée avec succès.');
    }
}
