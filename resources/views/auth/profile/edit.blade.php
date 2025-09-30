@extends('layout.main')
@section('title', 'Editar Perfil')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password">Password (leave blank to keep current)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary mt-4">Update Profile</button>
                    </form>
                </div>
            </div>

            @if($user->role_id == 1)
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="card-title">Editar Credenciales de Usuarios</h3>
                    </div>
                    <div class="card-body">
                        <form id="admin-edit-user-form" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="selected_user">Seleccionar Usuario</label>
                                <select id="selected_user" name="selected_user" class="form-control" required>
                                    <option value="">-- Selecciona un usuario --</option>
                                    @foreach(\App\Models\User::orderBy('name')->get() as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="search_user">Buscar Usuario</label>
                                <input type="text" id="search_user" class="form-control" autocomplete="off" placeholder="Nombre, email o programa">
                                <div id="search_suggestions" class="list-group" style="position: absolute; z-index: 1000; width: 100%;"></div>
                            </div>
                            <div id="user-fields" >
                                <div class="form-group mb-2">
                                    <label for="edit_name">Nombre</label>
                                    <input type="text" name="name" id="edit_name" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="edit_ci">CI</label>
                                    <input type="text" name="ci" id="edit_ci" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="edit_email">Email</label>
                                    <input type="email" name="email" id="edit_email" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="edit_password">Password (dejar vacío para no cambiar)</label>
                                        <input type="password" name="password" id="edit_password" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="edit_password_confirmation">Confirmar Password</label>
                                        <input type="password" name="password_confirmation" id="edit_password_confirmation" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Actualizar Usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    @if($user->role_id == 1)
    const fields = document.getElementById('user-fields');
    fields.style.display = 'none';

    const searchInput = document.getElementById('search_user');
    const suggestions = document.getElementById('search_suggestions');
    const form = document.getElementById('admin-edit-user-form');

    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        if (query.length < 2) {
            suggestions.innerHTML = '';
            return;
        }
        fetch("{{ route('users.search') }}?query=" + encodeURIComponent(query), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.text())
        .then(html => {
            // Parse users from the returned HTML (assuming you return a partial with users)
            // For simplicity, let's assume you return a JSON array of users
            try {
                const users = JSON.parse(html);
                suggestions.innerHTML = '';
                users.forEach(u => {
                    const item = document.createElement('button');
                    item.type = 'button';
                    item.className = 'list-group-item list-group-item-action';
                    item.textContent = `${u.name} (${u.email})`;
                    item.onclick = function() {
                        fillUserForm(u);
                        suggestions.innerHTML = '';
                        searchInput.value = u.name;
                    };
                    suggestions.appendChild(item);
                });
            } catch {
                suggestions.innerHTML = '';
            }
        });
    });

    function fillUserForm(u) {
        fields.style.display = '';
        document.getElementById('edit_name').value = u.name;
        document.getElementById('edit_ci').value = u.ci ?? '';
        document.getElementById('edit_email').value = u.email;
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_password_confirmation').value = '';
        form.action = "{{ url('users') }}/" + u.id;
    }

    // Opcional: Oculta sugerencias al hacer click fuera
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestions.contains(e.target)) {
            suggestions.innerHTML = '';
        }
    });
    @endif
</script>
@endsection
