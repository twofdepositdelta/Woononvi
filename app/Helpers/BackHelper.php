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
        $total = User::role('passenger')->count();

        return $total;
    }

    public static function getDriversTotal()
    {
        $total = User::role('driver')->count();

        return $total;
    }

    // 2 . Trajet

    public static function getRidesTotal()
    {
        return Ride::count();
    }

    public static function getRidesActive()
    {
        $now = Carbon::now();  // Récupérer la date et l'heure actuelles

        // Récupérer les trajets créés aujourd'hui
        $rides = Ride::where('status', 'active')->get();

        // Compter les trajets
        $total = $rides->count();

        return $total;
    }

    public static function getBooking()
    {
        $total = Booking::count();

        return $total;
    }

    public static function getBookingPending()
    {
        $total = Booking::where('status', 'pending')->count();

        return $total;
    }

    public static function getRideRequest()
    {
        $total = RideRequest::count();

        return $total;
    }

    public static function getRideNotResponse()
    {
        $total = RideRequest::where('status', '!=', 'responded')->count();

        return $total;
    }

    public static function getTotalBookingPayments()
    {
        // Récupérer le montant total des paiements liés aux réservations
        $total = Payment::whereNotNull('booking_id') // Vérifier que le paiement est lié à une réservation
                        ->where('status', 'SUCCESSFUL') // Filtrer les paiements réussis
                        ->sum('amount'); // Calculer la somme des montants

        return $total;
    }

    public static function getTotalBookingPaymentsOther()
    {
        // Récupérer le montant total des paiements liés aux réservations
        $total = Payment::whereNotNull('booking_id') // Vérifier que le paiement est lié à une réservation
                        ->where('status', '!=', 'SUCCESSFUL') // Filtrer les paiements non réussis
                        ->sum('amount'); // Calculer la somme des montants

        return $total;
    }

    public static function getTotalCompletedBookingPayments()
    {
        // Récupérer les IDs des trajets terminés
        $completedRideIds = Ride::where('status', 'completed')->pluck('id');

        // Récupérer les IDs des réservations associées aux trajets terminés
        $completedBookingIds = Booking::whereIn('ride_id', $completedRideIds)->pluck('id');

        // Calculer le montant total des paiements réussis pour les réservations terminées
        $total = Payment::whereIn('booking_id', $completedBookingIds) // Filtre par réservations terminées
                        ->where('status', 'SUCCESSFUL') // Filtre les paiements réussis
                        ->sum('amount'); // Calcule la somme des montants

        return $total;
    }

    public static function getTotalBalence()
    {
       return User::getTotalBalance();
    }

    public static function getTotalComision()
    {
       return Commission::sum('amount');
    }

    public static function getTodayRides()
    {
        $today = Carbon::today();

        // Récupère les trajets dont la date de départ est aujourd'hui
        $todayRides = Ride::whereDate('departure_time', $today)
                        ->orderBy('departure_time', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return $todayRides;
    }

    public static function getTodayRidesTotal()
    {
        $today = Carbon::today();

        // Récupère les trajets dont la date de départ est aujourd'hui
        $total = Ride::whereDate('departure_time', $today)
                            ->count();

        return $total;
    }

    public static function getTodayBookings()
    {
        $today = Carbon::today();

        return Booking::whereDate('created_at', $today)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); // Pagination si nécessaire
    }

    public static function getTodayBookingsTotal()
    {
        $today = Carbon::today();

        return Booking::whereDate('created_at', $today)
                    ->count();
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


    public static function getNotifications()
    {
        $user = Auth::user();

        if (!$user) {
            return [
                'notifications' => [],
                'unread_count' => 0,
            ];
        }

        return [
            'notifications' => $user->notifications()->orderBy('created_at', 'desc')->get(),
            'unread_count' => $user->unreadNotifications()->count(),
        ];
    }
}
