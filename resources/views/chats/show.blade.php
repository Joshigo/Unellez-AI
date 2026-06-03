@extends('layout.main')
@section('title', $chat->name)
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
</style>

<div class="container py-4">
    <div class="card shadow-sm border-0" style="border-radius: 16px;">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0 pt-4 px-4 pb-0">
            <h5 class="fw-bold mb-0 text-dark">{{ $chat->name }}</h5>
        </div>
        <div class="card-body p-4">
            <div class="chat-messages-container mb-3">
                <div id="chat-messages">
                    <!-- Mostrar mensajes existentes -->
                    @foreach($chat->messages as $message)
                        <div class="mb-3 text-end">
                            <div class="d-inline-block text-start" style="max-width: 75%;">
                                <span class="badge bg-primary mb-1">Tú</span>
                                <div class="p-3 bg-primary text-white shadow-sm" style="word-break: break-word; border-radius: 16px; border-bottom-right-radius: 4px; font-size: 0.95rem; line-height: 1.5;">
                                    {{ $message->content }}
                                </div>
                            </div>
                        </div>
                        @if($message->response)
                            <div class="mb-3 text-start">
                                <div class="d-inline-block text-start" style="max-width: 75%;">
                                    <span class="badge bg-success mb-1">Asistente</span>
                                    <div class="p-3 bg-light text-dark border" style="word-break: break-word; border-radius: 16px; border-bottom-left-radius: 4px; font-size: 0.95rem; line-height: 1.5;">
                                        @if($message->response->type == 'image')
                                            <img src="{{ asset('storage/' . $message->response->content) }}" class="img-fluid rounded border shadow-sm" style="max-height: 400px;" alt="Respuesta imagen">
                                            <div class="small text-muted mt-1">Imagen relacionada (keywords match)</div>
                                        @elseif($message->response->type == 'pdf')
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bx bxs-file-pdf text-danger fs-3"></i>
                                                <a href="{{ asset('storage/' . $message->response->content) }}" target="_blank" rel="noopener" class="fw-bold text-decoration-none">Abrir PDF</a>
                                            </div>
                                            <div class="small text-muted mt-1">Documento relacionado (keywords match)</div>
                                        @else
                                            {!! nl2br(e($message->response->content)) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Entrada Deshabilitada (Lectura) -->
            <form id="message-form" onsubmit="return false;" style="opacity: 0.65; cursor: not-allowed;">
                @csrf
                <div class="input-group">
                    <textarea id="content" name="content" class="form-control" placeholder="Este chat está cerrado para nuevos mensajes (solo lectura)..." rows="1" disabled style="resize: none; max-height: 120px; overflow-y: auto; border-radius: 8px 0 0 8px; border-right: 0; padding: 12px 16px; background-color: #f1f3f5; cursor: not-allowed;"></textarea>
                    <button type="button" class="btn btn-secondary px-4" disabled style="border-radius: 0 8px 8px 0; cursor: not-allowed;">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatContainer = document.getElementById('chat-messages');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });
</script>
