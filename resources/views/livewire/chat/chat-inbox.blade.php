<div>
 
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-4 border-right" style="height: 80vh; overflow-y: auto;">
                <div class="p-3">
                    <h5 class="font-weight-bold mb-3">INBOX</h5>

                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#all">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link conversation-link" data-toggle="tab" href="#unread">Unread
                                <span class="badge badge-danger ml-1" id="unreadCount">
                                    {{ $conversations->where('unread_count', '>', 0)->count() }}
                                </span>

                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="all">
                            <div id="conversationList">
                                @if($conversations->isEmpty())
                                    <div class="text-center text-muted">
                                        <i class="fa fa-comments fa-3x mb-3"></i>
                                        <p>No conversations found</p>
                                    </div>
                                @endif
                                @foreach ($conversations as $conv)
                                    @php
                                        $otherUser = $conv->sender_id == auth()->id() ? $conv->receiver : $conv->sender;
                                        // $lastMsg = $conv->messages()->latest()->first();
                                    @endphp
                                    <a href="#" wire:click.prevent="openConversation({{ $conv->id }})" class="list-group-item list-group-item-action conversation-link"
                                        data-conversation-id="{{ $conv->id }}">
                                        <div class="d-flex justify-content-between">
                                            <strong>{{ $otherUser->name }}</strong>
                                            <small>
                                                {{ $conv->latestMessage ? $conv->latestMessage->created_at->diffForHumans() : '' }}</small>
                                            @if ($conv->unread_count > 0)
                                                <span class="badge badge-danger">{{ $conv->unread_count }}</span>
                                            @endif
                                        </div>
                                        <small>{{ $conv->product->title ?? '' }}</small>
                                    </a>
                                    <div class="ml-2">
                                        <button wire:click.stop="deleteConversation({{ $conv->id }})" 
                                                class="btn btn-sm btn-light">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="unread">
                            <div id="unreadList">
                                @if($conversations->where('unread_count', '>', 0)->isEmpty())
                                    <div class="text-center text-muted">
                                        <i class="fa fa-comments fa-3x mb-3"></i>
                                        <p>No unread conversations</p>
                                    </div>
                                @endif
                                @foreach ($conversations->where('unread_count', '>', 0) as $conv)
                                    @php
                                        $otherUser = $conv->sender_id == auth()->id() ? $conv->receiver : $conv->sender;
                                    @endphp
                                    <a href="#" wire:click.prevent="openConversation({{ $conv->id }})" class="list-group-item list-group-item-action conversation-link"
                                        data-conversation-id="{{ $conv->id }}">
                                        <div class="d-flex justify-content-between">
                                            <strong>{{ $otherUser->name }}</strong>
                                            <span class="badge badge-danger">{{ $conv->unread_count }}</span>
                                            <small>
                                                {{ $conv->latestMessage ? $conv->latestMessage->created_at->format('h:i A') : '' }}</small>
                                        </div>
                                        <small>{{ $conv->product->title ?? '' }}</small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <!-- Chat Window -->
<div class="col-md-8" id="chatWindow">
    @if ($activeConversation)
        <livewire:chat.chat-panel :conversationId="$activeConversation->id" :key="$activeConversation->id" />
    @else
        <div class="d-flex justify-content-center align-items-center h-100 text-muted">
            <i class="fa fa-comments fa-3x mb-3"></i>
            <p class="ml-3">Select a chat to begin messaging</p>
        </div>
    @endif
</div>

        </div>
    </div>
</div>
