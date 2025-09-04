<?php

namespace App\Services;

use Infobip\ApiException;
use Infobip\Model\SmsRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsMessage;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsTextContent;
use Infobip\Configuration;
use RuntimeException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InfoBipSmsService
{
    protected $client;
    protected $from;

    // public function __construct()
    // {
    //     $configuration = new Configuration(
    //         host: config('infobip.base_url'),
    //         apiKey: config('infobip.api_key')
    //     );
        
    //     $this->client = new SmsApi(config: $configuration);
    //     $this->from = config('infobip.from');
    // }

    public function __construct()
    {
        $this->baseUrl = config('infobip.base_url');
        $this->apiKey = config('infobip.api_key');
    }

    public function sendSms(string $recipient, string $message): void
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'App ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post("{$this->baseUrl}/sms/3/messages", [
                'messages' => [
                    [
                        'from' => $this->from,
                        'destinations' => [
                            ['to' => $recipient],
                        ],
                        'content' => [
                            'text' => $message,
                        ],
                    ],
                ],
            ]);

            Log::error('Réponse Infobip brute', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            $responseData = $response->json();

            if (! $response->successful()) {
                throw new RuntimeException($responseData['requestError']['serviceException']['text'] ?? 'Unknown error');
            }

            Log::info('Infobip SMS envoyé', [
                'to' => $recipient,
                'response' => $responseData,
            ]);
        } catch (\Throwable $e) {
            Log::error('Erreur envoi Infobip', [
                'to' => $recipient,
                'message' => $message,
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Échec de l’envoi du message via Infobip.");
        }
    }

    // public function sendSms($to, $message)
    // {
    //     try {
    //         // $destination = new SmsDestination(
    //         //     to: $to
    //         // );

    //         // $smsMessage = new SmsTextualMessage(
    //         //     destinations: [$destination],
    //         //     from: $this->from,
    //         //     text: $message
    //         // );

    //         // $request = new SmsAdvancedTextualRequest(
    //         //     messages: [$smsMessage]
    //         // );

    //         $message = new SmsMessage(
    //             destinations: [
    //                 new SmsDestination(
    //                     to: $to
    //                 )
    //             ],
    //             content: new SmsTextContent(
    //                 text: $message
    //             ),
    //             sender: 'Woononvi'
    //         );

    //         $request = new SmsRequest(messages: [$message]);

    //         $response = $this->client->sendSmsMessages($request);
            
    //         // Journal de succès (optionnel)
    //         \Log::info('SMS envoyé avec succès', [
    //             'to' => $to,
    //             'messageId' => $response->getMessages()[0]->getMessageId() ?? 'Unknown'
    //         ]);
            
    //         return $response;
    //     } catch (\Exception $e) {
    //         // Journal d'erreur
    //         \Log::error('Erreur lors de l\'envoi du SMS via Infobip', [
    //             'to' => $to,
    //             'message' => $message,
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString()
    //         ]);
            
    //         throw $e; // Relance l'exception pour permettre au code appelant de la gérer
    //     }
    // }
}