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
                    <form action="{{route('trainings.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="pdf" class="form-label">Seleccionar archivo PDF</label>
                                    <input class="form-control" type="file" id="pdf" name="pdf" accept=".pdf" required>
                                    @error('pdf')
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
                                    <th class="text-uppercase">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $trainings as $training)
                                    <tr> 
                                        <td>{{ $training->name }}</td>
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
                <embed src="{{ asset('storage/' . $training->pdf_path) }}" 
                       type="application/pdf" 
                       width="100%" 
                       height="600px">
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
@endsection
