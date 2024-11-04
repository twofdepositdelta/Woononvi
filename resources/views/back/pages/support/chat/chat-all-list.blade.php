{{-- back/pages/support/chat/chat-all-list.blade.php --}}
<div class="chat-all-list">
    @foreach($conversations as $conversation)
        <div class="chat-sidebar-single" data-conversation-id="{{ $conversation->id }}">
            <div class="chat-user">
                <img src="{{ asset('assets/images/users/' . $conversation->support->profile->avatar) }}" alt="{{ $conversation->support->firstname }}" class="avatar-lg">
                <div class="chat-user-info">
                    <h6 class="chat-user-name">{{ $conversation->support->firstname . ' ' . $conversation->support->lastname }}</h6>
                    <p class="chat-message-preview">{{ Str::limit($conversation->messages->last()->content ?? '', 30) }}</p>
                </div>
            </div>
            <div class="chat-time">{{ $conversation->updated_at->diffForHumans() }}</div>
        </div>
    @endforeach
</div>

<script>
    document.querySelectorAll('.chat-item').forEach(item => {
        item.addEventListener('click', function() {
            const conversationId = this.getAttribute('data-conversation-id');
            fetchMessages(conversationId);
        });
    });

    function fetchMessages(conversationId) {
        fetch(`/chat/messages/${conversationId}`)
            .then(response => response.json())
            .then(data => {
                const messageList = document.querySelector('.chat-message-list');
                messageList.innerHTML = ''; // Clear existing messages
                data.forEach(message => {
                    messageList.innerHTML += `
                        <div class="chat-single-message ${message.sender_id === {{ auth()->id() }} ? 'right' : 'left'}">
                            <div class="chat-message-content">
                                <p class="mb-3">${message.content}</p>
                                <p class="chat-time mb-0">
                                    <span>${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
                                </p>
                            </div>
                        </div>
                    `;
                });
            });
    }
</script>

