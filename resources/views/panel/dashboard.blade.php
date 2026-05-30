@extends('layout.main')
@section('title', 'Pagina principal')
<style>
    .chart-container {
        margin-top: 20px;
    }

    .avatar {
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }

    .avatar-content {
        font-size: 1.2rem;
    }

    .bg-light-primary {
        background-color: rgba(79, 70, 229, 0.1);
    }

    .bg-light-success {
        background-color: rgba(16, 185, 129, 0.1);
    }

    .bg-light-info {
        background-color: rgba(139, 92, 246, 0.1);
    }

    .bg-light-warning {
        background-color: rgba(245, 158, 11, 0.1);
    }

    .mascot-welcome-img {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .mascot-welcome-img:hover {
        transform: scale(1.15) rotate(4deg);
        filter: drop-shadow(0 16px 28px rgba(105, 108, 255, 0.35)) !important;
    }
    @keyframes welcomeFloat {
        from {
            transform: translateY(0px);
        }
        to {
            transform: translateY(-12px);
        }
    }
</style>
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    @if(isset($user) && $user->role_id == 2)
        <h4 class="fw-bold py-3 mb-4">Dashboard de Coordinación</h4>

        <div class="row">
            <!-- Tarjeta de Resumen Rápido -->
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Mensajes generados en chats de Hoy</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h4 class="mb-0 me-2">{{ $messagesInChatsTodayCount ?? 0 }}</h4>
                                </div>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="bx bx-message-alt-detail bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Chats Totales por Programa -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Chats Totales por Programa</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse($countChatsByPrograms as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $item->program_name }}
                                    <span class="badge bg-primary">{{ $item->quantity }}</span>
                                </li>
                            @empty
                                <li class="list-group-item">No hay registros</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Chats de Hoy por Programa -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Chats de Hoy por Programa</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse($chatsTodayByProgram as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $item->program_name }}
                                    <span class="badge bg-success">{{ $item->quantity }}</span>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Sin actividad hoy</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Estudiantes por Programa -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Estudiantes (Rol 4)</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse($usersRole4ByProgram as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $item->program_name }}
                                    <span class="badge bg-info">{{ $item->quantity }}</span>
                                </li>
                            @empty
                                <li class="list-group-item">No hay estudiantes registrados</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @elseif(isset($user) && $user->role_id == 3)
        <h4 class="fw-bold py-3 mb-4">Pagina principal de Jefatura de Programa</h4>

        <div class="row">
            <!-- Tarjeta de Estudiantes (Rol 4) -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Estudiantes (Mismo Programa)</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h4 class="mb-0 me-2">{{ $studentCount ?? 0 }}</h4>
                                </div>
                            </div>
                            <span class="badge bg-label-info rounded p-2">
                                <i class="bx bx-user bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Chats -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Chats de Estudiantes</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h4 class="mb-0 me-2">{{ $totalChats ?? 0 }}</h4>
                                </div>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="bx bx-chat bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <h5 class="my-4">Actividad de Hoy (Estudiantes)</h5>

            <!-- Chats Hoy -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-chat"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $chatsToday ?? 0 }}</h4>
                        </div>
                        <p class="mb-1">Chats iniciados Hoy</p>
                    </div>
                </div>
            </div>

            <!-- Mensajes Hoy -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-envelope"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $messagesToday ?? 0 }}</h4>
                        </div>
                        <p class="mb-1">Mensajes enviados Hoy</p>
                    </div>
                </div>
            </div>

            <!-- Respuestas Hoy -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-bot"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $responsesToday ?? 0 }}</h4>
                        </div>
                        <p class="mb-1">Respuestas generadas Hoy</p>
                    </div>
                </div>
            </div>
        </div>
    @elseif(isset($user) && $user->role_id == 4)
        <div class="row justify-content-center align-items-center my-4" style="min-height: 70vh;">
            <div class="col-12 col-md-10 col-lg-8 text-center">
                <div class="card border-0 shadow-lg p-4 position-relative overflow-hidden" style="border-radius: 20px; background: linear-gradient(145deg, #ffffff 0%, #f4f6fc 100%);">
                    <!-- Glassmorphism decorative radial glows in background -->
                    <div class="position-absolute" style="width: 250px; height: 250px; background: radial-gradient(circle, rgba(105, 108, 255, 0.06) 0%, rgba(255, 255, 255, 0) 70%); top: -100px; right: -100px; pointer-events: none;"></div>
                    <div class="position-absolute" style="width: 200px; height: 200px; background: radial-gradient(circle, rgba(3, 195, 236, 0.06) 0%, rgba(255, 255, 255, 0) 70%); bottom: -80px; left: -80px; pointer-events: none;"></div>

                    <div class="card-body py-4 position-relative">
                        <!-- Animated Bot Mascot -->
                        <div class="mb-4">
                            <img src="{{ asset('bot-center_blue.png') }}" class="img-fluid mascot-welcome-img" alt="Unellez AI Mascot" style="max-width: 200px; filter: drop-shadow(0 12px 20px rgba(105, 108, 255, 0.25)); animation: welcomeFloat 4s ease-in-out infinite alternate;">
                        </div>

                        <!-- Greeting -->
                        <h3 class="fw-bold mb-2 text-primary">¡Hola, {{ auth()->user()->name ?? 'Estudiante' }}!</h3>
                        <h5 class="text-dark fw-semibold mb-4">Te damos la bienvenida a <span class="text-primary fw-bold">Unellez AI</span></h5>

                        <!-- Explanatory Text -->
                        <p class="text-secondary px-md-3 mb-4" style="font-size: 1.05rem; line-height: 1.6;">
                            Tu asistente virtual inteligente está aquí para ayudarte. Diseñado específicamente para responder todas tus inquietudes académicas relacionadas con tu <strong>programa de formación</strong>.
                        </p>

                        <div class="alert alert-primary bg-label-primary border-0 d-flex align-items-center justify-content-center p-3 mb-4 rounded-3" role="alert" style="font-size: 0.92rem; max-width: 600px; margin: 0 auto 1.5rem auto;">
                            <i class="bx bx-info-circle me-2 fs-4" style="flex-shrink: 0;"></i>
                            <div class="text-start">
                                Este sistema interactúa contigo utilizando la información oficial suministrada y autorizada por los <strong>Jefes de tu Programa</strong> de formación.
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="d-grid gap-2 col-md-8 mx-auto">
                            <a href="{{ route('chats.create') }}" class="btn btn-primary btn-lg shadow-sm d-flex align-items-center justify-content-center gap-2" style="border-radius: 10px; transition: all 0.3s ease;">
                                <i class="bx bx-message-square-add fs-4"></i>
                                <span>Iniciar nueva consulta</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>


@endsection
