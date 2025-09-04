<?php

namespace App\Http\Controllers;

use App\Services\InfoBipSmsService;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    protected $smsService;

    public function __construct(InfoBipSmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            $response = $this->smsService->sendSms(
                $request->phone,
                $request->message
            );
            
            return response()->json([
                'success' => true,
                'message' => 'SMS envoyé avec succès',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi du SMS: ' . $e->getMessage()
            ], 500);
        }
    }
}