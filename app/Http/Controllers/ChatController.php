<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Helpers\BackHelper;
use Carbon\Carbon;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.pages.support.chat.message');
    }

    public function markMessagesAsRead($conversationId)
    {
        // Obtenir l'utilisateur actuellement authentifié
        $userId = auth()->id();

        // Vérifier si la conversation existe
        $conversationExists = Conversation::where('id', $conversationId)->exists();
        if (!$conversationExists) {
            return response()->json(['status' => 'error', 'message' => 'Conversation non trouvée.'], 404);
        }

        // Mettre à jour les messages de la conversation pour les marquer comme lus
        $updatedCount = Message::where('conversation_id', $conversationId)
            ->where('sender_id', '!=', $userId) // S'assurer que nous marquons uniquement les messages de l'autre participant
            ->where('is_read', false) // Ne marquer que les messages non lus
            ->update(['is_read' => true]);

        // Retourner une réponse pour confirmer l'opération avec le nombre de messages mis à jour
        return response()->json(['status' => 'success', 'updated_count' => $updatedCount]);
    }

    public function getMessages()
    {
        // Vérifier si l'utilisateur a le rôle d'administrateur ou de manager
        $isAdmin = auth()->user()->hasRole('super admin') || auth()->user()->hasRole('manager');

        if ($isAdmin) {
            // Récupérer toutes les conversations pour l'administrateur ou le manager avec le dernier message et le comptage des messages non lus
            $conversations = Conversation::with(['user', 'support', 'lastMessage'])
                ->withCount(['messages as unread_count' => function ($query) {
                    $query->where('is_read', false)
                        ->where('sender_id', '!=', auth()->id()); // Exclure les messages envoyés par l'utilisateur connecté
                }])
                ->get();
        } else {
            // Récupérer les conversations non prises en charge (is_taken = false) ou non résolues
            $conversations = Conversation::with(['user', 'support', 'lastMessage'])
                ->withCount(['messages as unread_count' => function ($query) {
                    $query->where('is_read', false)
                        ->where('sender_id', '!=', auth()->id()); // Exclure les messages envoyés par l'utilisateur connecté
                }])
                ->where('status', '!=', 'resolved') // Exclure les conversations résolues
                ->where(function ($query) {
                    $query->where('support_id', auth()->id()) // Conversations assignées à l'utilisateur connecté
                        ->orWhere(function ($query) {
                            $query->where('user_id', auth()->id()) // Conversations de l'utilisateur connecté
                                ->where('is_taken', false); // Conversations non prises en charge
                        });
                })
                ->get();
        }

        // Trier les conversations selon la date du dernier message (du plus récent au plus ancien)
        $conversations = $conversations->sortByDesc(function ($conversation) {
            return optional($conversation->lastMessage)->created_at;
        })->values(); // Réindexer proprement

        // Retourner les conversations au format JSON avec le compte des messages non lus
        return response()->json($conversations->map(function ($conversation) {
            return [
                'id' => $conversation->id,
                'firstname' => $conversation->user->firstname,
                'lastname' => $conversation->user->lastname,
                'lastMessage' => $conversation->lastMessage->content ? Str::limit($conversation->lastMessage->content, 20, '...') : null,
                'time' => optional($conversation->lastMessage)->created_at?->format('H:i'),
                'createdAt' => optional($conversation->lastMessage)->created_at,
                'unreadCount' => $conversation->unread_count,
                'image' => $conversation->user->profile->avatar ?? 'default-image.png',
                'active' => false,
            ];
        }));
    }

    public function sendMessage(Request $request, $conversationId)
    {
        if ($request->hasFile('file') || $request->input('content')) {
            # code...
            // Validation de la requête
            $request->validate([
                'content' => 'nullable|string|max:255',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            // Initialisation des données du message
            $data = [
                'content' => $request->input('content'),
                'sender_id' => Auth::id(),
                'conversation_id' => $conversationId,
            ];

            // Gérer le téléchargement du fichier si présent
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileExtension = $file->getClientOriginalExtension(); // Récupère l'extension du fichier
                $fileName = time() . '.' . $fileExtension; // Crée le nom du fichier avec le timestamp et l'extension
                $storagePath = 'back/assets/images/chat/';

                // Sauvegarde du fichier dans le répertoire spécifique
                $filePath = $file->storeAs($storagePath, $fileName, 'public');
                $data['file_path'] = $filePath;
            }

            // Création du message
            $message = Message::create($data);

            $conversation = Conversation::find($conversationId)->first();

            $conversation->update([
                'updated_at' => Carbon::now()
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
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
        // Récupérer la conversation avec les messages triés par date
        $conversation = Conversation::with(['messages' => function ($query) {
            $query->orderBy('created_at', 'asc'); // Trier les messages par date
        }])
            ->where('status', '!=', 'resolved') // Vérifier que la conversation n'est pas résolue
            ->find($conversationId);

        // Si la conversation est introuvable ou est résolue
        if (!$conversation) {
            return response()->json(['error' => 'Conversation non disponible ou déjà résolue'], 403);
        }

        return response()->json($conversation->messages);
    }
}
