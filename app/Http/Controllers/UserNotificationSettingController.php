<?php

namespace App\Http\Controllers;

use App\Models\UserNotificationSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationSettingController extends Controller
{
    public function index()
    {
        $settings = UserNotificationSetting::where('user_id', Auth::id())->get();
        return view('user.notifications.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'notification_type' => 'required|string',
            'is_enabled' => 'required|boolean',
            'frequency' => 'required|in:immediate,daily,weekly,never',
        ]);

        $setting = UserNotificationSetting::updateOrCreate(
            ['user_id' => Auth::id(), 'notification_type' => $validated['notification_type']],
            [
                'is_enabled' => $validated['is_enabled'],
                'frequency' => $validated['frequency'],
            ]
        );

        return redirect()->back()->with('success', 'Paramètres de notification mis à jour avec succès.');
    }
}