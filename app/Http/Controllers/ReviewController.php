<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Helpers\BackHelper;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $reviews=Review::whereHas('reviewer.city.country', function ($query) use ($auth_country_id) {
                        $query->where('id', $auth_country_id);
                    })->orderBy('created_at','desc')->paginate(20);
                }


        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $reviews=Review::whereHas('reviewer.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->orderBy('created_at','desc')->paginate(20);


        }

        return view('back.pages.avis.index',compact('reviews'));

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
    public function show(Review $review)
    {
        //
        $review->load(['reviewer', 'booking.ride']);
        return view('back.pages.avis.show',compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
