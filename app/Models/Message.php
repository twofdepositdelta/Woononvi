<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{

    use HasFactory;

    protected $fillable = ['conversation_id', 'sender_id', 'content', 'is_read'];

    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

}