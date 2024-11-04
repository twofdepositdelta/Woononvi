<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
USE Carbon\Carbon;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Quelque chose s\'est mal déroulée.',
                'errors' => $validator->errors()
            ], 422);
        }

        $email = $request->email;

        // Génération de l'OTP
        $otp = Str::random(4);

        // Stockage de l'OTP dans la table `password_resets`
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp,
                'expired_at' => Carbon::now()->addMinutes(30),
                'created_at' => Carbon::now(),
            ]
        );

        $user = User::whereEmail($email)->first();
    
        // Envoyer la notification de confirmation
        $user->sendOTPNotification($otp);

        return response()->json([
            'success' => true,
            'message' => 'Un code OTP a été envoyé à votre adresse e-mail.',
        ]);
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
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $user = $request->user();
    
        // Vérification du mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Le mot de passe actuel est incorrect.',
            ], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Votre mot de passe a été modifié avec succès.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
}