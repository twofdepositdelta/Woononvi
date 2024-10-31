<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('dashboard', absolute: false));
    // }

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $user = Auth::user();
        return redirect()->intended(route('dashboard', absolute: false))
                         ->with('success', 'Vous êtes bien connecté en tant que ' . $user->firstname . ' ' . $user->lastname . ' avec le rôle de ' . $user->roles->pluck('name')->first() . '!');
        } catch (ValidationException $e) {
            // Gérer l'erreur de validation si l'utilisateur n'est pas vérifié
            return back()->withErrors(['email' => $e->errors()['email'][0]])->onlyInput();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect(route('login'));
}

}
