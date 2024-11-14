<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function rechargeBalance(Request $request)
    {
        $rules = [
            'mode' => 'required|max:255|string',
            'phoneNumber' => 'required|max:255|string',
            'amount' => 'required|integer',
            'shop' => 'required|max:255|string',
            'fToken' => 'required|max:255|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        // Récupérer les données depuis la requête
        $mode = strtolower($request->input('mode'));
        $token = $request->input('fToken');
        $phoneNumber = $request->input('phoneNumber');
        $amount = $request->input('amount');
        $shop = $request->input('shop');
        $description = $request->input('description');

        $response = Http::withHeaders([
            'Authorization' => "Bearer $token",
            'Content-Type' => 'application/json'
        ])->post("https://api.feexpay.me/api/transactions/public/requesttopay/{$mode}", [
            'shop' => $shop,
            'amount' => 1,
            'phoneNumber' => $phoneNumber,
            'description' => $description,
        ]);

        // Vérifier la réponse de l'API
        if ($response->successful()) {
            return response()->json([
                'message' => 'Compte recharger avec succès !',
                'data' => $response->json()
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to initiate transaction',
                'error' => $response->json()
            ], $response->status());
        }

        return response()->json([
            'success' => true,
            'vehicle' => $vehicle,
            'message' => 'Document ajouté avec succès !',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
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
    public function destroy(Request $request)
    {
        
    }
}