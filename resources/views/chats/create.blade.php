@extends('layout.main')
@section('title', 'Nuevo Chat')
@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div id="chat-messages" class="mb-3" style="min-height: 300px; max-height: 500px; overflow-y: auto;">
                <!-- Mensajes aparecerán aquí -->
            </div>
            <form id="message-form" onsubmit="return false;">
                @csrf
                <div class="input-group">
                    <input type="text" id="content" name="content" class="form-control" placeholder="Escribe tu mensaje...">
                    <button type="submit" class="btn btn-primary" onclick="sendMessage()">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script>
    function sendMessage() {
        const form = document.getElementById('message-form');
        const input = document.getElementById('content');
        const chatContainer = document.getElementById('chat-messages');
        let chatId = null;

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const message = input.value.trim();
            if (!message) return;

            addMessageToChat('user', message);
            input.value = '';

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Corregido: Cambiado a /api/chats
                const response = await fetch('/api/chats', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        content: message,
                        chat_id: chatId
                    })
                });

                if (!response.ok) {
                    throw new Error(`Error en el servidor: ${response.status}`);
                }

                const data = await response.json();
                console.log('Respuesta del servidor:', data);

                if (!chatId && data.chat_id) {
                    chatId = data.chat_id;
                }

                if (data.ai_response) {
                    addMessageToChat('ai', data.ai_response);
                }
            } catch (error) {
                console.error('Error:', error);
                addMessageToChat('ai', 'Error: ' + error.message);
            }
        });

        function addMessageToChat(sender, message) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('mb-2');
            messageDiv.innerHTML = `
                <div class="${sender === 'user' ? 'text-end' : 'text-start'}">
                    <span class="badge ${sender === 'user' ? 'bg-primary' : 'bg-success'}">
                        ${sender === 'user' ? 'Tú' : 'Asistente'}
                    </span>
                    <div class="mt-1 p-2 rounded ${sender === 'user' ? 'bg-primary text-white' : 'bg-light'}">
                        ${message}
                    </div>
                </div>
            `;
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    }
</script>
