<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Kilometrage;
use Illuminate\Http\Request;

class KilometrageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kilos = Kilometrage::orderByDesc('created_at')
        ->orderBy('categorie_id')
        ->paginate(10);

        $categories = Categorie::all();

        return view('back.pages.kilometrages.index',compact('kilos','categories'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Categorie::all();

        return view('back.pages.kilometrages.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'min_km' => 'required|array',
            'max_km' => 'required|array',
            'taux_par_km' => 'required|array',
            'categorie_id' => 'required|array',
            'min_km.*' => 'required|numeric|min:1',
            'max_km.*' => 'required|numeric|min:1|gte:min_km.*',
            'taux_par_km.*' => 'required|numeric|min:1',
            'categorie_id.*' => 'required|exists:categories,id',
        ]);


        $newIntervals = []; // Temp pour comparer les nouveaux entre eux

        foreach ($request->min_km as $index => $minKm) {
            $maxKm = $request->max_km[$index];
            $categorieId = $request->categorie_id[$index];

            // 1. Vérifie que min <= max
            if ($minKm > $maxKm) {
                return redirect()->back()->withErrors([
                    "min_km.$index" => "L’intervalle [$minKm - $maxKm] km n’est pas valide : le kilométrage minimal doit être inférieur ou égal au maximal.",
                ])->withInput();
            }

            // 2. Vérifie si ça chevauche un intervalle déjà enregistré
            $exists = Kilometrage::where('categorie_id', $categorieId)
                ->where(function ($query) use ($minKm, $maxKm) {
                    $query->where(function ($q) use ($minKm, $maxKm) {
                        $q->where('min_km', '<=', $maxKm)
                        ->where('max_km', '>=', $minKm);
                    });
                })
                ->exists();

            if ($exists) {
                return redirect()->back()->withErrors([
                    "min_km.$index" => "L’intervalle [$minKm - $maxKm] km entre en conflit avec un autre déjà enregistré pour cette catégorie. Veuillez saisir un intervalle totalement distinct.",
                ])->withInput();
            }

            // 3. Vérifie si ça chevauche un autre intervalle dans la même soumission
            foreach ($newIntervals as $prevIndex => $prev) {
                if ($prev['categorie_id'] === $categorieId) {
                    if ($minKm <= $prev['max'] && $maxKm >= $prev['min']) {
                        return redirect()->back()->withErrors([
                            "min_km.$index" => "L’intervalle [$minKm - $maxKm] km que vous avez saisi entre en conflit avec un autre intervalle que vous avez aussi saisi dans ce formulaire : [$prev[min] - $prev[max]] km. Assurez-vous que tous les intervalles soient totalement séparés.",
                        ])->withInput();
                    }
                }
            }

            // 4. Ajout à la liste temporaire
            $newIntervals[] = [
                'min' => $minKm,
                'max' => $maxKm,
                'categorie_id' => $categorieId,
            ];

            // 5. Enregistrement en base
            Kilometrage::create([
                'min_km' => $minKm,
                'max_km' => $maxKm,
                'taux_par_km' => $request->taux_par_km[$index],
                'categorie_id' => $categorieId,
            ]);
        }


        return redirect()->route('settings')->with('success','Kilometrage ajouter avec succès');



    }

    /**
     * Display the specified resource.
     */
    public function show(Kilometrage $kilometrage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kilometrage $kilometrage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kilometrage $kilometrage)
    {
        $request->validate([
            'min_km' => 'required|numeric|min:1',
            'max_km' => 'required|numeric|min:1',
            'taux_par_km' => 'required|numeric|min:1',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        if ($request->min_km > $request->max_km) {
            return redirect()->back()->withErrors([
                'min_km' => "Le kilométrage minimal doit être inférieur ou égal au maximal.",
            ])->withInput();
        }

        // Vérifie les conflits avec les autres intervalles sauf celui en cours
        $exists = Kilometrage::where('categorie_id', $request->categorie_id)
            ->where('id', '!=', $kilometrage->id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('min_km', '<=', $request->max_km )
                    ->where('max_km', '>=', $request->min_km );
                });
            })
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors([
                'min_km' => "L’intervalle que vous avez saisi [{$request->min_km} - {$request->max_km}] km est en conflit avec un autre déjà enregistré pour cette catégorie. Veuillez choisir un intervalle totalement distinct.",
            ])->withInput();
        }

        // Mise à jour
        $kilometrage->update([
            'min_km' => $request->min_km,
            'max_km' => $request->max_km,
            'taux_par_km' => $request->taux_par_km,
            'categorie_id' => $request->categorie_id,
        ]);

        return back()->with('success', 'Kilométrage modifié avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kilometrage $kilometrage)
    {
        $kilometrage->delete();

        return back()->with('success','Action effectuée succès');
    }

    public function filter(Request $request){

        $query = Kilometrage::query();

        // Si statut spécifié
        if ($request->categorie) {
            $query->where('categorie_id', $request->categorie);
        }

        $kilos = $query->orderByDesc('created_at')
                ->orderBy('categorie_id')
                ->paginate(10);


        return view('back.pages.kilometrages.table', compact('kilos'))->render();

    }
}
