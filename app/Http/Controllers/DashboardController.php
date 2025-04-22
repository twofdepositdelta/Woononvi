<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Setting;
use App\Helpers\BackHelper;
use App\Models\Kilometrage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->user()->hasRole('support')) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les reservations où le conducteur appartient au même pays
                    $last30Days = User::whereHas('city.country', function ($query) use ($auth_country_id) {
                        $query->where('id', $auth_country_id);
                     })->where('created_at', '>=', Carbon::now()->subDays(30));

                     $totalDriversLast30Days = User::whereHas('city.country', function ($query) use ($auth_country_id) {
                        $query->where('id', $auth_country_id);
                     })->where('created_at', '>=', Carbon::now()->subDays(30))
                        ->role('driver')
                         ->count();
                }

        }else{
            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $last30Days = User::whereHas('city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->where('created_at', '>=', Carbon::now()->subDays(30));


             $totalDriversLast30Days = User::whereHas('city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->where('created_at', '>=', Carbon::now()->subDays(30))
                ->role('driver')
                 ->count();

        }
        // $last30Days = User::where('created_at', '>=', Carbon::now()->subDays(30));
        $totalUsersLast30Days = $last30Days->count();
        $totalPassengersLast30Days = $last30Days->role('passenger')->count();

        // $totalDriversLast30Days = User::where('created_at', '>=', Carbon::now()->subDays(30))
        //                  ->role('driver')
        //                  ->count();
        $totalDrivers = User::role('driver')->count();

        // dd(BackHelper::getTodayBookings());

        return view('dashboard',
                    compact(
                            'totalUsersLast30Days',
                            'totalPassengersLast30Days',
                            'totalDriversLast30Days',
                        )
                    );
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
        'settings.Suggested_Price' => 'nullable|numeric|min:0',
        'settings.Booking_Percentage' => 'nullable|numeric|min:0',
        'settings.Mini_Price_Kilomete' => 'nullable|numeric|min:0',
        'settings.Max_Price_Kilomete' => 'nullable|numeric|min:0',



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
        if (auth()->user()->hasAnyRole(['super admin' ,'dev'])) {
            $settings=Setting::all();
            $kilos = Kilometrage::latest()->get();
            return view('back.pages.settings.index',compact('settings','kilos'));
        }else{

            abort(401);
        }
    }

    public function city()
{
    $countries = Country::orderBy('created_at', 'asc')->paginate(20);



    $countryactives = Country::where('is_active', true)->get();

    // Récupérer les villes dont le pays est actif
    $cities = City::whereHas('country', function ($query) {
        $query->where('is_active', true);
    })->paginate(20);

    return view('back.pages.settings.gestcity', compact('countries','cities','countryactives'));
}

    public function countryStatus(Request $request, Country $country)
    {
        $country->update([
            'is_active' => $country->is_active ? 0 : 1
        ]);

        return redirect()->back();
    }

    public function cityStatus(Request $request, City $city)
    {
        $city->update([
            'status' => $city->status ? 0 : 1
        ]);

        return redirect()->back();
    }



    public function filterCitiesByCountry(Request $request)
    {
        $countryId = $request->input('country_id');

        // Récupérer les villes selon le pays sélectionné
        $cities = City::when($countryId, function ($query) use ($countryId) {
            return $query->where('country_id', $countryId);
        })->paginate(20);

        // Retourner la vue partielle avec les villes filtrées
        return view('back.pages.settings.city_table', compact('cities'));
    }

    public function cartograpie()
    {
        return view('back.pages.trajets.cartograpie');
    }

}
