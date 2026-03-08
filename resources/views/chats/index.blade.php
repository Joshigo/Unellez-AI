@extends('layout.main')

@section('title', 'Monitoreo de Chats')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Chats /</span> Monitoreo
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Usuarios y Chats</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Programa</th>
                                <th>Chats</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($users as $user)
                            <tr>
                                <td>
                                    <strong>{{ $user->name }}</strong><br>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </td>
                                <td>
                                    @if($user->program)
                                        <span class="badge bg-label-primary me-1">{{ $user->program->name }}</span>
                                    @else
                                        <span class="badge bg-label-secondary me-1">Sin Programa</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $user->chats->count() }} Chats</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUser{{ $user->id }}" aria-expanded="false" aria-controls="collapseUser{{ $user->id }}">
                                        Ver Chats
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="p-0 border-0">
                                    <div class="collapse" id="collapseUser{{ $user->id }}">
                                        <div class="p-3 bg-light">
                                            @if($user->chats->count() > 0)
                                                <div class="row">
                                                    @foreach($user->chats as $chat)
                                                    <div class="col-md-4 mb-3">
                                                        <div class="card h-100 border">
                                                            <div class="card-body">
                                                                <h6 class="card-title">{{ $chat->name }}</h6>
                                                                <p class="card-text text-muted small">
                                                                    Creado: {{ $chat->created_at->format('d/m/Y H:i') }}
                                                                </p>
                                                                <a href="{{ route('chats.show', $chat->id) }}" class="btn btn-sm btn-primary">
                                                                    Ver Mensajes
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="alert alert-warning mb-0" role="alert">
                                                    Este usuario no ha iniciado ningún chat.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    No se encontraron usuarios para monitorear.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

