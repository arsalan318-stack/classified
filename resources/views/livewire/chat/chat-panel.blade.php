<div x-data x-init="() => {
    let chatBody = $refs.chatBody;
    if (chatBody) {
        chatBody.scrollTop = chatBody.scrollHeight;
    }
}" class="d-flex flex-column" style="height: 80vh;">
    {{-- <style>
    .typing-indicator {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }

    .typing-indicator.show {
        opacity: 1;
    }
</style> --}}
    <!-- Header -->
    <div class="border-bottom p-3 d-flex justify-content-between">
        <div>
            @php
                $otherUser = $conversation->sender_id == auth()->id() ? $conversation->receiver : $conversation->sender;
            @endphp
            @if ($otherUser->profile_photo_path)
                <img src="{{ asset('storage/' . $otherUser['profile_photo_path']) }}" class="rounded-circle mr-2"
                    style="width: 50px;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($otherUser->name) }}&background=random&color=fff"
                    alt="Avatar" class="rounded-circle mr-2" style="width:50px;">
            @endif
            <strong>{{ $otherUser->name }}</strong><br>

            @if ($otherUser->isOnline())
                <small class="text-success">Online</small>
            @else
                <small>Last seen
                    {{ $otherUser->last_seen ? $otherUser->last_seen->diffForHumans() : 'a while ago' }}</small>
            @endif

        
        @if ($typingUser)
            <div id="typingIndicator" class="text-muted small fst-italic typing-indicator">
                Typing...
            </div>
              @endif
    </div>
    <div class="d-flex flex-column align-items-end">
        <div class="d-flex align-items-center mb-1">
            <button class="btn btn-sm btn-light mr-1" title="Report">
                <i class="fa fa-flag text-danger"></i>
            </button>
            <a href="tel:{{ $conversation->product->user->phone }}" class="btn btn-sm btn-light mr-1"><i
                    class="fa fa-phone text-success"></i></a>
            <a href="sms:{{ $conversation->product->user->phone }}" class="btn btn-sm btn-light mr-1"><i
                    class="fa fa-comment text-primary"></i></a>
            <div class="dropdown">
                <button class="btn btn-sm btn-light" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v text-dark"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a wire:click.stop="deleteConversation({{ $conversation->id }})"
                        class="dropdown-item text-danger delete-conversation" href="#">
                        <i class="fa fa-trash mr-2"></i> Delete Chat</a>
                    <a class="dropdown-item" href="">
                        <i class="fa fa-flag mr-2 text-danger"></i> Report Chat</a>
                </div>
            </div>
        </div>
        <a href="{{ route('get_product_details', $conversation->product->id) }}"
            class="btn btn-sm btn-outline-primary">View Ad</a>
    </div>
</div>

<!-- Ad Info -->
<div class="p-2 border-bottom d-flex align-items-center">
    <img src="{{ asset('storage/' . $conversation->product['image1']) }}" class="mr-3"
        style="width: 50px; border-radius: 8px;">
    <div>
        <strong>{{ $conversation->product->title }}</strong><br>
        <span class="text-muted">Rs {{ $conversation->product->price }}</span>
    </div>
</div>

<!-- Messages -->
<div x-ref="chatBody" id="chatBody" wire:ignore.self class="flex-grow-1 p-3 chat-body"
    style="overflow-y: auto; background: #f7f7f7; position:relative; max-height:400px;">


    @if ($messages->isEmpty())
        <div class="text-center text-muted">
            <i class="fa fa-comments fa-3x mb-3"></i>
            <p>No messages yet. Start the conversation!</p>
        </div>
    @endif

    {{-- Messages from database and realtime --}}
    @foreach ($this->allMessages as $msg)
        <div
            class="d-flex {{ $msg->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }} mb-2">
            <div
                class="{{ $msg->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-info text-white' }} p-2 rounded">
                {{ $msg->message }}
                <br>
                <small class="text-white">
                    {{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}
                </small>

                @if ($msg->sender_id == auth()->id())
                    <button wire:click="deleteMessage({{ $msg->id }})"
                        class="btn btn-sm text-dark bg-primary delete-message">
                        <i class="fa fa-trash"></i>
                    </button>
                @endif
            </div>
            @if ($msg->sender_id == auth()->id())
                @if ($msg->is_read)
                    <span class="ml-1 text-info">✓✓</span> <!-- read -->
                @else
                    <span class="ml-1">✓</span> <!-- sent -->
                @endif
            @endif
        </div>
    @endforeach


</div>

<!-- Input -->
<div class="border-top p-3">
    <form wire:submit.prevent="sendMessage" id="sendMessageForm" class="d-flex">
        @csrf
        <input type="text" wire:model.live="messageText" wire:key="chat-input-{{ now()->timestamp }}"
            class="form-control" placeholder="Type a message..." wire:keydown="typing">

        <button class="btn btn-primary ml-2">Send</button>
    </form>
</div>
</div>
@script
    <script>
        window.addEventListener('scroll-to-bottom', () => {
            const chatBody = document.getElementById('chatBody');
            if (chatBody) {
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        });

        // Scroll once on page load
        document.addEventListener("DOMContentLoaded", () => {
            const chatBody = document.getElementById('chatBody');
            if (chatBody) {
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        });
    </script>

<script>
    window.Echo.channel('chat.${conversationId}')
    .listen('UserTyping', (e) => {
        console.log('UserTyping event received', e);
        Livewire.dispatch('UserTyping', {userId: e.userId});
    });
</script>

<script>
    window.addEventListener('clear-typing', (e) => {
        setTimeout(() => {
            Livewire.dispatch('UserTyping', {userId: ''});
        }, e.detail.delay);
    });
</script>

    {{-- <script>
    const typingIndicator = document.getElementById('typingIndicator');
    let typingTimeout;

    Echo.channel('chat.{{ $conversationId }}')
        .listen('.user.typing', (e) => {
            console.log('typing event received', e);
            if (e.userId !== {{ auth()->id() }}) {
                typingIndicator.classList.add("show");

                clearTimeout(typingTimeout);
                typingTimeout = setTimeout(() => {
                    typingIndicator.classList.remove("show");
                }, 3000);
            }
        });
</script> --}}
@endscript
