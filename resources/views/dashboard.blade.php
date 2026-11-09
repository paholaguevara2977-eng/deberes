@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="card border-0 hero-deber mb-4">
        <div class="card-body p-4 p-lg-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-white text-primary mb-3">Plataforma de deberes</span>
                    <h2 class="text-white mb-3">Sube y organiza tus deberes de Computación y Matemática</h2>
                    <p class="text-white-50 mb-4">
                        Guarda tus tareas en un solo lugar, consulta el historial y descarga tus archivos
                        cuando los necesites.
                    </p>
                    <a href="{{ route('deberes.create') }}" class="btn btn-light btn-lg">
                        <i class="uil uil-upload me-1"></i> Subir un deber
                    </a>
                    <a href="{{ route('deberes.index') }}" class="btn btn-outline-light btn-lg ms-2">
                        Ver todos
                    </a>
                </div>
                <div class="col-lg-4 d-none d-lg-block text-center">
                    <i class="uil uil-book-open text-white" style="font-size: 7rem; opacity: .85;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="deber-stat-icon deber-soft-primary me-3">
                            <i class="uil uil-files-landscapes font-size-22"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Total de deberes</p>
                            <h3 class="mb-0">{{ $total }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="deber-stat-icon deber-soft-primary me-3">
                            <i class="uil uil-desktop font-size-22"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Computación</p>
                            <h3 class="mb-0">{{ $computacion }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="deber-stat-icon deber-soft-success me-3">
                            <i class="uil uil-calculator font-size-22"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Matemática</p>
                            <h3 class="mb-0">{{ $matematica }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="deber-stat-icon deber-soft-warning me-3">
                            <i class="uil uil-calendar-alt font-size-22"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Este mes</p>
                            <h3 class="mb-0">{{ $esteMes }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Deberes por materia</h4>
                        <a href="{{ route('deberes.create') }}" class="btn btn-sm btn-primary">
                            <i class="uil uil-plus me-1"></i> Nuevo deber
                        </a>
                    </div>
                    <div id="chart-materias"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Acceso rápido</h4>

                    <a href="{{ route('deberes.index', ['materia' => 'computacion']) }}"
                        class="d-flex align-items-center text-reset text-decoration-none p-2 rounded mb-2 hero-quick-link">
                        <span class="deber-stat-icon deber-soft-primary me-3">
                            <i class="uil uil-desktop font-size-22"></i>
                        </span>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Computación</h6>
                            <p class="text-muted mb-0 font-size-13">{{ $computacion }} deberes</p>
                        </div>
                        <i class="uil uil-angle-right-b font-size-20 text-muted"></i>
                    </a>

                    <a href="{{ route('deberes.index', ['materia' => 'matematica']) }}"
                        class="d-flex align-items-center text-reset text-decoration-none p-2 rounded hero-quick-link">
                        <span class="deber-stat-icon deber-soft-success me-3">
                            <i class="uil uil-calculator font-size-22"></i>
                        </span>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Matemática</h6>
                            <p class="text-muted mb-0 font-size-13">{{ $matematica }} deberes</p>
                        </div>
                        <i class="uil uil-angle-right-b font-size-20 text-muted"></i>
                    </a>

                    <hr>

                    <a href="{{ route('deberes.create') }}" class="btn btn-outline-primary w-100">
                        <i class="uil uil-cloud-upload me-1"></i> Subir un deber
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Últimos deberes subidos</h4>
                        <a href="{{ route('deberes.index') }}" class="btn btn-sm btn-link">
                            Ver todos <i class="uil uil-arrow-right"></i>
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
                                @forelse ($recientes as $deber)
                                    <tr>
                                        <td>
                                            <a href="{{ route('deberes.show', $deber) }}"
                                                class="text-dark fw-semibold">{{ $deber->titulo }}</a>
                                            @if ($deber->descripcion)
                                                <div class="text-muted font-size-12 text-truncate"
                                                    style="max-width: 280px;">{{ $deber->descripcion }}</div>
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
                                            <a href="{{ route('deberes.show', $deber) }}"
                                                class="btn btn-sm btn-outline-primary" title="Ver">
                                                <i class="uil uil-eye"></i>
                                            </a>
                                            <a href="{{ route('deberes.download', $deber) }}"
                                                class="btn btn-sm btn-outline-success" title="Descargar">
                                                <i class="uil uil-download-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center py-4">
                                                <div class="deber-empty-icon mb-3">
                                                    <i class="uil uil-folder-open"></i>
                                                </div>
                                                <h5 class="mb-1">Todavía no hay deberes</h5>
                                                <p class="text-muted mb-3">Sube tu primer deber para comenzar.</p>
                                                <a href="{{ route('deberes.create') }}" class="btn btn-primary">
                                                    <i class="uil uil-upload me-1"></i> Subir deber
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chartElement = document.querySelector('#chart-materias');

            if (chartElement && typeof ApexCharts !== 'undefined') {
                new ApexCharts(chartElement, {
                    series: [{{ $computacion }}, {{ $matematica }}],
                    chart: {
                        type: 'donut',
                        height: 330
                    },
                    labels: ['Computación', 'Matemática'],
                    colors: ['#556ee6', '#34c38f'],
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '62%'
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true
                    },
                    noData: {
                        text: 'Sin datos todavía'
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 260
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                }).render();
            }
        });
    </script>
@endpush
