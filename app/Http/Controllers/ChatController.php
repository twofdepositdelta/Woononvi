<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vérifier si l'utilisateur a le rôle d'administrateur
        $isAdmin = auth()->user()->hasRole('super admin');

        if ($isAdmin) {
            // Récupérer toutes les conversations pour l'administrateur
            $conversations = Conversation::with(['user', 'support'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Récupérer les conversations traitées par le support de l'utilisateur actuel et celles non lues par d'autres supports
            $conversations = Conversation::with(['user', 'support'])
                ->where(function ($query) {
                    $query->where('support_id', auth()->id())
                          ->orWhere('status', '!=', 'resolved') // Conversations non résolues
                          ->where('user_id', auth()->id()); // Conversations de l'utilisateur
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // dd($conversations);

        return view('back.pages.support.chat.message', compact('conversations'));
    }


    public function getMessages($conversationId)
    {
        // Récupérer les messages d'une conversation active
        $messages = Message::with('sender')
            ->where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'conversation_id' => 'required|exists:conversations,id',
            'sender_id' => 'required|exists:users,id',
        ]);

        $message = Message::create($request->only('conversation_id', 'sender_id', 'content'));
        return response()->json(['success' => true, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function fetchMessages($conversationId)
    {
        $conversation = Conversation::with(['messages' => function($query) {
                $query->orderBy('created_at', 'asc'); // Trier les messages par date
            }])
            ->findOrFail($conversationId);

        return response()->json($conversation->messages);
    }
}