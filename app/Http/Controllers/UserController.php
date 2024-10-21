<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Helpers\BackHelper;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Récupérer tous les rôles
        $roles = Role::all();

        // Récupérer tous les utilisateurs ou filtrer par rôle et statut
        $users = User::when($request->role, function ($query) use ($request) {
                return $query->whereHas('roles', function ($query) use ($request) {
                    $query->where('name', $request->role);
                });
            })
            ->when($request->status !== null, function ($query) use ($request) {
                return $query->where('status', $request->status); // 1 pour actif, 0 pour inactif
            })
            ->paginate(20);

        return view('back.pages.users.index', compact('users', 'roles'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'role' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        // Commencez par la requête de base
        $query = User::query();

        // Appliquez le filtre par rôle si un rôle est sélectionné
        if ($request->role) {
            $query->whereHas('roles', function ($query) use ($request) {
                $query->where('name', $request->role);
            });
        }
        // dd($request->status);
        // Appliquez le filtre par statut si un statut est sélectionné
        if ($request->status != null) {
            $query->where('status', $request->status);
        }

        // Récupérer les utilisateurs avec les filtres appliqués
        $users = $query->get();

        // Vérifiez si des utilisateurs ont été trouvés
        if ($users->isEmpty()) {
            return response()->json(['message' => 'Aucun utilisateur trouvé avec ces filtres.'], 404);
        }

        // Retourner la vue partielle avec les utilisateurs
        return response()->json([
            'html' => view('back.pages.users.table', compact('users'))->render(),
        ]);
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
    public function show(User $user)
    {
        $receivedReviewsCount = Review::whereHas('booking.ride', function ($query) use ($user) {
            $query->where('driver_id', $user->id); // Avis reçus en tant que conducteur
        })->orWhereHas('booking', function ($subQuery) use ($user) {
            $subQuery->where('passenger_id', $user->id); // Avis reçus en tant que passager
        })->count();

        $averageRating = $user->averageRatingOutOfFive();

        // Si aucun avis n'a été donné
        if (is_null($averageRating)) {
            $averageRating = 0;
        }

        return view('back.pages.users.show', [
            'receivedReviewsCount' => $receivedReviewsCount,
            'averageRating' => $averageRating,
            'totalTrips' => $user->totalTrips(),
            'totalAmount' => $user->totalAmount(),
            'totalRideRequests' => $user->totalRideRequests(),
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Vérifier s'il a créé des trajets en tant que conducteur
        $hasCreatedRides = $user->rides()->exists();

        // Vérifier s'il a réservé des trajets (en tant que passager)
        $hasBookings = $user->bookings()->exists();

        // Vérifier s'il a des demandes de trajets (RideRequest ou RideMatch)
        $hasRideRequests = $user->ride_requests()->exists();
        $hasRideMatches = $user->ride_matches()->exists();

        // Si l'utilisateur n'a ni créé, ni réservé de trajets, ni fait de demandes
        if (!$hasCreatedRides && !$hasBookings && !$hasRideRequests && !$hasRideMatches) {
            // Supprimer l'utilisateur
            $user->delete();

            // Message de succès
            return redirect()->route('users.index')->with('success', 'L\'utilisateur a été supprimé avec succès.');
        } else {
            // Message d'erreur si l'utilisateur a des trajets ou réservations
            return redirect()->route('users.index')->with('danger', 'Impossible de supprimer l\'utilisateur car il a des trajets et/ou réservations associés.');
        }
    }


    public function updateStatus(User $user)
    {
        // Changer le statut de l'utilisateur
        $user->status = !$user->status;
        $user->save();

        // Redirection avec un message de succès
        return back()->with('success', 'Le statut de l\'utilisateur a été mis à jour.');
    }


    public function checkUsername(Request $request)
    {
        $username = $request->query('username');
        $isUnique = !User::where('username', $username)->exists();

        return response()->json(['isUnique' => $isUnique]);

   }
}