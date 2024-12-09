<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function changeUserRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Il y a un souci avec vos données.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $role = ($request->role == 'passenger' ? 'driver' : 'passenger');

        $user = $request->user();

        // Supprime tous les rôles actuels de l'utilisateur
        $user->syncRoles([]);

        $roleGet = Role::findByName($role, 'api');
        $user->assignRole($roleGet);

        // Créer une instance d'AuthenticatedSessionController pour appeler formatUserArray
        $authController = new Auth\AuthenticatedSessionController();
        $userArray = $authController->formatUserArray($user);

        if($role == 'driver')
            $message = "Vous êtes passés en mode conducteur avec succès !";
        else
            $message = "Vous êtes passés en mode passager avec succès !";

        return response()->json([
            'success' => true,
            'message' => $message,
            'user' => $userArray,
        ]);
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
        //
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
    public function update(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
}