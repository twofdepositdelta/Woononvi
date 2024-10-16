<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

use App\Models\User; // N'oublie pas d'importer le modèle User
use App\Notifications\CustomResetPassword; // Importer la notification
use Illuminate\Support\Facades\Hash;
class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Récupérer l'utilisateur par e-mail
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => __('Aucun utilisateur trouvé avec cette adresse email.')]);
        }

        // Envoi du lien de réinitialisation avec le token
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            // Générer un token
            $token = Password::getRepository()->create($user);

            // Envoyer la notification
            $user->notify(new CustomResetPassword($token));

            return back()->with('status', __($status));
        }

        return back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
    }
}