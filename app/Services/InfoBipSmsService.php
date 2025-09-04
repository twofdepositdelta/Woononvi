<?php

namespace App\Services;

use Infobip\ApiException;
use Infobip\Model\SmsRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsMessage;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsTextContent;
use Infobip\Configuration;

class InfoBipSmsService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $configuration = new Configuration(
            host: config('infobip.base_url'),
            apiKey: config('infobip.api_key')
        );
        
        $this->client = new SmsApi(config: $configuration);
        $this->from = config('infobip.from');
    }

    public function sendSms($to, $message)
    {
        try {
            // $destination = new SmsDestination(
            //     to: $to
            // );

            // $smsMessage = new SmsTextualMessage(
            //     destinations: [$destination],
            //     from: $this->from,
            //     text: $message
            // );

            // $request = new SmsAdvancedTextualRequest(
            //     messages: [$smsMessage]
            // );

            $message = new SmsMessage(
                destinations: [
                    new SmsDestination(
                        to: $to
                    )
                ],
                content: new SmsTextContent(
                    text: $message
                ),
                sender: 'Woononvi'
            );

            $request = new SmsRequest(messages: [$message]);

            $response = $this->client->sendSmsMessages($request);
            
            // Journal de succès (optionnel)
            \Log::info('SMS envoyé avec succès', [
                'to' => $to,
                'messageId' => $response->getMessages()[0]->getMessageId() ?? 'Unknown'
            ]);
            
            return $response;
        } catch (\Exception $e) {
            // Journal d'erreur
            \Log::error('Erreur lors de l\'envoi du SMS via Infobip', [
                'to' => $to,
                'message' => $message,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e; // Relance l'exception pour permettre au code appelant de la gérer
        }
    }
}