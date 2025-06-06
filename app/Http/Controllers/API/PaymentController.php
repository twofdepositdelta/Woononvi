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
                // 'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !',
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

            if ((int) $amount <= 0) {
                return response()->json([
                    'success' => false,
                    'errors' => ['Montant invalide pour créditer le compte.']
                ], 422);
            }

            $apiKey = env('FEEXPAY_API_KEY');
            $shopId = env('FEEXPAY_SHOP_ID');
            $apiUrl = env('FEEXPAY_API_URL', 'https://api.feexpay.me/api');

            $response = Http::withHeaders([
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json'
            ])->post("$apiUrl/transactions/public/requesttopay/{$mode}", [
                'shop' => $shopId,
                'amount' => $amount,
                'phoneNumber' => $phoneNumber,
                'description' => $description,
            ]);

            \Log::info('Réponse FeexPay', [
                'body' => $response->body(),
                'status' => $response->status(),
                'apiKey' => $apiKey,
                'shopId' => $shopId,
                'apiUrl' => $apiUrl
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (!isset($data['reference'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'La transaction n’a pas pu être initiée correctement (référence manquante).',
                        'error' => $data
                    ], 422);

                    \Log::warning('FeexPay - Référence manquante', ['response' => $data]);
                }

                $transactionRef = $data['reference'];
                // $transactionRef = $response->json()['reference']; // Assume the response contains a 'reference'
        
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

                            $user->balance += (int) $amount;
                            $user->update();
        
                            return response()->json([
                                'success' => true,
                                'message' => 'Compte rechargé avec succès !',
                                'user' => $user
                            ]);
                        } elseif ($transactionStatus === 'FAILED') {
                            $user->update();
                            return response()->json([
                                'success' => false,
                                'errors' => ['Transaction échouée !'],
                                'data' => $statusData,
                                'user' => $user
                            ]);
                        }
                    }
                }
        
                // Si aucune réponse positive après 50 essais
                return response()->json([
                    'success' => false,
                    'errors' => ['Échec de la vérification du statut de la transaction. Veuillez réessayer plus tard.']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'errors' => ['Échec de l\'initiation de la transaction'],
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
                'errors' => ['Quelque chose s\'est mal déroulée. Veuillez réessayer svp !']
            ], 500);
        }
    }

    public function checkTransactionStatus($reference)
    {
        $apiKey = env('FEEXPAY_API_KEY');
        $shopId = env('FEEXPAY_SHOP_ID');
        $apiUrl = env('FEEXPAY_API_URL', 'https://api.feexpay.me/api');

        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
        ])->get("$apiUrl/transactions/public/single/status/{$reference}");

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