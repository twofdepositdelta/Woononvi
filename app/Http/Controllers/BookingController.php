<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ride;
use App\Models\Booking;
use App\Helpers\BackHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
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
                    // Récupérer les reservations où le conducteur appartient au même pays
                    $bookings=Booking::whereHas('ride.driver.city.country', function ($query) use ($auth_country_id) {
                        $query->where('id', $auth_country_id);
                     })->orderBy('created_at', 'desc')
                      ->paginate(10);
                }

        }else{
            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $auth_country_id =$countryName->id;

            $bookings=Booking::whereHas('ride.driver.city.country', function ($query) use ($auth_country_id) {
                $query->where('id', $auth_country_id);
             })->orderBy('created_at', 'desc')
              ->paginate(10);

        }


        return view('back.pages.reservations.index',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $rides=Ride::orderBy('created_at','desc')->paginate(10);
        return view('back.pages.reservations.create',compact('rides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          // Validation des données
          $request->validate([
            'seats_reserved' => 'required|integer|min:1|max:10', // Assurez-vous que le nombre de places réservées est entre 1 et 4
            'ride_id' => 'required|exists:rides,id', // Assurez-vous que le trajet existe
            'total_price' => 'required|integer|min:1000', // Assurez-vous que le prix total est un entier positif
        ]);

        // Création de la réservation
        Booking::create([
            'seats_reserved' => $request->seats_reserved,
            'total_price' => $request->total_price,
            'ride_id' => $request->ride_id,
            'passenger_id' => Auth::id(), // Utilisateur connecté comme passager
        ]);

        // Redirection vers la liste des réservations avec un message de succès
        return redirect()->route('bookings.index')->with('success', 'Réservation créée avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show( $booking_number)
    {
        //
        $booking=Booking::where('booking_number',$booking_number)->firstOrFail();
        return view('back.pages.reservations.show',compact('booking'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function historique()
    {
        //
        $user=Auth::user();

        $bookings=Booking::where('passenger_id',$user->id)->paginate(10);

        return view('back.pages.reservations.historique',compact('bookings'));
    }


    public function updatestatus(Booking $booking, $status)
    {
        if (auth()->user()->hasAnyRole(['super admin', 'manager' ,'dev'])) {

            // Vérifier si le statut est valide
            if (!($status=='refunded')) {
                return redirect()->back()->with('error', 'Statut invalide.');
            }
            // Mettre à jour le statut
            $booking->status = $status;
            $booking->save();

            //  Mail::to($booking->passenger->email)->send(new UpdateStatusMail($booking));
            // Rediriger avec un message de succès
            return redirect()->back()->with('success', 'La reservation a été mis à jour.');
        }
        else
        {
            abort(401);
        }

    }

     public function statistique()
    {
        //
        $bookingcount = 0;
        $bookingcountrefunded = 0;
        $bookingcountpending = 0;

        if (auth()->user()->hasAnyRole(['super admin', 'dev'])) {

            $selectedCountry = session('selected_country', 'benin');

            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid = $countryName->id;

            $bookingcount = Booking::whereHas('ride.driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->count();

            $bookingcountrefunded = Booking::whereHas('ride.driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->where('status', 'refunded')->count();

            $bookingcountpending = Booking::whereHas('ride.driver.city.country', function ($query) use ($countryid) {
                $query->where('id', $countryid);
            })->where('status', 'pending')->count();

        } else {
            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null;

            if ($auth_country_id) {
                $bookingcount = Booking::whereHas('ride.driver.city.country', function ($query) use ($auth_country_id) {
                    $query->where('id', $auth_country_id);
                })->count();

                $bookingcountrefunded = Booking::whereHas('ride.driver.city.country', function ($query) use ($auth_country_id) {
                    $query->where('id', $auth_country_id);
                })->where('status', 'refunded')->count();

                $bookingcountpending = Booking::whereHas('ride.driver.city.country', function ($query) use ($auth_country_id) {
                    $query->where('id', $auth_country_id);
                })->where('status', 'pending')->count();
            }
        }

        return view('back.pages.rapports.reservation.statistique', compact(
            'bookingcount',
            'bookingcountrefunded',
            'bookingcountpending'
        ));





    }

    public function getBookingsReport(Request $request)
    {
        $period = $request->get('period');


        if (auth()->user()->hasAnyRole(['super admin', 'dev'])) {
            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné
        // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $query = Booking::query();

            if ($countryid) {
                $query->whereHas('ride.driver.city.country', function ($q) use ($countryid) {
                    $q->where('id', $countryid);
                 });
            }

        }else {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null;

            $query = Booking::query();

            if ($auth_country_id) {
                $query->whereHas('ride.driver.city.country', function ($q) use ($auth_country_id) {
                    $q->where('id', $auth_country_id);
                 });
            }



        }


        switch ($period) {
            case 'weekly':
                // Définir les 4 dernières semaines
                $startDate = Carbon::now()->subWeeks(4)->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();

                // Réservations des 4 dernières semaines
                $data = $query->whereBetween('created_at', [$startDate, $endDate])
                              ->selectRaw('WEEK(created_at) as label, COUNT(id) as total')
                              ->groupBy('label')
                              ->orderBy('label', 'asc')
                              ->get();

                // Générer les labels "Semaine X"
                $labels = $data->pluck('label')->map(function ($weekNumber) {
                    return 'Semaine ' . $weekNumber;
                })->toArray();
                break;

            case 'monthly':
                // Réservations par mois
                $data = $query->selectRaw('MONTH(created_at) as label, COUNT(id) as total')
                              ->groupBy('label')
                              ->get();

                $labels = $data->pluck('label')->map(function ($month) {
                    $monthNames = [
                        1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
                        5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
                        9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
                    ];
                    return $monthNames[$month];
                })->toArray();
                break;

            case 'yearly':
                // Réservations par année
                $data = $query->selectRaw('YEAR(created_at) as label, COUNT(id) as total')
                              ->groupBy('label')
                              ->get();

                $labels = $data->pluck('label')->toArray();
                break;

            case 'today':
                // Réservations pour aujourd'hui
                $data = $query->whereDate('created_at', today())
                              ->selectRaw('COUNT(id) as total')
                              ->get();

                $labels = ['Aujourd\'hui'];
                break;

            default:
                $data = [];
                $labels = [];
        }

        $amounts = $data->pluck('total')->toArray();
        $total = array_sum($amounts);
        return response()->json([
            'labels' => $labels,
            'amounts' => $amounts,
            'total'=>$total

        ]);
    }

    public function getCommissionReport(Request $request)
    {
        $period = $request->get('period');

        if (auth()->user()->hasAnyRole(['super admin', 'dev'])) {
            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné
        // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $query=Booking::query();

            if ($countryid) {
               $query->whereHas('ride.driver.city.country', function ($q) use ($countryid) {
                   $q->where('id', $countryid);
                });
            }

        }else {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null;

            $query=Booking::query();

            if ($auth_country_id) {
               $query->whereHas('ride.driver.city.country', function ($q) use ($auth_country_id) {
                   $q->where('id', $auth_country_id);
                });
            }



        }

        switch ($period) {
            case 'yearly':
                $data = $query->selectRaw('YEAR(created_at) as label, SUM(total_price * (commission_rate / 100)) as total')
                               ->where('status','accepted')
                              ->groupBy('label')
                              ->get();
                break;
            case 'monthly':
                $data = $query->selectRaw('MONTH(created_at) as label, SUM(total_price * (commission_rate / 100)) as total')
                                ->where('status','accepted')
                                ->groupBy('label')
                                ->get();
                break;
            case 'weekly':
                $data = $query->selectRaw('WEEK(created_at) as label, SUM(total_price * (commission_rate / 100)) as total')
                            ->where('status','accepted')
                            ->groupBy('label')
                            ->get();
                break;
        }

        if ($period === 'monthly') {
            $monthNames = [
                1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin',
                7 => 'Juillet', 8 => 'Août', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
            ];

            // Remplacer les numéros de mois par les noms des mois
            $labels = $data->pluck('label')->map(function ($month) use ($monthNames) {
                return $monthNames[$month];
            })->toArray();
        } else {
            // Pour les autres périodes, utiliser directement les labels (ex : années ou semaines)
            $labels = $data->pluck('label')->toArray();
        }

        $amounts = $data->pluck('total')->toArray();
        $total = array_sum($amounts);

        return response()->json([
            'labels' => $labels,
            'amounts' => $amounts,
            'total' => round($total, 2)
        ]);
    }

    public function filter(Request $request)
    {
        $query = Booking::with(['ride', 'passenger']);

        if (auth()->user()->hasRole(['support','manager'])) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null;

            if ($request->numero_ride) {
                $query->where('booking_number', 'like', '%' . $request->numero_ride . '%');
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            $query->whereHas('ride.driver.city.country', function ($q) use ($auth_country_id) {
                $q->where('id', $auth_country_id);
            });

            $bookings = $query->orderByDesc('created_at')->paginate(10);
        }else {
            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $country_id =$countryName->id;


            if ($request->numero_ride) {
                $query->where('booking_number', 'like', '%' . $request->numero_ride . '%');
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            $query->whereHas('ride.driver.city.country', function ($q) use ($country_id) {
                $q->where('id', $country_id);
            });

            $bookings = $query->orderByDesc('created_at')->paginate(10);


        }



            return view('back.pages.reservations.table', compact('bookings'))->render();

    }

}



