@extends('layouts.app')

@section('title', $deber->titulo)
@section('page_title', 'Detalle del deber')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('deberes.index') }}">Deberes</a></li>
    <li class="breadcrumb-item active">{{ \Illuminate\Support\Str::limit($deber->titulo, 35) }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
                        <div>
                            <span class="deber-badge deber-badge-{{ $deber->materia_color }} mb-2">
                                <i class="uil {{ $deber->materia_icon }} me-1"></i>{{ $deber->materia_label }}
                            </span>
                            <h4 class="mb-1">{{ $deber->titulo }}</h4>
                            <p class="text-muted mb-0">
                                Subido el {{ $deber->created_at->format('d/m/Y') }} a las
                                {{ $deber->created_at->format('H:i') }}
                            </p>
                        </div>
                        <a href="{{ route('deberes.download', $deber) }}" class="btn btn-primary">
                            <i class="uil uil-download-alt me-1"></i> Descargar
                        </a>
                    </div>

                    <hr>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="deber-meta-label">Estudiante</div>
                            <div class="deber-meta-value">{{ $deber->estudiante }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="deber-meta-label">Archivo</div>
                            <div class="deber-meta-value">
                                {{ $deber->nombre_original }} ({{ $deber->tamano_humano }})
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="deber-meta-label">Descripción</div>
                            <div class="deber-meta-value">
                                {{ $deber->descripcion ?: 'Sin descripción.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Vista previa</h5>

                    @if ($deber->esImagen())
                        <img src="{{ route('deberes.preview', $deber) }}" alt="{{ $deber->titulo }}"
                            class="img-fluid rounded border">
                    @elseif ($deber->esPdf() || in_array($deber->extension, ['txt', 'py', 'js', 'html', 'css', 'php', 'json', 'md']))
                        <iframe src="{{ route('deberes.preview', $deber) }}" class="deber-preview-frame"
                            title="Vista previa del archivo"></iframe>
                    @else
                        <div class="text-center py-4">
                            <div class="deber-empty-icon mb-3">
                                <i class="uil uil-file-alt"></i>
                            </div>
                            <p class="text-muted mb-3">
                                No hay vista previa disponible para este tipo de archivo.
                            </p>
                            <a href="{{ route('deberes.download', $deber) }}" class="btn btn-outline-primary">
                                <i class="uil uil-download-alt me-1"></i> Descargar archivo
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Información del archivo</h5>

                    <div class="d-flex align-items-center mb-3">
                        <span class="deber-file-icon me-3">
                            <i class="uil uil-file-alt"></i>
                        </span>
                        <div class="overflow-hidden">
                            <div class="fw-semibold text-truncate">{{ $deber->nombre_original }}</div>
                            <div class="text-muted font-size-12 text-uppercase">
                                {{ $deber->extension }} · {{ $deber->tamano_humano }}
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('deberes.download', $deber) }}" class="btn btn-primary">
                            <i class="uil uil-download-alt me-1"></i> Descargar
                        </a>
                        <a href="{{ route('deberes.preview', $deber) }}" target="_blank"
                            class="btn btn-outline-secondary">
                            <i class="uil uil-eye me-1"></i> Abrir en nueva pestaña
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Acciones</h5>

                    <form action="{{ route('deberes.destroy', $deber) }}" method="POST"
                        onsubmit="return confirm('¿Eliminar este deber? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="uil uil-trash me-1"></i> Eliminar deber
                        </button>
                    </form>

                    <a href="{{ route('deberes.index') }}" class="btn btn-light w-100 mt-2">
                        <i class="uil uil-arrow-left me-1"></i> Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
