{{-- back/pages/support/chat/chat-sidebar-single.blade.php --}}
@if ($conversations->isNotEmpty())
    @php $lastConversation = $conversations->first(); @endphp
    <div class="last-chat">
        <h5>Dernière Conversation</h5>
        <div class="chat-item" data-conversation-id="{{ $lastConversation->id }}">
            <div class="chat-user">
                <img src="{{ asset('assets/images/users/' . $lastConversation->support->profile->avatar) }}" alt="{{ $lastConversation->support->firstname }}" class="avatar-lg">
                <div class="chat-user-info">
                    <h6>{{ $lastConversation->support->firstname . ' ' . $lastConversation->support->lastname }}</h6>
                    <p>{{ Str::limit($lastConversation->messages->last()->content ?? '', 30) }}</p>
                </div>
            </div>
            <div class="chat-time">{{ $lastConversation->updated_at->diffForHumans() }}</div>
        </div>
    </div>
@endif
