<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $commissions=Commission::all();
        $totalcommission=$commissions->sum('amount');

            foreach ($commissions as $commission) {
                $commission_rides=$commission->ride->where('status','pending')->get();
                $commission_ridesactives=$commission->ride->where('status','active')->get();
                foreach ($commission_rides as $commission_ride) {
                    $commission_pending=Commission::where('ride_id',$commission_ride->id)->get();
                    # code...
                }

                foreach ($commission_ridesactives as $commission_ridesactif) {
                    $commission_actif=Commission::where('ride_id',$commission_ridesactif->id)->get();
                    # code...
                }

            }
            # code...


        $totalpendingcomiss=$commission_pending->sum('amount');
        $totalactifcomiss=$commission_actif->sum('amount');


        return view('back.pages.commission.index',compact('totalcommission','totalpendingcomiss','totalactifcomiss'));
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
    public function show(Commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commission $commission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commission $commission)
    {
        //
    }


    public function getCommissionReport(Request $request)
{
    $period = $request->get('period');
    $query = Commission::query();

    switch ($period) {
        case 'yearly':
            $data = $query->selectRaw('YEAR(created_at) as label, SUM(amount) as total')
                          ->groupBy('label')
                          ->get();
            break;
        case 'monthly':
            $data = $query->selectRaw('MONTH(created_at) as label, SUM(amount) as total')
                          ->groupBy('label')
                          ->get();
            break;
        case 'weekly':
            $data = $query->selectRaw('WEEK(created_at) as label, SUM(amount) as total')
                          ->groupBy('label')
                          ->get();
            break;
            case 'today':
                // Commission totale pour aujourd'hui
                $data = $query->whereDate('created_at', today())
                              ->selectRaw('SUM(amount) as total') // Somme des commissions du jour
                              ->get(); // Utiliser `first` car il n'y a qu'une seule ligne
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
        // Pour les autres périodes, tu peux utiliser directement les labels (ex : années ou semaines)
        $labels = $data->pluck('label')->toArray();
    }

    $amounts = $data->pluck('total')->toArray();
    $total = array_sum($amounts);

    return response()->json([
        'labels' => $labels,
        'amounts' => $amounts,
        'total' => $total
    ]);
}

}
