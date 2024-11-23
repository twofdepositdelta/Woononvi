<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }






    public function markAllAsRead()
  {
    auth()->user()->unreadNotifications->markAsRead();

    return response()->json(['message' => 'Toutes les notifications ont été marquées comme lues.']);
  }

  public function markAsRead($id)
{
    $notification = auth()->user()->notifications()->find($id);

    if ($notification && !$notification->read_at) {
        $notification->markAsRead();
        return response()->json(['message' => 'Notification marquée comme lue.'], 200);
    }

    return response()->json(['message' => 'Notification introuvable ou déjà lue.'], 404);
}



}
