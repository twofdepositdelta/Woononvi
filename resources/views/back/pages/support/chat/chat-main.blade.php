{{-- back/pages/support/chat/chat-main.blade.php --}}
<div class="chat-main card">
    <div class="chat-message-list">
        <!-- Messages will be dynamically inserted here -->
    </div>
    <form class="chat-message-box" id="chat-form">
        <input type="text" name="chatMessage" id="chatMessage" placeholder="Write message" required>
        <div class="chat-message-box-action">
            <button type="button" class="text-xl">
                <iconify-icon icon="ph:link"></iconify-icon>
            </button>
            <button type="button" class="text-xl">
                <iconify-icon icon="solar:gallery-linear"></iconify-icon>
            </button>
            <button type="submit" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                Send
                <iconify-icon icon="f7:paperplane"></iconify-icon>
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const messageContent = document.getElementById('chatMessage').value;
        const conversationId = document.querySelector('.last-chat .chat-item').getAttribute('data-conversation-id'); // Get current conversation ID

        fetch('{{ route('chat.send') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ content: messageContent, conversation_id: conversationId, sender_id: '{{ auth()->id() }}' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Clear input field and fetch messages
                document.getElementById('chatMessage').value = '';
                fetchMessages(conversationId);
            }
        });
    });
</script>
