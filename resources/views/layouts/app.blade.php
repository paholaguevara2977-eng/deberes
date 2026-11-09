<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Dashboard') | Deberes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Plataforma para subir deberes de Computación y Matemática" name="description" />
    <meta content="Deberes" name="author" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/unicons-line.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

    @stack('styles')
</head>

<body data-layout="horizontal" data-topbar="colored" data-layout-size="boxed">

    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box">
                        <a href="{{ route('dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <i class="uil uil-book-open"></i>
                            </span>
                            <span class="logo-lg">
                                <i class="uil uil-book-open me-2"></i><b>Deberes</b>
                            </span>
                        </a>
                    </div>

                    <button type="button"
                        class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                        data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <form class="app-search d-none d-lg-block" action="{{ route('deberes.index') }}" method="GET">
                        <div class="position-relative">
                            <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control"
                                placeholder="Buscar deber o estudiante...">
                            <span class="uil-search"></span>
                        </div>
                    </form>
                </div>

                <div class="d-flex align-items-center">
                    <a href="{{ route('deberes.create') }}"
                        class="btn btn-light btn-sm rounded-pill me-3 d-none d-sm-inline-flex align-items-center">
                        <i class="uil uil-plus me-1"></i> Subir deber
                    </a>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt="Usuario">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Estudiante</span>
                            <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('deberes.create') }}">
                                <i class="uil uil-upload font-size-18 align-middle text-muted me-1"></i>
                                <span class="align-middle">Subir deber</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('deberes.index') }}">
                                <i class="uil uil-files-landscapes font-size-18 align-middle text-muted me-1"></i>
                                <span class="align-middle">Todos los deberes</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="topnav">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                        href="{{ route('dashboard') }}">
                                        <i class="uil-home-alt me-2"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('deberes.index') && !request('materia') ? 'active' : '' }}"
                                        href="{{ route('deberes.index') }}">
                                        <i class="uil-files-landscapes me-2"></i> Todos los deberes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request('materia') === 'computacion' ? 'active' : '' }}"
                                        href="{{ route('deberes.index', ['materia' => 'computacion']) }}">
                                        <i class="uil-desktop me-2"></i> Computación
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request('materia') === 'matematica' ? 'active' : '' }}"
                                        href="{{ route('deberes.index', ['materia' => 'matematica']) }}">
                                        <i class="uil-calculator me-2"></i> Matemática
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('deberes.create') ? 'active' : '' }}"
                                        href="{{ route('deberes.create') }}">
                                        <i class="uil-cloud-upload me-2"></i> Subir deber
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">@yield('page_title', 'Dashboard')</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('dashboard') }}">Inicio</a>
                                        </li>
                                        @yield('breadcrumb')
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('partials.flash')

                    @yield('content')
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            {{ date('Y') }} &copy; Deberes.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Hecho con <i class="mdi mdi-heart text-danger"></i> usando Laravel + Minible
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- Opciones de Minible ocultas: app.js espera estos inputs para inicializar el layout --}}
    <div class="d-none" aria-hidden="true">
        <input type="radio" name="layout" id="layout-horizontal" value="horizontal">
        <input type="radio" name="layout" id="layout-vertical" value="vertical">

        <input type="radio" name="layout-mode" id="layout-mode-light" value="light">
        <input type="radio" name="layout-mode" id="layout-mode-dark" value="dark">

        <input type="radio" name="layout-width" id="layout-width-boxed" value="boxed">
        <input type="radio" name="layout-width" id="layout-width-fuild" value="fuild">

        <input type="radio" name="topbar-color" id="topbar-color-light" value="light">
        <input type="radio" name="topbar-color" id="topbar-color-dark" value="dark">

        <input type="radio" name="sidebar-size" id="sidebar-size-default" value="default">
        <input type="radio" name="sidebar-size" id="sidebar-size-small" value="sm">
        <input type="radio" name="sidebar-size" id="sidebar-size-compact" value="md">

        <input type="radio" name="sidebar-color" id="sidebar-color-light" value="light">
        <input type="radio" name="sidebar-color" id="sidebar-color-dark" value="dark">
        <input type="radio" name="sidebar-color" id="sidebar-color-colored" value="colored">

        <input type="radio" name="layout-direction" id="layout-direction-ltr" value="ltr">
        <input type="radio" name="layout-direction" id="layout-direction-rtl" value="rtl">
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @stack('scripts')
</body>

</html>
