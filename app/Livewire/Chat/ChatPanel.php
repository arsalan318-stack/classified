<?php

namespace App\Livewire\Chat;

use App\Events\MessageRead;
use App\Events\MessageSent;
use App\Events\UserTyping;
use App\Models\Conversations;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatPanel extends Component
{
    public $conversation;
    public $conversationId;
    public $messages;
    public $realtimeMessages;
    public $messageText = '';
    public string $typingUser= '';
    
    public function mount($conversationId)
    {
        $this->conversation = Conversations::with(['product.user', 'messages.sender'])
            ->findOrFail($conversationId);
        $this->loadMessages();

        // Mark unread as read
        Message::where('conversation_id', $this->conversation->id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
        $this->realtimeMessages =  Collect();
    }
    public function loadMessages()
    {
        $this->messages = $this->conversation
            ->messages()
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage()
    {
        if (trim($this->messageText) === '') return;

        $message = Message::create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $this->conversation->sender_id == Auth::id()
                ? $this->conversation->receiver_id
                : $this->conversation->sender_id,
            'message' => $this->messageText,
            'is_read' => false,
        ]);
        // Payload for broadcast (array only)
        $payload = [
            'id'             => $message->id,
            'conversation_id' => $message->conversation_id,
            'sender_id'      => $message->sender_id,
            'receiver_id'    => $message->receiver_id,
            'message'        => $message->message,
            'is_read'        => $message->is_read,
            'created_at'     => $message->created_at->toDateTimeString(),
        ];
        $this->messages->push($message);
        // You can broadcast event here if using Pusher
        broadcast(new MessageSent($payload))->toOthers();
        $this->reset('messageText');
        // scroll after sending
        $this->dispatch('scroll-to-bottom');
    }

    protected function getListeners()
    {
        return [
            'echo:chat.{conversationId},MessageSent' => 'receivedMessage',
            'echo:chat.{conversationId},UserTyping'   => 'showTyping',
            'echo:chat.{conversationId},message.read' => 'updateReadReceipts',
        ];
    }
    public function receivedMessage($payload)
    {
        // make sure it's always a collection
        if (!$this->realtimeMessages instanceof Collection) {
            $this->realtimeMessages = collect($this->realtimeMessages);
        }
        // push as object for consistency
        $this->realtimeMessages->push((object) $payload['message']);
        // tell frontend to scroll
        $this->dispatch('scroll-to-bottom');
        // Broadcast that this user has read messages
        broadcast(new MessageRead($this->conversation->id, Auth::id()))->toOthers();
    }

    public function getAllMessagesProperty()
    {
        return $this->messages
            ->concat($this->realtimeMessages)
            ->sortBy('created_at')
            ->values();
    }


    public function typing()
    {
        broadcast(new UserTyping($this->conversationId, Auth::id()))->toOthers();
    }

    /** Livewire receives broadcast UserTyping here */
    public function showTyping($payload)
    {
        $this->typingUser = $payload['userId'];
        $this->dispatch('clear-typing',['delay' => 3000]);
       // if (($payload['userId'] ?? null) === Auth::id()) return;

        // $this->typingUserId = (int)$payload['userId'];
        // $this->typingUntil  = now()->addSeconds(3);
    }

    // #[On('echo:chat.{conversationId},message.read')]
    public function updateReadReceipts($payload)
    {
        // Only mark messages I sent as read
        foreach ($this->messages as $msg) {
            //  if ($msg->sender_id == Auth::id()) {
            $msg->is_read = true;
            // }
        }
        foreach ($this->realtimeMessages as $msg) {
            // if ($msg->sender_id == Auth::id()) {
            $msg->is_read = true;
            // }
        }

        $this->dispatch('$refresh'); // force UI update
    }
    public function deleteMessage($id)
    {
        $msg = Message::where('id', $id)
            ->where('sender_id', Auth::id())
            ->first();

        if ($msg) {
            $msg->delete();
            $this->loadMessages();
        }
    }

    public function render()
    {
        return view('livewire.chat.chat-panel')->layout('user.chat.chat_panel');
    }
}
