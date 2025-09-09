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
    function sendMessage () {
        const form = document.getElementById('message-form');
        const input = document.getElementById('content');
        const chatContainer = document.getElementById('chat-messages');
        let chatId = null;
        const STORAGE_BASE = @json(asset('storage'));

        function buildStorageUrl(path) {
            if (!path) return '';
            return STORAGE_BASE.replace(/\/$/, '') + '/' + path.replace(/^\//, '');
        }

        function escapeHtml(str) {
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function addMessageToChat(sender, htmlContent) {
            const wrapper = document.createElement('div');
            wrapper.classList.add('mb-2');
            wrapper.innerHTML = `
                <div class="${sender === 'user' ? 'text-end' : 'text-start'}">
                    <span class="badge ${sender === 'user' ? 'bg-primary' : 'bg-success'}">
                        ${sender === 'user' ? 'Tú' : 'Asistente'}
                    </span>
                    <div class="mt-1 p-2 rounded ${sender === 'user' ? 'bg-primary text-white' : 'bg-light'}" style="max-width: 100%; word-break: break-word;">
                        ${htmlContent}
                    </div>
                </div>`;
            chatContainer.appendChild(wrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        async function send(message) {
            addMessageToChat('user', escapeHtml(message));
            input.value = '';
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const resp = await fetch('/api/chats', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ content: message, chat_id: chatId })
                });
                if (!resp.ok) throw new Error('Error en el servidor: ' + resp.status);
                const data = await resp.json();
                if (!chatId && data.chat_id) chatId = data.chat_id;
                renderAIResponse(data);
            } catch (err) {
                addMessageToChat('ai', 'Error: ' + escapeHtml(err.message));
            }
        }

        function renderAIResponse(data) {
            if (data.ai_response && !data.type) {
                addMessageToChat('ai', escapeHtml(data.ai_response).replace(/\n/g, '<br>'));
                return;
            }
            const type = data.type;
            const content = data.content || '';
            if (type === 'text') {
                const html = escapeHtml(content).replace(/\n/g, '<br>');
                addMessageToChat('ai', html);
            } else if (type === 'image') {
                const url = buildStorageUrl(content);
                const html = `<div><img src="${url}" alt="Resultado" class="img-fluid rounded border" style="max-height:400px;"/><div class="small text-muted mt-1">Imagen relacionada (keywords match)</div></div>`;
                addMessageToChat('ai', html);
            } else if (type === 'pdf') {
                const url = buildStorageUrl(content);
                const html = `<div><i class="bx bxs-file-pdf text-danger"></i> <a href="${url}" target="_blank" rel="noopener" class="fw-bold">Abrir PDF</a><div class="small text-muted">Documento relacionado (keywords match)</div></div>`;
                addMessageToChat('ai', html);
            } else {
                addMessageToChat('ai', '<em>Respuesta desconocida.</em>');
            }
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const msg = input.value.trim();
            if (!msg) return;
            send(msg);
        });
    };
</script>
