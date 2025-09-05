<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets , SerializesModels;
    public $message;
    /**
     * Create a new event instance.
     */

    public function __construct(array $message)
    {
        $this->message = [
            'id'             => $message['id'],
            'conversation_id'=> $message['conversation_id'],
            'sender_id'      => $message['sender_id'],
            'receiver_id'    => $message['receiver_id'],
            'message'        => $message['message'],
            'is_read'        => $message['is_read'],
            'created_at'     => $message['created_at'],
           //  'sender'         => [
           //      'id'   => $message->sender->id,
           //      'name' => $message->sender->name,
           //  ],
        ];
       // $this->message = $message->toArray();
     //  $this->message = $message->load('sender'); // eager load sender if needed
    
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        // Channel name per conversation
        return new Channel('chat.' . $this->message['conversation_id']);
    }

    public function broadcastWith()
    {
        // ✅ Always wrap inside "message"
        return [
            'message' => $this->message
        ];
    }
  
}
