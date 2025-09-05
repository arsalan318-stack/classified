<?php

namespace App\Livewire\Chat;

use App\Models\Conversations;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatInbox extends Component
{
    public $conversations;
    public $activeConversation = null;
    public $unreadCounts = [];
    public $conversationId;
    
    protected $listeners = ['openConversation'];

    public function openConversation($id)
    {
        $this->activeConversation = Conversations::with(['messages'])->find($id);
    }
    public function mount(){
        $this->loadConversations();
    }


    public function loadConversations(){
        $senderId = auth()->id();
        $this->conversations = Conversations::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['sender', 'receiver', 'product'])
            ->latest()
            ->get()->map(function ($conv) use ($senderId) {
                $conv->unread_count = Message::where('conversation_id', $conv->id)
                                             ->where('receiver_id', $senderId)
                                             ->where('is_read', false)
                                             ->count();
                return $conv;
            });
    }

    public function deleteConversation($id)
    {
        $conv = Conversations::where('id', $id)
            ->where(function ($q) {
                $q->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
            })
            ->first();

        if ($conv) {
            $conv->messages()->delete();
            $conv->delete();
            $this->loadConversations();
            $this->activeConversation = null;
           // $this->emit('conversationDeleted');
        }
    }

    public function render()
    {
        return view('livewire.chat.chat-inbox')->layout('user.chat.chat_inbox');
    }
}
