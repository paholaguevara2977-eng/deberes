@extends('layouts.app')

@section('title', 'Deberes')
@section('page_title', 'Listado de deberes')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Deberes</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('deberes.index') }}" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label">Buscar</label>
                    <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control"
                        placeholder="Título, estudiante o descripción">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Materia</label>
                    <select name="materia" class="form-select">
                        <option value="">Todas las materias</option>
                        <option value="computacion" @selected(request('materia') === 'computacion')>Computación</option>
                        <option value="matematica" @selected(request('materia') === 'matematica')>Matemática</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="uil uil-search me-1"></i> Filtrar
                    </button>
                    @if (request()->hasAny(['buscar', 'materia']))
                        <a href="{{ route('deberes.index') }}" class="btn btn-light" title="Limpiar filtros">
                            <i class="uil uil-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="card-title mb-0">Deberes registrados</h4>
                    <p class="text-muted mb-0 font-size-13">
                        {{ $deberes->total() }} {{ $deberes->total() === 1 ? 'deber encontrado' : 'deberes encontrados' }}
                    </p>
                </div>
                <a href="{{ route('deberes.create') }}" class="btn btn-primary">
                    <i class="uil uil-plus me-1"></i> Subir deber
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-deberes mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Deber</th>
                            <th>Materia</th>
                            <th>Estudiante</th>
                            <th>Archivo</th>
                            <th>Fecha</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($deberes as $deber)
                            <tr>
                                <td>
                                    <a href="{{ route('deberes.show', $deber) }}"
                                        class="text-dark fw-semibold">{{ $deber->titulo }}</a>
                                    @if ($deber->descripcion)
                                        <div class="text-muted font-size-12 text-truncate" style="max-width: 300px;">
                                            {{ $deber->descripcion }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="deber-badge deber-badge-{{ $deber->materia_color }}">
                                        <i class="uil {{ $deber->materia_icon }} me-1"></i>{{ $deber->materia_label }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="deber-avatar-initial me-2">{{ mb_substr($deber->estudiante, 0, 1) }}</span>
                                        <span>{{ $deber->estudiante }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-uppercase font-size-12 fw-medium">{{ $deber->extension }}</span>
                                    <span class="text-muted font-size-12 ms-2">{{ $deber->tamano_humano }}</span>
                                </td>
                                <td class="text-muted">{{ $deber->created_at->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('deberes.show', $deber) }}" class="btn btn-sm btn-outline-primary"
                                        title="Ver">
                                        <i class="uil uil-eye"></i>
                                    </a>
                                    <a href="{{ route('deberes.download', $deber) }}"
                                        class="btn btn-sm btn-outline-success" title="Descargar">
                                        <i class="uil uil-download-alt"></i>
                                    </a>
                                    <form action="{{ route('deberes.destroy', $deber) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Eliminar este deber? Esta acción no se puede deshacer.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                            <i class="uil uil-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="text-center py-5">
                                        <div class="deber-empty-icon mb-3">
                                            <i class="uil uil-folder-open"></i>
                                        </div>
                                        <h5 class="mb-1">No se encontraron deberes</h5>
                                        <p class="text-muted mb-3">
                                            @if (request()->hasAny(['buscar', 'materia']))
                                                Prueba con otros filtros o limpia la búsqueda.
                                            @else
                                                Sube tu primer deber para comenzar.
                                            @endif
                                        </p>
                                        @if (request()->hasAny(['buscar', 'materia']))
                                            <a href="{{ route('deberes.index') }}" class="btn btn-light">
                                                <i class="uil uil-times me-1"></i> Limpiar filtros
                                            </a>
                                        @else
                                            <a href="{{ route('deberes.create') }}" class="btn btn-primary">
                                                <i class="uil uil-upload me-1"></i> Subir deber
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($deberes->hasPages())
                <div class="mt-4">
                    {{ $deberes->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
