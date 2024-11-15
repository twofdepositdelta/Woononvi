<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        public function index()
        {
            $payments = Payment::orderBy('created_at', 'desc')->paginate(10);
            return view('back.pages.paiements.index', compact('payments'));
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
        $payment=Payment::where('reference',$reference)->first();
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

}
