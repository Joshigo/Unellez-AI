

@extends('layout.main')
@section('title', 'Editar Usuario')

@section('content')
<section class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>Editar Usuario</b></h3>
                    </div>
                    <div class="card-body">
                        <form id="userForm" method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center">
                                <div class="col-md-5 m-2">
                                    <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ $user->name }}" required>
                                </div>
                                <div class="col-md-5 m-2">
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" required>
                                </div>
                                <div class="col-md-5 m-2">
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                                    <small class="form-text text-muted">Deja el campo vacío si no quieres cambiar la contraseña.</small>
                                </div>
                                <div class="col-md-5 m-2">
                                    <select name="role_id" class="form-control" required>
                                        <option value="">Selecciona Rol</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 m-2">
                                    <select name="program_id" class="form-control" required>
                                        <option value="">Selecciona Rol</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}" {{ $user->program_id == $program->id ? 'selected' : '' }}>
                                                {{ $program->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 m-2">
                                    <a href="{{ route('users.index') }}" class="btn btn-primary w-100">Regresar</a>
                                </div>
                                <div class="col-md-3 m-2">
                                    <button type="submit" class="btn btn-success w-100">Actualizar</button>
                                </div>
                            </div>
                            <div id="form-messages" class="mt-3"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
@endsection

@endsection
