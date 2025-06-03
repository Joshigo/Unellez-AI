@extends('layout.main')
@section('title', 'Usuarios')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Formulario para agregar usuario -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Crear Usuario</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-5 m-2">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="col-md-5 m-2">
                                <input type="number" name="ci" id="ci" class="form-control" placeholder="Cédula" required>
                            </div>
                            <div class="col-md-5 m-2">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-md-5 m-2">
                                <select name="role_id" id="role_id"  class="form-control" required>
                                    <option value="">Selecciona un rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5 m-2">
                                <select name="program_id" class="form-control" required>
                                    <option value="">Selecciona un programa</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5 m-2">
                                <button type="submit" class="btn btn-primary w-100">Crear</button>
                            </div>
                        </div>
                        <div id="form-messages" class="mt-3"></div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Lista de usuarios -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Lista de usuarios</b></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-uppercase">Nombre</th>
                                    <th class="text-uppercase">Cédula</th>
                                    <th class="text-uppercase">Email</th>
                                    <th class="text-uppercase">Programa</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr data-userser-id="{{ $user->id }}">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->ci }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->program->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success" title="Edit">
                                                <i class='bx bx-pencil'></i>
                                            </a>

                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-delete" title="Delete">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        @if ($users->onFirstPage())
                            <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}">&laquo;</a></li>
                        @endif

                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($users->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Lista de entrenadores -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Lista de entrenadores</b></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-uppercase">Nombre</th>
                                    <th class="text-uppercase">Cédula</th>
                                    <th class="text-uppercase">Email</th>
                                    <th class="text-uppercase">Programa</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trainers as $trainer)
                                    <tr data-userser-id="{{ $trainer->id }}">
                                        <td>{{ $trainer->name }}</td>
                                        <td>{{ $trainer->ci }}</td>
                                        <td>{{ $trainer->email }}</td>
                                        <td>{{ $trainer->program->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('users.edit', $trainer->id) }}" class="btn btn-success" title="Edit">
                                                <i class='bx bx-pencil'></i>
                                            </a>

                                            <form action="{{ route('users.destroy', $trainer->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-delete" title="Delete">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        @if ($trainers->onFirstPage())
                            <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $trainers->previousPageUrl() }}">&laquo;</a></li>
                        @endif

                        @foreach ($trainers->getUrlRange(1, $trainers->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $trainers->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($trainers->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $trainers->nextPageUrl() }}">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@endsection
@endsection
