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
    </div>
</div>
@endsection

@section('scripts')
<!-- Si necesitas scripts adicionales -->
@endsection
