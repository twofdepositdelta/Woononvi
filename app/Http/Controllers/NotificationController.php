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
      $notifications = auth()->user()->notifications()->latest()->paginate(15);

      return view('back.pages.notifications.index', compact('notifications'));
    }

    public function markAllAsRead(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            $user->unreadNotifications->markAsRead();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'unauthorized'], 401);
    }


    public function markAsRead(Request $request,$id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification && is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return back()->with('success', 'Notification bien marquée comme lue');
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





    
}
