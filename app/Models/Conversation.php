<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'support_id', 'status', 'is_taken'];

    // Relation avec les messages
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le support
    public function support()
    {
        return $this->belongsTo(User::class, 'support_id');
    }

    // Récupérer le dernier message de la conversation
    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    // Marquer la conversation comme résolue
    public function markAsResolved()
    {
        $this->update(['status' => 'resolved']);
    }

    // Compter les messages non lus dans la conversation
    public function unreadMessagesCount()
    {
        return $this->messages()->where('is_read', false)->count();
    }
}