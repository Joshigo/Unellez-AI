@extends('layout.main')
@section('title', 'Nuevo Chat')
@section('content')
<style>
    .chat-messages-container {
        position: relative;
        flex: 1;
        min-height: 400px;
        background-color: #f8fafc;
        border-radius: 12px;
        border: 1px solid #eef2f6;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .chat-messages-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('{{ asset("icon_blue.png") }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: min(280px, 60%);
        opacity: 0.08;
        filter: blur(1.5px);
        pointer-events: none;
        z-index: 0;
    }

    #chat-messages {
        flex: 1;
        min-height: 400px;
        overflow-y: auto;
        padding: 15px;
        background-color: transparent;
        position: relative;
        z-index: 1;
    }

    /* Mascot Loading Animation */
    @keyframes pulseMascot {
        0% { transform: scale(1); filter: drop-shadow(0 4px 6px rgba(105, 108, 255, 0.2)); }
        50% { transform: scale(1.08); filter: drop-shadow(0 8px 16px rgba(105, 108, 255, 0.4)); }
        100% { transform: scale(1); filter: drop-shadow(0 4px 6px rgba(105, 108, 255, 0.2)); }
    }

    @keyframes bounceDot {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }

    #loading-text {
        transition: opacity 0.25s ease-in-out;
    }
</style>

<div class="container py-4">
    <div class="card shadow-sm border-0" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="chat-messages-container mb-3">
                <div id="chat-messages">
                    <!-- Mensajes aparecerán aquí -->
                </div>
            </div>
            <form id="message-form" onsubmit="return false;">
                @csrf
                <div class="input-group">
                    <textarea id="content" name="content" class="form-control" placeholder="Escribe tu mensaje..." rows="1" style="resize: none; max-height: 120px; overflow-y: auto; border-radius: 8px 0 0 8px; border-right: 0; padding: 12px 16px;"></textarea>
                    <button type="submit" class="btn btn-primary px-4" style="border-radius: 0 8px 8px 0;">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('message-form');
        const input = document.getElementById('content');
        const chatContainer = document.getElementById('chat-messages');
        let chatId = null;
        const STORAGE_BASE = @json(asset('storage'));
        const MASCOT_ASSET_URL = @json(asset('bot-center_blue.png'));

        const WAITING_MESSAGES = [
            "Estoy generando tu respuesta...",
            "Consultando la información del programa...",
            "Buscando en la base de datos académica...",
            "Analizando los detalles de tu consulta...",
            "Organizando la información autorizada por los Jefes de Programa...",
            "Casi listo, redactando la respuesta...",
            "Procesando tu solicitud..."
        ];

        let loadingInterval = null;
        let currentLoadingWrapper = null;

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
            wrapper.classList.add('mb-3', sender === 'user' ? 'text-end' : 'text-start');
            
            const isUser = sender === 'user';
            
            wrapper.innerHTML = `
                <div class="d-inline-block text-start" style="max-width: 75%;">
                    <span class="badge ${isUser ? 'bg-primary' : 'bg-success'} mb-1">
                        ${isUser ? 'Tú' : 'Asistente'}
                    </span>
                    <div class="p-3 ${isUser ? 'bg-primary text-white shadow-sm' : 'bg-light text-dark border'}" style="word-break: break-word; border-radius: 16px; border-bottom-${isUser ? 'right' : 'left'}-radius: 4px; font-size: 0.95rem; line-height: 1.5;">
                        ${htmlContent}
                    </div>
                </div>`;
                
            chatContainer.appendChild(wrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function showLoadingMessage() {
            const initialMsg = WAITING_MESSAGES[Math.floor(Math.random() * WAITING_MESSAGES.length)];
            
            const wrapper = document.createElement('div');
            wrapper.id = 'chat-loading-indicator';
            wrapper.classList.add('mb-3', 'text-start');
            
            wrapper.innerHTML = `
                <div class="d-inline-block text-start" style="max-width: 75%;">
                    <span class="badge bg-success mb-1">
                        Asistente <span class="spinner-grow spinner-grow-sm text-light ms-1" style="width: 8px; height: 8px;" role="status"></span>
                    </span>
                    <div class="p-3 bg-light text-dark border d-flex align-items-center gap-3" style="word-break: break-word; border-radius: 16px; border-bottom-left-radius: 4px;">
                        <div class="d-flex flex-column">
                            <span id="loading-text" class="fw-medium text-secondary animate-fade" style="font-size: 0.92rem;">${initialMsg}</span>
                            <div class="typing-dots mt-1 d-flex gap-1">
                                <span class="dot bg-primary rounded-circle" style="width: 6px; height: 6px; animation: bounceDot 1.4s infinite both;"></span>
                                <span class="dot bg-primary rounded-circle" style="width: 6px; height: 6px; animation: bounceDot 1.4s infinite both 0.2s;"></span>
                                <span class="dot bg-primary rounded-circle" style="width: 6px; height: 6px; animation: bounceDot 1.4s infinite both 0.4s;"></span>
                            </div>
                        </div>
                    </div>
                </div>`;
            
            chatContainer.appendChild(wrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;
            currentLoadingWrapper = wrapper;
            
            loadingInterval = setInterval(() => {
                const textElem = wrapper.querySelector('#loading-text');
                if (textElem) {
                    let nextMsg = initialMsg;
                    while (nextMsg === textElem.textContent) {
                        nextMsg = WAITING_MESSAGES[Math.floor(Math.random() * WAITING_MESSAGES.length)];
                    }
                    textElem.style.opacity = 0;
                    setTimeout(() => {
                        textElem.textContent = nextMsg;
                        textElem.style.opacity = 1;
                    }, 250);
                }
            }, 2500);
        }

        function removeLoadingMessage() {
            if (loadingInterval) {
                clearInterval(loadingInterval);
                loadingInterval = null;
            }
            if (currentLoadingWrapper) {
                currentLoadingWrapper.remove();
                currentLoadingWrapper = null;
            }
        }

        // Auto-grow textarea
        input.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Submit on Enter key (Shift+Enter inserts newline)
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                form.dispatchEvent(new Event('submit'));
            }
        });

        async function send(message) {
            addMessageToChat('user', escapeHtml(message));
            
            // Reset input and adjust size
            input.value = '';
            input.style.height = 'auto';
            
            showLoadingMessage();
            
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
                
                removeLoadingMessage();
                
                if (!chatId && data.chat_id) chatId = data.chat_id;
                renderAIResponse(data);
            } catch (err) {
                removeLoadingMessage();
                addMessageToChat('ai', 'Error: ' + escapeHtml(err.message));
            }
        }

        function renderAIResponse(data) {
            if (data.ai_response && !data.type) {
                addMessageToChat('ai', escapeHtml(data.ai_response).replace(/\n/g, '<br>'));
                return;
            }
            const type = data.type;
            console.log('Tipo de respuesta AI:', type);
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
    });
</script>
