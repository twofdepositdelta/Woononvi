<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\BackHelper;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        //
    }

    public function allMessages($conversationId)
    {
        // Récupérer les messages de la conversation avec les informations sur l'utilisateur
        $messages = Message::with('sender')
            ->where('conversation_id', $conversationId)
            ->when(!Auth::user()->hasRole('super admin'), function ($query) {
                // Si l'utilisateur n'est pas super admin, il ne voit que les messages des conversations résolues
                $query->whereHas('conversation', function ($query) {
                    $query->where('status', '!=', 'resolved');
                });
            })
            ->get();

        return response()->json($messages->map(function($message) {
            return [
                'id' => $message->id,
                'text' => $message->content ?$message->content : null, // Utilisez 'content' pour correspondre à votre schéma
                'createdAt' => $message->created_at,
                'messageImage' => $message->file_path ? asset('storage/' . $message->file_path) : null,
                'isSender' => Auth::id() == $message->sender_id ? 'right' : 'left',
                'image' => $message->conversation->user->profile->avatar, // Assurez-vous d'utiliser 'sender_id'
                'senderId' => $message->sender_id, // Assurez-vous d'utiliser 'sender_id'
            ];
        }));
    }

    public function getUserInfo($conversationId)
    {
        // Recherchez la conversation et récupérez les informations de l’utilisateur associé
        $conversation = Conversation::find($conversationId);
        $user = $conversation->user; // Relation vers l’utilisateur

        return response()->json([
            'image' => $user->profile->avatar,  // image du profil de l’utilisateur
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'userId' => $user->id,
            'status' => $user->status,
            'statusConversation' => $conversation->status,
            'role' => $user->getRoleNames() // par exemple : 'Available', 'Offline'
        ]);
    }

    public function close($id)
    {
        $conversation = Conversation::findOrFail($id);

        // Ici, on pourrait vérifier si l'utilisateur est bien le support ou l'initiateur de la conversation.
        if (auth()->id() != $conversation->support_id && !auth()->user()->hasRole('super admin')) {
            return redirect()->back()->with('error', 'Non autorisé à clôturer cette conversation.');
        }

        // Mettre à jour le statut de la conversation
        $conversation->status = 'resolved';
        $conversation->save();

        return redirect()->back()->with('success', 'Conversation clôturée avec succès.');
    }
}