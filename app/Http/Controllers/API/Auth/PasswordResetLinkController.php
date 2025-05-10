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
                // 'message' => 'Quelque chose s\'est mal déroulée.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $email = $request->email;

        // Génération de l'OTP
        $otp = rand(1000, 9999);

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
    
        $user->sendOTPNotification($otp);

        return response()->json([
            'success' => true,
            'message' => 'Un code OTP a été envoyé à votre adresse e-mail.',
        ]);
    }

    public function resendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $email = $request->email;

        // Génération de l'OTP
        $otp = rand(1000, 9999);

        // Stockage de l'OTP dans la table `password_resets`
        DB::table('user_confirmations')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp,
                'expired_at' => Carbon::now()->addMinutes(30),
                'created_at' => Carbon::now(),
            ]
        );

        $user = User::whereEmail($email)->first();
    
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
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->where('expired_at', '>=', Carbon::now())
            ->first();

        if (!$record) {
            return response()->json([
                'success' => false,
                'errors' => ['Le code OTP est invalide ou a expiré.'],
            ], 422);
        }

        $user = User::whereEmail($request->email)->first();
        $user->password = Hash::make($request->new_password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mot de passe réinitialisé avec succès.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
}