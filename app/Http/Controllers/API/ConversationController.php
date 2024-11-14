<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Events\MessageSent;

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
            return response()->json(['success' => false , 'message' => 'Utilisateur non trouvé !'], 404);
        }

        // Recherche de la conversation non clôturée
        $conversation = Conversation::whereUserId($user->id)
                        ->where('status', '!=', 'closed')
                        ->first();

        if (!$conversation) {
            return response()->json(['success' => false , 'message' => "Il n'y a pas de conversation ouverte !"], 404);
        }

        // Récupère les messages de la conversation où le sender_id correspond à user_id
        $messages = $conversation->messages()->orderBy('id', 'desc')->get();

        $mappedMessages = $messages->map(function ($message) {
            $createdAt = Carbon::parse($message->created_at);

            // Calcul de la durée et formatage
            if ($createdAt->diffInMinutes() < 60) {
                $timeAgo = intval($createdAt->diffInMinutes()) . ' minute' . (intval($createdAt->diffInMinutes()) > 1 ? 's' : '');
            } elseif ($createdAt->diffInHours() < 24) {
                $timeAgo = intval($createdAt->diffInHours()) . ' heure' . (intval($createdAt->diffInHours()) > 1 ? 's' : '');
            } else {
                $timeAgo = intval($createdAt->diffInDays()) . ' jour' . (intval($createdAt->diffInDays()) > 1 ? 's' : '');
            }

            return [
                'id' => $message->id,
                'text' => $message->content ? $message->content : null, 
                'createdAt' => 'Il y a ' . $timeAgo,
                'createdAtTrue' => $message->created_at,
                'messageImage' => $message->file_path ? url('storage/' . $message->file_path) : null,
                'isSender' => Auth::id() == $message->sender_id ? true : false,
                'image' => $message->sender->profile ? url($message->sender->profile->avatar) : null,
                'senderId' => $message->sender_id,
            ];
        });
    
        return response()->json(['success' => true ,'messages' => $mappedMessages], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'message' => 'nullable|string',
        ];
        
        if ($request->hasFile('image')) {
            $rules['image'] = 'mimes:jpeg,png,jpg,gif|max:1024';
        }
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez fournir un message ou une image.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $existingConversation = Conversation::whereUserId($user->id)
            ->where('status', '!=', 'closed')
            ->first();

        $filePath = null;
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('messages', 'public'); // Save to 'storage/app/public/messages'
        }

        if ($existingConversation) {
            // Ajouter le message à la conversation en cours
            $message = Message::create([
                'conversation_id' => $existingConversation->id,
                'sender_id' => $user->id,
                'content' => $request->message, // Can be null if only an image is sent
                'file_path' => $filePath,       // Path to the image file, if provided
                'status' => 'sent',
            ]);

            $messages = $this->getMessages($existingConversation);
    
            return response()->json([
                'success' => true,
                'messages' => $messages,
                'message' => 'Message ajouté à la conversation en cours.',
            ]);
        } else {
            // Assigner un support
            // $support = $this->assignSupportToConversation();
    
            // if (!$support) {
            //     // Si aucun support disponible, annuler la création de la conversation
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Aucun support disponible actuellement.'
            //     ], 400);
            // }

            $conversation = Conversation::create([
                'user_id' => $user->id,
                // 'support_id' => $support->id,
                'status' => 'open',
            ]);

            // Ajouter le message initial
            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $user->id,
                'content' => $request->message, // Can be null if only an image is sent
                'file_path' => $filePath,       // Path to the image file, if provided
                'status' => 'sent',
            ]);

            $messages = $this->getMessages($conversation);

            return response()->json([
                'success' => true,
                'messages' => $messages,
                'message' => 'Conversation commencée avec le support assigné.',
            ]);
        }
    }

    private function getMessages(Conversation $conversation) {
        $messages = $conversation->messages()->orderBy('id', 'desc')->get();

        $mappedMessages = $messages->map(function ($message) {
            $createdAt = Carbon::parse($message->created_at);

            // Calcul de la durée et formatage
            if ($createdAt->diffInMinutes() < 60) {
                $timeAgo = intval($createdAt->diffInMinutes()) . ' minute' . (intval($createdAt->diffInMinutes()) > 1 ? 's' : '');
            } elseif ($createdAt->diffInHours() < 24) {
                $timeAgo = intval($createdAt->diffInHours()) . ' heure' . (intval($createdAt->diffInHours()) > 1 ? 's' : '');
            } else {
                $timeAgo = intval($createdAt->diffInDays()) . ' jour' . (intval($createdAt->diffInDays()) > 1 ? 's' : '');
            }

            return [
                'id' => $message->id,
                'text' => $message->content ? $message->content : null, 
                'createdAt' => 'Il y a ' . $timeAgo,
                'createdAtTrue' => $message->created_at,
                'messageImage' => $message->file_path ? url('storage/' . $message->file_path) : null,
                'isSender' => Auth::id() == $message->sender_id ? true : false,
                'image' => $message->sender->profile ? url($message->sender->profile->avatar) : null,
                'senderId' => $message->sender_id,
            ];
        });

        return $mappedMessages;
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

    public function storeForSupport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'conversation_id' => 'required|integer',
            'sender_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Revoyez les champs svp.',
                'errors' => $validator->errors()
            ], 422);
        }

        $conversation = Conversation::whereId($request->conversation_id)->first();

        if(!$conversation) {
            return response()->json([
                'success' => false,
                'message' => "Il n'existe pas de conversation avec cet ID !",
            ]);
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $request->sender_id,
            'content' => $request->message,
            'status' => 'sent',
        ]);

        $createdAt = $message->created_at;
        if ($createdAt->diffInMinutes() < 60) {
            $timeAgo = intval($createdAt->diffInMinutes()) . ' minute' . (intval($createdAt->diffInMinutes()) > 1 ? 's' : '');
        } elseif ($createdAt->diffInHours() < 24) {
            $timeAgo = intval($createdAt->diffInHours()) . ' heure' . (intval($createdAt->diffInHours()) > 1 ? 's' : '');
        } else {
            $timeAgo = intval($createdAt->diffInDays()) . ' jour' . (intval($createdAt->diffInDays()) > 1 ? 's' : '');
        }

        // Construction du mappage du message
        $mappedMessage = [
            'id' => $message->id,
            'text' => $message->content ?: null,
            'createdAt' => 'Il y a ' . $timeAgo,
            'createdAtTrue' => $message->created_at,
            'messageImage' => $message->file_path ? url('storage/' . $message->file_path) : null,
            'isSender' => Auth::id() == $message->sender_id,
            'image' => $message->sender->profile ? url($message->sender->profile->avatar) : null,
            'senderId' => $message->sender_id,
        ];

        event(new MessageSent($message));

        return response()->json([
            'success' => true,
            'message' => $mappedMessage,
        ]);
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