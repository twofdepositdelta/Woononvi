<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Mail\UpdateStatusMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        //
        $transactions=Transaction::orderBy('created_at','desc')->paginate(10);
        return view('back.pages.transactions.index',compact('transactions'));
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
    public function show(Transaction $transaction)
    {
        //
        return view('back.pages.transactions.show',compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function historique()
    {
        //
        $user=Auth::user();

        $transactions=Transaction::where('driver_id',$user->id)->paginate(10);

        return view('back.pages.transactions.historique',compact('transactions'));
    }

    public function updatestatus(Transaction $transaction, $status)
{
    // Vérifier si le statut est valide
    if (!($status=='refunded')) {
        return redirect()->back()->with('error', 'Statut invalide.');
    }
    // Mettre à jour le statut
    $transaction->status = $status;
    $transaction->save();

     Mail::to($transaction->passenger->email)->send(new UpdateStatusMail($transaction));
    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'Le transaction a été mis à jour.');
}

}
