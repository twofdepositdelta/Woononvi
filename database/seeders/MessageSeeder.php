<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Str;

class MessageSeeder extends Seeder
{
    public function run()
    {
        // // Récupérer toutes les conversations
        // $conversations = Conversation::all();

        // foreach ($conversations as $conversation) {
        //     // Récupérer le passager et le support associés à cette conversation
        //     $passenger = User::find($conversation->user_id);
        //     $support = User::find($conversation->support_id);

        //     // Créer plusieurs messages pour chaque conversation
        //     for ($i = 0; $i < 5; $i++) { // Exemple avec 5 messages
        //         // Alternance de l'expéditeur entre le passager et le support
        //         $sender = ($i % 2 == 0) ? $passenger : $support;

        //         Message::create([
        //             'conversation_id' => $conversation->id,
        //             'sender_id' => $sender->id,
        //             'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s
        //                     standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        //             'is_read' => $i % 2 == 0, // Un message sur deux sera marqué comme lu
        //         ]);
        //     }
        // }
    }
}
