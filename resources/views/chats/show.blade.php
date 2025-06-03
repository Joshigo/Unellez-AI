@extends('layout.main')
@section('title', $chat->name)
@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>{{ $chat->name }}</h5>
            <a href="{{ route('chats.create') }}" class="btn btn-sm btn-primary">
                <i class="bx bx-plus"></i> Nuevo chat
            </a>
        </div>
        <div class="card-body">
            <div id="chat-messages" class="mb-3" style="min-height: 300px; max-height: 500px; overflow-y: auto;">
                <!-- Mostrar mensajes existentes -->
                @foreach($chat->messages as $message)
                    <div class="mb-2">
                        <div class="text-end">
                            <span class="badge bg-primary">Tú</span>
                            <div class="mt-1 p-2 rounded bg-primary text-white">
                                {{ $message->content }}
                            </div>
                        </div>
                        @if($message->response)
                            <div class="text-start">
                                <span class="badge bg-success">Asistente</span>
                                <div class="mt-1 p-2 rounded bg-light">
                                    {{ $message->response->content }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
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
    console.log("asd");
    function sendMessage(){
        const form = document.getElementById('message-form');
        const input = document.getElementById('content');
        const chatContainer = document.getElementById('chat-messages');
        const chatId = {{ $chat->id }};

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const message = input.value.trim();
            if (!message) return;

            // Añadir mensaje del usuario al chat
            addMessageToChat('user', message);
            input.value = '';

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
                    throw new Error('Error en la respuesta del servidor');
                }

                const data = await response.json();

                // Mostrar respuesta de Gemini
                if (data.ai_response) {
                    addMessageToChat('ai', data.ai_response);
                }
            } catch (error) {
                console.error('Error:', error);
                addMessageToChat('ai', 'Lo siento, ocurrió un error. Por favor, intenta de nuevo.');
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
