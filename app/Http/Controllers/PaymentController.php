<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Helpers\BackHelper;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        public function index()
        {
            if (auth()->user()->hasRole(['support','manager'])) {

                $auth_user = auth()->user();
                $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
                // Vérifier si le pays a été trouvé
                    if ($auth_country_id) {
                        // Récupérer les trajets où le conducteur appartient au même pays
                        $payments = Payment::whereHas('user.city.country', function ($query) use ($auth_country_id) {
                                        $query->where('id', $auth_country_id);
                                    })->orderBy('created_at', 'desc')
                                      ->paginate(10);

                    }


            }else{

                $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

                // Récupérer l'ID du pays basé sur le pays sélectionné
                $countryName = BackHelper::getCountryByName($selectedCountry);
                $countryid =$countryName->id;

                $payments = Payment::whereHas('user.city.country', function ($query) use ($countryid) {
                    $query->where('id', $countryid);
                })->orderBy('created_at', 'desc')
                  ->paginate(10);


            }

            $typepayments= PaymentType::orderBy('created_at', 'desc')->get();

            return view('back.pages.paiements.index', compact('payments','typepayments'));
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
    public function show( $reference)
    {
        $payment=Payment::where('reference',$reference)->firstOrFail();
        return view('back.pages.paiements.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function historique()
    {
        //
        $user=Auth::user();

        $payments = Payment::where('user_id', $user->id)->paginate(10);
        return view('back.pages.paiements.historique',compact('payments'));
    }

    public function filterByType(Request $request)
    {
        $query = Payment::query();


        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
               if ($auth_country_id) {

                if ($request->typeId) {
                    $query->where('payment_type_id', $request->typeId);
                }

                $query->whereHas('user.city.country', function ($q) use ($auth_country_id) {
                    $q->where('id', $auth_country_id);
                });

                $payments = $query->orderByDesc('created_at')->paginate(10);
                }
        }else{
            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

                // Récupérer l'ID du pays basé sur le pays sélectionné
                $countryName = BackHelper::getCountryByName($selectedCountry);
                $countryid = $countryName->id;


                if ($request->typeId) {
                    $query->where('payment_type_id', $request->typeId);
                }

                $query->whereHas('user.city.country', function ($q) use ($countryid) {
                    $q->where('id', $countryid);
                });

                $payments = $query->orderByDesc('created_at')->paginate(10);


        }

        // Retourner la vue partielle de la table avec les véhicules filtrés
        return view('back.pages.paiements.table', compact('payments'));
    }

}
