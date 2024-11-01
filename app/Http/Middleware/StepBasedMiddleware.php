<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class StepBasedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->input('step') == 2) {
            // Si step est 2, vérifiez que l'utilisateur est authentifié
            if (!Auth::guard('api')->check()) {
                return response()->json(['message' => 'Non autorisé'], 401);
            }
        }

        return $next($request);
    }
}
