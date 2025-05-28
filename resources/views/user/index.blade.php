@extends('layouts.main')
@section('title', 'Crear Usuario')
<style>
    .custom-dropzone {
        border: 2px dashed #007bff;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        color: #007bff;
        cursor: pointer;
        transition: background 0.3s;
    }

    .custom-dropzone.dragover {
        background-color: #e9f5ff;
    }

    .custom-dropzone img {
        margin-top: 15px;
        max-width: 250px;
        border-radius: 5px;
    }

    .custom-dropzone input[type="file"] {
        display: none;
    }
</style>
@section('content')
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div> --}}


    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Crear Usuario</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>


                            <div class="col-md-3 mb-3">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="document" class="form-label">Documento de identificación</label>
                                <input type="text" class="form-control" id="document" name="document" required>
                            </div>


                            <div class="col-md-4 mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="role" class="form-label">Rol</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">Seleccionar Rol</option>
                                    <option value="admin">Admin</option>
                                    <option value="seller">Vendedor</option>
                                </select>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Avatar</label>

                            <div class="custom-dropzone" id="dropzone">
                                <p>Arrastra tu archivo aquí o hacé clic para seleccionar</p>
                                <input type="file" id="fileInput" name="image" accept="image/*">
                                <div id="previewContainer"></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listado de Clientes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Selfie</th>
                            <th>Documento</th>
                            <th>Telefono</th>
                            <th>Estatus</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td class="text-center align-middle">
                                @if ($user->image)
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="" width="80">
                                @else
                                    <span>No hay imagen registrada</span>
                                @endif
                            </td>
                            <td>{{$user->document}}</td>
                            <td>{{$user->phone}}</td>
                            <td class="text-center align-middle">
                                <form action="{{ route('users.change_status', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $user->status == 'active' ? 'btn-danger' : 'btn-success' }}">
                                        {{ $user->status == 'active' ? 'Inactivar' : 'Activar' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach


                </table>
            </div>
        </div>
    </div>

    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('previewContainer');
        dropzone.addEventListener('click', () => {
            fileInput.click();
        });
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('dragover');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file) {
                showPreview(file);
            }
        });
        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                showPreview(file);
            }
        });

        function showPreview(file) {
            if (!file.type.startsWith('image/')) {
                previewContainer.innerHTML = `<p style="color:red;">Solo se permiten imágenes.</p>`;
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="preview">`;
            };
            reader.readAsDataURL(file);
        }
    </script>
    @endsection
