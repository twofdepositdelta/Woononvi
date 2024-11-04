<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Arr;

class ConversationSeeder extends Seeder
{
    public function run()
    {
        // Récupérer quelques utilisateurs avec le rôle de 'passenger' et de 'support'
        $passengers = User::role('passenger')->take(5)->get(); // Par exemple, 5 passagers
        $supports = User::role('support')->take(3)->get(); // 3 supports

        // Créer des conversations
        foreach ($passengers as $passenger) {
            foreach ($supports as $support) {
                Conversation::create([
                    'user_id' => $passenger->id,
                    'support_id' => $support->id,
                    'status' => ['open', 'resolved', 'closed'][array_rand(['open', 'resolved', 'closed'])],
                    'status' => Arr::random(['open', 'resolved', 'closed'])
                ]);
            }
        }
    }
}
