<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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

        // Préparer les données pour la requête
        $data = [
            'token' => $token,
            'phoneNumber' => $phoneNumber,
            'amount' => 1,
            'shop' => $shop,
            'description' => $description,
        ];

        // Construire l'URL avec le mode
        $url = "https://api.feexpay.me/api/transactions/public/requesttopay/{$mode}";

        // Envoyer la requête POST avec les données
        $response = Http::post($url, $data);

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