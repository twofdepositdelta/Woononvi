<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log; // Ajoutez ceci
use App\Helpers\BackHelper;
use App\Models\Country;
use App\Models\User;
use App\Models\UserNotificationSetting;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $countries = Country::where('is_active', true)->get();
        $notificationSettings = UserNotificationSetting::where('user_id', Auth::id())->get();
        return view('profile.edit', [
            'user' => $request->user(),
            'countries' => $countries,
            'notificationSettings' => $notificationSettings,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user  = Auth::user();

        // Mise à jour des informations utilisateur
        $user->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => str_replace(' ', '', $request->input('username')),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'date_of_birth' => $request->input('date_of_birth'),
        ]);

        // Mise à jour du profil
        $user->profile->update([
            'address' => $request->input('address'),
            'bio' => $request->input('bio'),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profil mis à jour avec succès.');
    }


    public function updateAvatar(Request $request)
    {

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validez les fichiers d'image
        ]);

        $user = Auth::user();

        // Gérer le fichier uploadé
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = 'user' . $user->id . '.' . $image->getClientOriginalExtension();
            $imagePath = BackHelper::getEnvFolder() . 'storage/back/assets/images/users/' . $imageName;

            // Enregistrez l'image dans le répertoire souhaité
            $image->move(public_path('storage/back/assets/images/users/'), $imageName);

            // Mettez à jour le chemin de l'avatar dans le profil de l'utilisateur
            $user->profile->avatar = 'storage/back/assets/images/users/' . $imageName; // Mettez à jour le champ dans la base de données
            $user->profile->save();

            return response()->json(['success' => true, 'avatar' => asset($user->profile->avatar)]);
        }

        return response()->json(['success' => false, 'message' => 'Erreur lors de la mise à jour de l\'avatar.'], 400);
    }


    public function updateNotificationSettings(Request $request)
    {
        $user = auth()->user(); // Utilisateur connecté

        // Récupérer tous les paramètres de notification de l'utilisateur
        $notificationSettings = UserNotificationSetting::where('user_id', $user->id)->get();

        foreach ($notificationSettings as $setting) {
            // Vérifie si la notification est activée ou désactivée
            UserNotificationSetting::where('user_id', $user->id)
                ->where('notification_type', $setting->notification_type)
                ->update(['is_enabled' => $request->has($setting->notification_type)]);
        }

        return back()->with('success', 'Vos paramètres de notification ont été mis à jour.');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);


       $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
