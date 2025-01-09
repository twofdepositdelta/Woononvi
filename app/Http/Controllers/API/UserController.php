<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Country;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\Auth\AuthenticatedController;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function changeUserRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|in:driver,passenger',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Il y a un souci avec vos données.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $requestedRole = $request->role; // Rôle demandé (driver ou passenger)
        $user = $request->user();

        // Vérification pour le passage en mode driver
        // if ($requestedRole === 'passenger') {
        //     if (empty($user->driving_license_number) && !$user->profile->driver_licence_card) {
        //         return response()->json([
        //             'success' => true,
        //             'message' => 'Veuillez fournir vos informations conducteur.',
        //             'is_driver_set' => false,
        //         ], 200);
        //     }
        // }

        if ($requestedRole === 'passenger') {
            // Récupérer le premier document pour l'utilisateur connecté
            $document = Document::where('user_id', Auth::id())->first();
        
            if (!is_null($document)) {
                // Vérifier si le type de document est nul
                if (is_null($document->type_document_id)) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Veuillez fournir vos informations conducteur.',
                        'is_driver_set' => false,
                    ], 200);
                }
            }
        }

        $role = ($request->role == 'passenger' ? 'driver' : 'passenger');

        // Supprime tous les rôles actuels de l'utilisateur
        $user->syncRoles([]);

        // Attribuer le nouveau rôle
        $roleInstance = Role::findByName($role, 'api');
        $user->assignRole($roleInstance);

        // Créer une instance d'AuthenticatedSessionController pour appeler formatUserArray
        $authController = new AuthenticatedSessionController();
        $userArray = $authController->formatUserArray($user);

        if($role == 'driver')
            $message = "Vous êtes passés en mode conducteur avec succès !";
        else
            $message = "Vous êtes passés en mode passager avec succès !";

        return response()->json([
            'success' => true,
            'message' => $message,
            'is_driver_set' => true,
            'user' => $userArray,
        ]);
    }

    public function becomeDriver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_licence_number' => 'required',
            'driver_licence_file' => 'required|mimes:pdf|max:1024',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Il y a un souci avec vos données.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non authentifié.'
            ], 401);
        }

        $licencePath = null;
        if ($request->hasFile('driver_licence_file')) {
            try {
                $licencePath = $request->file('driver_licence_file')->store("api/users/{$user->id}/documents", 'public');
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue lors de l\'enregistrement du fichier.',
                ], 500);
            }
        }

        try {
            $profile = $user->profile; // Assuming User model has a relationship `profile`
            if (!$profile) {
                $profile = $user->profile()->create([]); // Create profile if it doesn't exist
            }

            $user->update([
                'driving_license_number' => $request->driver_licence_number,
            ]);

            $profile->update([
                //'driver_licence_card' => $licencePath,
                'address' => $request->input('address'),
            ]);

            $number = Str::random(8);
            $document = Document::create([
                'slug' => Str::slug($request->driver_licence_number),
                'number' => $request->driver_licence_number,
                'paper' => driver_licence_file,
                'user_id' => Auth::id(),
                'type_document_id' => 1,
                'expiry_date' => 2025-12-31,
            ]);

            // Assigning the 'driver' role using Laravel Permission
            $user->syncRoles(['driver']);

            // Créer une instance d'AuthenticatedSessionController pour appeler formatUserArray
            $authController = new Auth\AuthenticatedSessionController();
            $userArray = $authController->formatUserArray($user);

            return response()->json([
                'success' => true,
                'user' => $userArray,
                'message' => 'Votre compte a été mis à jour avec succès en tant que conducteur.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour de votre compte.',
            ], 500);
        }
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