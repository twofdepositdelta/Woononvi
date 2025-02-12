<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('my_channel'),
        ];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }


    // public function broadcastWith()
    // {
    //     return [
    //         'id' => $this->message->id,
    //         'sender_id' => $this->message->sender_id,
    //         'text' => $this->message->text,
    //         'messageImage' => $this->message->image,
    //         'created_at' => $this->message->created_at->toDateTimeString(),
    //     ];
    // }
}
