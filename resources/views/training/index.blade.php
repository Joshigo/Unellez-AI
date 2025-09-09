@extends('layout.main')
@section('title', 'Usuarios')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Enseñar a la inteligencia artificial</b></h3>
                    <p class="card-text">En esta sección podrás enseñarle a la inteligencia artificial a responder preguntas sobre el programa. Para ello, debes proporcionarle ejemplos de preguntas y respuestas que consideres relevantes.</p>
                </div>
                <div class="card-body">
                    <!-- Pestañas para seleccionar tipo de archivo -->
                    <ul class="nav nav-tabs mb-4" id="uploadTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pdf-tab" data-bs-toggle="tab" data-bs-target="#pdf" type="button" role="tab">
                                <i class="fas fa-file-pdf me-2"></i> Subir PDF
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab">
                                <i class="fas fa-image me-2"></i> Subir Imagen
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="uploadTabContent">
                        <!-- Formulario para PDF -->
                        <div class="tab-pane fade show active" id="pdf" role="tabpanel">
                        <form action="{{route('trainings.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="pdf">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Seleccionar archivo PDF</label>
                                        <input class="form-control" type="file" id="file" name="file" accept=".pdf" required>
                                        @error('file')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Sube un archivo PDF que contenga ejemplos de preguntas y respuestas
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-upload me-2"></i> Subir PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                        <!-- Formulario para Imágenes -->
                        <div class="tab-pane fade" id="image" role="tabpanel">
                            <form id="imageUploadForm" action="{{route('trainings.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="imageFile" class="form-label">Seleccionar imagen</label>
                                            <input class="form-control" type="file" id="imageFile" name="file" accept="image/*" required>
                                            @error('file')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                Sube una imagen para extraer información (ej: horarios universitarios)
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="type" class="form-label">Tipo de imagen</label>
                                            <select class="form-select" id="type" name="type" required>
                                                <option value="schedule">Horario Universitario</option>
                                                <!-- Agregar más opciones aquí en el futuro -->
                                            </select>
                                            @error('type')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Keywords (string) -->
                                        <div class="mb-3">
                                            <label for="keywords" class="form-label">Palabras clave (separadas por comas)</label>
                                            <input type="text" name="keywords" id="keywords" class="form-control" placeholder="Ej: horario, ingenieria, semestre 1, seccion A" value="{{ old('keywords') }}">
                                            @error('keywords')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                Ingresa las palabras clave separadas por comas. Se limpiarán y normalizarán automáticamente.
                                            </div>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-upload me-2"></i> Procesar Imagen
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Lista de Entrenamientos Implementados</b></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="trainingsTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-uppercase">Nombre</th>
                                    <th class="text-uppercase">Tipo</th>
                                    <th class="text-uppercase">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trainings as $training)
                                    <tr>
                                        <td>{{ $training->name }}</td>
                                        <td>{{ $training->type }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#pdfModal{{ $training->id }}">
                                                <i class='bx bx-show'></i>
                                            </button>
                                            <form action="{{ route('trainings.destroy', $training->id) }}" method="POST" class="d-inline">
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
            </div>
        </div>
    </div>
</div>
@foreach($trainings as $training)
<div class="modal fade" id="pdfModal{{ $training->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vista Previa: {{ $training->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($training->type === 'schedule')
                    <img src="{{ asset('storage/' . $training->file_path) }}"
                         alt="{{ $training->name }}"
                         class="img-fluid">
                @else
                    <embed src="{{ asset('storage/' . $training->file_path) }}"
                           type="application/pdf"
                           width="100%"
                           height="600px">
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('scripts')
<script>
    // Activar pestañas y mantener estado
    document.addEventListener('DOMContentLoaded', function() {
        const uploadTab = document.getElementById('uploadTab');
        const tabButtons = uploadTab.querySelectorAll('button[data-bs-toggle="tab"]');

        tabButtons.forEach(tabButton => {
            tabButton.addEventListener('click', function() {
                const target = this.getAttribute('data-bs-target');
                localStorage.setItem('activeUploadTab', target);
            });
        });

        // Recuperar pestaña activa
        const activeTab = localStorage.getItem('activeUploadTab');
        if (activeTab) {
            const tab = new bootstrap.Tab(document.querySelector(`[data-bs-target="${activeTab}"]`));
            tab.show();
        }

    });
</script>
@endsection
