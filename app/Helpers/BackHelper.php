<?php

namespace App\Helpers;

use App;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use App\Models\RideSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\City;
use App\Models\Country;
use App\Models\Ride;
use App\Models\Booking;
use App\Models\RideRequest;
use App\Models\Conversation;
use App\Models\Payment;
use App\Models\Commission;

class BackHelper
{
    public static function getEnvFolder()
    {
        $folder = null;
        if (! App::environment('local')) {
            $folder = 'public/';
        }

        return $folder;
    }

    public static function getFullname(User $user)
    {
        return strtoupper($user->firstname) . ' ' . ucfirst(strtolower($user->lastname));
    }

    public static function deleteOldSearches()
    {
        // Récupère la date d'un an en arrière
        $oneYearAgo = Carbon::now()->subYear();

        // Supprime les recherches plus anciennes d'un an
        RideSearch::where('created_at', '<', $oneYearAgo)->delete();
    }

    public static function getSetting()
    {
        $setting = Setting::where('key' ,'company_name')->first();
        return $setting;
    }

    // Les statistiques

    // 1 . Nombre des utilisateurs

    public static function getUsersTotal()
    {

        return User::count();
    }

    public static function getPassengersTotal()
    {
        if (auth()->user()->hasRole('support')) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les reservations où le conducteur appartient au même pays
                    $total = User::whereHas('city.country', function ($query) use ($auth_country_id) {
                        $query->where('id', $auth_country_id);
                     })->role('passenger')->count();


                }

        }else{
            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $total = User::whereHas('city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->role('passenger')->count();



        }

        // $total = User::role('passenger')->count();

        return $total;
    }

    public static function getDriversTotal()
    {
        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les reservations où le conducteur appartient au même pays
                    $total = User::whereHas('city.country', function ($query) use ($auth_country_id) {
                        $query->where('id', $auth_country_id);
                     })->role('driver')->count();


                }

        }else{
            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $total = User::whereHas('city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->role('driver')->count();



        }
        // $total = User::role('driver')->count();

        return $total;
    }

    // 2 . Trajet

    public static function getRidesTotal()
    {
        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $rides = Ride::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->count();
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $rides = Ride::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->count();
        }
        return $rides;
    }

    public static function getRidesActive()
    {
        $now = Carbon::now(); // Récupérer la date et l'heure actuelles

        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $rides = Ride::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->where('status', 'active')->get();
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $rides = Ride::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->where('status', 'active')->get();
        }

        // Compter les trajets
        $total = $rides->count();

        return $total;
    }

    public static function getBooking()
    {


        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $total = Booking::whereHas('ride.driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->count();;
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $total = Booking::whereHas('ride.driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->count();
        }

        return $total;
    }

    public static function getBookingPending()
    {
        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $total = Booking::whereHas('ride.driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->where('status', 'pending')->count();
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $total = Booking::whereHas('ride.driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->where('status', 'pending')->count();
        }

        return $total;
    }

    public static function getRideRequest()
    {
        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $total = RideRequest::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->count();
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $total = RideRequest::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->count();
        }
        // $total = RideRequest::count();

        return $total;
    }

    public static function getRideNotResponse()
    {
        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $total = RideRequest::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->where('status', '!=', 'responded')->count();
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $total = RideRequest::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->where('status', '!=', 'responded')->count();
        }
        // $total = RideRequest::where('status', '!=', 'responded')->count();

        return $total;
    }

    public static function getTotalBookingPayments()
    {
        $selectedCountry = session('selected_country', 'benin');

        // Obtenir l'ID du pays via BackHelper
        $countryName = BackHelper::getCountryByName($selectedCountry);
        $countryId = $countryName->id ?? null; // Assurez-vous que $countryName n'est pas null

        // Récupérer le montant total des paiements liés aux réservations
        $total = Payment::whereHas('user.city.country', function ($query) use ($countryId) {
                    $query->where('id', $countryId);
                })->whereNotNull('booking_id') // Vérifier que le paiement est lié à une réservation
                        ->where('status', 'SUCCESSFUL') // Filtrer les paiements réussis
                        ->sum('amount'); // Calculer la somme des montants

        return $total;
    }

    public static function getTotalBookingPaymentsOther()
    {
        $selectedCountry = session('selected_country', 'benin');

        // Obtenir l'ID du pays via BackHelper
        $countryName = BackHelper::getCountryByName($selectedCountry);
        $countryId = $countryName->id ?? null; // Assurez-vous que $countryName n'est pas null

        // Récupérer le montant total des paiements liés aux réservations
        $total = Payment::whereHas('user.city.country', function ($query) use ($countryId) {
                    $query->where('id', $countryId);
                    })->whereNotNull('booking_id') // Vérifier que le paiement est lié à une réservation
                        ->where('status', '!=', 'SUCCESSFUL') // Filtrer les paiements non réussis
                        ->sum('amount'); // Calculer la somme des montants

        return $total;
    }

    public static function getTotalCompletedBookingPayments()
    {

        $selectedCountry = session('selected_country', 'benin');

        // Obtenir l'ID du pays via BackHelper
        $countryName = BackHelper::getCountryByName($selectedCountry);
        $countryId = $countryName->id ?? null; // Assurez-vous que $countryName n'est pas null
        // Récupérer les IDs des trajets terminés
        $completedRideIds = Ride::whereHas('driver.city.country', function ($query) use ($countryId) {
            $query->where('id', $countryId);
        })->where('status', 'completed')->pluck('id');

        // Récupérer les IDs des réservations associées aux trajets terminés
        $completedBookingIds = Booking::whereHas('ride.driver.city.country', function ($query) use ($countryId) {
            $query->where('id', $countryId);
         })->whereIn('ride_id', $completedRideIds)->pluck('id');

        // Calculer le montant total des paiements réussis pour les réservations terminées
        $total = Payment::whereHas('user.city.country', function ($query) use ($countryId) {
            $query->where('id', $countryId);
            })->whereIn('booking_id', $completedBookingIds) // Filtre par réservations terminées
                        ->where('status', 'SUCCESSFUL') // Filtre les paiements réussis
                        ->sum('amount'); // Calcule la somme des montants

        return $total;
    }

    // public static function getTotalBalence()
    // {
    //    return User::getTotalBalance();
    // }

    public static function getTotalBalence()
{
    // Récupérer le pays sélectionné depuis la session, par défaut 'benin'
    $selectedCountry = session('selected_country', 'benin');

    // Obtenir l'ID du pays via BackHelper
    $countryName = BackHelper::getCountryByName($selectedCountry);
    $countryId = $countryName->id ?? null; // Assurez-vous que $countryName n'est pas null

    $query = User::query();

    // Appliquer le filtre par pays si un ID de pays est disponible
    if ($countryId) {
        $query->whereHas('city.country', function ($q) use ($countryId) {
            $q->where('id', $countryId);
        });
    }

    // Calculer le total du solde
    return $query->sum('balance');
}


    public static function getTotalComision()
    {
       return Commission::sum('amount');
    }

    public static function getTodayRides()
    {
        $today = Carbon::today();

        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $todayRides = Ride::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->whereDate('departure_time', $today)
                                ->orderBy('departure_time', 'desc')
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $todayRides = Ride::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->whereDate('departure_time', $today)
             ->orderBy('departure_time', 'desc')
             ->orderBy('created_at', 'desc')
             ->paginate(10);
        }

        // // Récupère les trajets dont la date de départ est aujourd'hui
        // $todayRides = Ride::whereDate('departure_time', $today)
        //                 ->orderBy('departure_time', 'desc')
        //                 ->orderBy('created_at', 'desc')
        //                 ->paginate(10);

        return $todayRides;
    }

    public static function getTodayRidesTotal()
    {
        $today = Carbon::today();


        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $total = Ride::whereHas('driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->whereDate('departure_time', $today)
                                ->count();
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $total = Ride::whereHas('driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->whereDate('departure_time', $today)
             ->count();
        }
        // Récupère les trajets dont la date de départ est aujourd'hui
        // $total = Ride::whereDate('departure_time', $today)
        //                     ->count();

        return $total;
    }

    public static function getTodayBookings()
    {
        $today = Carbon::today();
        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $todayBookings = Booking::whereHas('ride.driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->whereDate('created_at', $today)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $todayBookings = Booking::whereHas('ride.driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->whereDate('created_at', $today)
             ->orderBy('created_at', 'desc')
             ->paginate(10);
        }
        return $todayBookings;
    }

    public static function getTodayBookingsTotal()
    {
        $today = Carbon::today();

        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $totale = Booking::whereHas('ride.driver.city.country', function ($query) use ($auth_country_id) {
                                    $query->where('id', $auth_country_id);
                                })->whereDate('created_at', $today)
                                ->count();
                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $totale = Booking::whereHas('ride.driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
             })->whereDate('created_at', $today)
             ->count();
        }
        return $totale;
    }

    public static function showLastFiftyUsers()
    {
        $users = User::orderBy('created_at', 'desc')
                    ->take(50)
                    ->paginate(10);

        return $users;
    }

    public static function showLastFiftyUsersTotal()
    {
        $users = User::take(50)
                    ->count();

        return $users;
    }


    public static function getUserNotifications()
    {
        $user = Auth::user();


        return [
            'all' => $user->notifications()->latest()->where('created_at', '>=', Carbon::now()->subHour())
            ->get(),
            'unread' => $user->unreadNotifications()->latest()->get(),
            'count_unread' => $user->unreadNotifications()->count(),
        ];
    }


    public static function countries()
    {
        $countries=Country::where('is_active',true)->get();

        return $countries;
    }


    public static function getCountryByName($countryName)
    {
        // Rechercher le pays par son nom
        return Country::where('name', $countryName)->first();
    }
}
