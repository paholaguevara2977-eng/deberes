@extends('layouts.app')

@section('title', 'Subir deber')
@section('page_title', 'Subir un nuevo deber')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('deberes.index') }}">Deberes</a></li>
    <li class="breadcrumb-item active">Subir deber</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-1">Datos del deber</h4>
                    <p class="text-muted mb-4">Completa la información y adjunta el archivo de tu tarea.</p>

                    <form action="{{ route('deberes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Título del deber <span class="text-danger">*</span></label>
                                <input type="text" name="titulo" value="{{ old('titulo') }}"
                                    class="form-control @error('titulo') is-invalid @enderror"
                                    placeholder="Ej. Ejercicios de derivadas" autofocus>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Materia <span class="text-danger">*</span></label>
                                <select name="materia" class="form-select @error('materia') is-invalid @enderror">
                                    <option value="">Selecciona...</option>
                                    <option value="computacion" @selected(old('materia') === 'computacion')>Computación</option>
                                    <option value="matematica" @selected(old('materia') === 'matematica')>Matemática</option>
                                </select>
                                @error('materia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-8">
                                <label class="form-label">Estudiante <span class="text-danger">*</span></label>
                                <input type="text" name="estudiante" value="{{ old('estudiante') }}"
                                    class="form-control @error('estudiante') is-invalid @enderror"
                                    placeholder="Nombre y apellido">
                                @error('estudiante')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Descripción <span class="text-muted">(opcional)</span></label>
                                <textarea name="descripcion" rows="4" class="form-control @error('descripcion') is-invalid @enderror"
                                    placeholder="Describe brevemente el contenido del deber...">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Archivo <span class="text-danger">*</span></label>
                                <div class="deber-upload-zone" id="deber-drop-zone">
                                    <i class="uil uil-cloud-upload font-size-36 text-primary"></i>
                                    <p class="mb-1 fw-medium mt-2">Haz clic o arrastra tu archivo aquí</p>
                                    <p class="text-muted mb-0 font-size-12">
                                        PDF, Word, Excel, PowerPoint, imágenes, TXT, ZIP o RAR · máximo 20 MB
                                    </p>
                                    <input type="file" name="archivo" id="archivo"
                                        class="deber-file-input @error('archivo') is-invalid @enderror"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar,.jpg,.jpeg,.png,.gif,.webp">
                                </div>
                                <div id="deber-file-name" class="mt-2 font-size-13"></div>
                                @error('archivo')
                                    <div class="text-danger font-size-13 mt-1">
                                        <i class="uil uil-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('deberes.index') }}" class="btn btn-light">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="uil uil-upload me-1"></i> Subir deber
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Consejos</h5>

                    <div class="d-flex mb-3">
                        <span class="deber-stat-icon deber-soft-primary me-3">
                            <i class="uil uil-file-check-alt font-size-20"></i>
                        </span>
                        <div>
                            <h6 class="mb-1">Formatos permitidos</h6>
                            <p class="text-muted mb-0 font-size-13">
                                PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, ZIP, RAR e imágenes.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <span class="deber-stat-icon deber-soft-success me-3">
                            <i class="uil uil-weight font-size-20"></i>
                        </span>
                        <div>
                            <h6 class="mb-1">Tamaño máximo</h6>
                            <p class="text-muted mb-0 font-size-13">Hasta 20 MB por archivo.</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <span class="deber-stat-icon deber-soft-warning me-3">
                            <i class="uil uil-lightbulb-alt font-size-20"></i>
                        </span>
                        <div>
                            <h6 class="mb-1">Nombre claro</h6>
                            <p class="text-muted mb-0 font-size-13">
                                Usa un título descriptivo para encontrar tu deber fácilmente.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Materias</h5>

                    <div class="d-flex align-items-center mb-3">
                        <span class="deber-stat-icon deber-soft-primary me-3">
                            <i class="uil uil-desktop font-size-20"></i>
                        </span>
                        <div>
                            <h6 class="mb-0">Computación</h6>
                            <p class="text-muted mb-0 font-size-13">Programación, bases de datos, web...</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <span class="deber-stat-icon deber-soft-success me-3">
                            <i class="uil uil-calculator font-size-20"></i>
                        </span>
                        <div>
                            <h6 class="mb-0">Matemática</h6>
                            <p class="text-muted mb-0 font-size-13">Álgebra, cálculo, probabilidad...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var zone = document.getElementById('deber-drop-zone');
            var input = document.getElementById('archivo');
            var fileName = document.getElementById('deber-file-name');

            if (!zone || !input) {
                return;
            }

            zone.addEventListener('click', function() {
                input.click();
            });

            input.addEventListener('change', function() {
                mostrarArchivo(input.files[0]);
            });

            ['dragenter', 'dragover'].forEach(function(evento) {
                zone.addEventListener(evento, function(event) {
                    event.preventDefault();
                    zone.classList.add('deber-dragover');
                });
            });

            ['dragleave', 'drop'].forEach(function(evento) {
                zone.addEventListener(evento, function(event) {
                    event.preventDefault();
                    zone.classList.remove('deber-dragover');
                });
            });

            zone.addEventListener('drop', function(event) {
                if (event.dataTransfer.files.length > 0) {
                    input.files = event.dataTransfer.files;
                    mostrarArchivo(input.files[0]);
                }
            });

            function mostrarArchivo(file) {
                if (!file) {
                    fileName.textContent = '';
                    return;
                }

                var kb = file.size / 1024;
                var tamano = kb >= 1024 ? (kb / 1024).toFixed(2) + ' MB' : kb.toFixed(1) + ' KB';

                fileName.innerHTML = '<i class="uil uil-file-check-alt text-success me-1"></i>' +
                    '<strong>' + file.name + '</strong> ' +
                    '<span class="text-muted">(' + tamano + ')</span>';
            }
        });
    </script>
@endpush
