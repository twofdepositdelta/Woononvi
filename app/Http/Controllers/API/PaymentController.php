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
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        try {
            $user = $request->user();

            // Récupérer les données depuis la requête
            $mode = strtolower($request->input('mode'));
            $phoneNumber = $request->input('phoneNumber');
            $amount = $request->input('amount');
            $description = $request->input('description');

            $response = Http::withHeaders([
                'Authorization' => "Bearer fp_a3MAyKOAMaMVwZPM49r0Szzju5DxEgPu5DwJiWWN1v8nHugYkhfUYTfvfc3SurnL",
                'Content-Type' => 'application/json'
            ])->post("https://api.feexpay.me/api/transactions/public/requesttopay/{$mode}", [
                'shop' => '672dfbc9ff4146187db288cc',
                'amount' => 1,
                'phoneNumber' => $phoneNumber,
                'description' => $description,
            ]);

            if ($response->successful()) {
                $transactionRef = $response->json()['reference']; // Assume the response contains a 'reference'
        
                // Lancer les vérifications du statut de la transaction toutes les 5 secondes
                for ($i = 0; $i < 100; $i++) {
                    sleep(5); // Pause de 5 secondes
                    
                    $statusResponse = $this->checkTransactionStatus($transactionRef);
        
                    if ($statusResponse->successful()) {
                        $statusData = $statusResponse->json();
                        $transactionStatus = $statusData['status']; // Assume the response contains a 'status' field
        
                        if ($transactionStatus === 'SUCCESSFUL') {
                            //Enregistrer la transaction en base de données
                            Payment::create([
                                'user_id' => $request->user()->id,
                                'reference' => $transactionRef,
                                'amount' => $amount,
                                'status' => 'SUCCESSFUL',
                                'payment_number' => $phoneNumber,
                                'payment_type_id' => 1,
                            ]);

                            $user->balance += (int) $request->amount;
                            $user->update();
        
                            return response()->json([
                                'success' => true,
                                'message' => 'Compte rechargé avec succès !',
                                'user' => $user
                            ]);
                        } elseif ($transactionStatus === 'FAILED') {
                            return response()->json([
                                'success' => false,
                                'message' => 'Transaction échouée !',
                                'data' => $statusData
                            ]);
                        }
                    }
                }
        
                // Si aucune réponse positive après 50 essais
                return response()->json([
                    'success' => false,
                    'message' => 'Échec de la vérification du statut de la transaction. Veuillez réessayer plus tard.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Échec de l\'initiation de la transaction',
                    'error' => $response->json()
                ], $response->status());
            }
        } catch(\Exception $e) {
            // Log l'exception pour le suivi interne
            \Log::error('Erreur lors du rechargement du compte', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Retourner une réponse générique à l'utilisateur
            return response()->json([
                'success' => false,
                'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !'
            ], 500);
        }
    }

    public function checkTransactionStatus($reference)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer fp_a3MAyKOAMaMVwZPM49r0Szzju5DxEgPu5DwJiWWN1v8nHugYkhfUYTfvfc3SurnL',
        ])->get("https://api.feexpay.me/api/transactions/public/single/status/{$reference}");

        // Retourner directement la réponse HTTP
        return $response;
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