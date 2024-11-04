<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'content',
        'file_path',
        'status',
        'is_read',
        'read_at',
    ];

    // Relation avec le modèle Conversation
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    // Relation avec le modèle User pour l'expéditeur
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Méthode pour marquer le message comme lu
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    // Méthode statique pour récupérer les messages non lus
    public static function getUnreadMessages($userId)
    {
        return self::where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->get();
    }
}