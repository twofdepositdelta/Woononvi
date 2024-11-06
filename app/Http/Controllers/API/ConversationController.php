<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ConversationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Récupère l'utilisateur avec ses conversations

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé !'], 404);
        }

        // Recherche de la conversation non clôturée
        $conversation = Conversation::whereUserId($user->id)
                        ->where('status', '!=', 'closed')
                        ->first();

        if (!$conversation) {
            return response()->json(['message' => "Il n'y a pas de conversation ouverte !"], 404);
        }

        // Récupère les messages de la conversation où le sender_id correspond à user_id
        $messages = $conversation->messages()->where('sender_id', $user->id)->get();

        $mappedMessages = $messages->map(function ($message) {
            return [
                'id' => $message->id,
                'text' => $message->content ? $message->content : null, // Utilise 'content' pour le message
                'createdAt' => $message->created_at,
                'messageImage' => $message->file_path ? asset('storage/' . $message->file_path) : null,
                'isSender' => Auth::id() == $message->sender_id ? 'right' : 'left',
                'image' => $message->sender->profile->avatar, // Assurez-vous que 'sender' est bien défini dans votre relation
                'senderId' => $message->sender_id, // Utilisation du sender_id
            ];
        });
    
        return response()->json(['messages' => $mappedMessages], 200);

        // if($messages) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Aucun message trouvé !',
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'success' => true,
        //         'messages' => $messages,
        //     ], 200);
        // }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $existingConversation = Conversation::whereUserId($user->id)
            ->where('status', '!=', 'closed')
            ->first();

        if ($existingConversation) {
            // Ajouter le message à la conversation en cours
            $message = Message::create([
                'conversation_id' => $existingConversation->id,
                'sender_id' => $user->id,
                'content' => $request->message,
                'status' => 'sent',
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Message ajouté à la conversation en cours.',
            ]);
        } else {
            // Assigner un support
            $support = $this->assignSupportToConversation();
    
            if (!$support) {
                // Si aucun support disponible, annuler la création de la conversation
                // $conversation->delete();
                return response()->json([
                    'success' => false,
                    'message' => 'Aucun support disponible actuellement.'
                ], 400);
            }

            $conversation = Conversation::create([
                'user_id' => $user->id,
                'support_id' => $support->id,
                'status' => 'open',
            ]);

            // Ajouter le message initial
            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $user->id,
                'content' => $request->message,
                'status' => 'sent',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Conversation commencée avec le support assigné.',
            ]);
        }
    }

    private function assignSupportToConversation() {
        // Récupérer les supports actifs avec leur nombre de conversations non clôturées
        $activeSupports = User::where('status', true)
                            ->whereHas('roles', function ($query) {
                                $query->where('name', 'support');
                            })->with('roles')->withCount(['conversations as open_conversations_count' => function ($query) {
                                $query->where('status', '!=', 'closed');
                            }])
                            ->orderBy('open_conversations_count')
                            ->get();
    
        // Si aucun support actif disponible
        if ($activeSupports->isEmpty()) {
            return null;
        }
    
        // Filtrer pour prendre uniquement ceux avec le nombre minimal de conversations non clôturées
        $minConversationsCount = $activeSupports->first()->open_conversations_count;
        $availableSupports = $activeSupports->filter(function ($support) use ($minConversationsCount) {
            return $support->open_conversations_count == $minConversationsCount;
        });
    
        // Choisir un support aléatoirement parmi ceux ayant le nombre minimum de conversations
        $selectedSupport = $availableSupports->random();
    
        return $selectedSupport;
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
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
}