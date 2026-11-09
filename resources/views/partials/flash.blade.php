@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="uil uil-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="uil uil-exclamation-triangle me-1"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

@if ($errors->any() && !request()->routeIs('deberes.create'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="uil uil-exclamation-triangle me-1"></i>
        Revisa la información ingresada:
        <ul class="mb-0 mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif
