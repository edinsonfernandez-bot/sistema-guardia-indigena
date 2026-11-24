@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2 class="fw-bold text-success mb-1">Panel de Control - Guardia Indígena (Kiwe Thegnas)</h2>
        <p class="text-muted mb-0">Bienvenido(a), {{ Auth::user()->name }}. Resumen general del sistema territorial.</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-success shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted fw-bold">Guardias Caracterizados</h6>
                    <h2 class="display-5 fw-bold text-success my-2">{{ $totalGuardias }}</h2>
                    <p class="mb-3 text-muted small">Activos actualmente: <strong>{{ $guardiasActivos }}</strong></p>
                    <a href="{{ route('guardias.index') }}" class="btn btn-outline-success btn-sm">Gestionar Guardias &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted fw-bold">Actividades Programadas</h6>
                    <h2 class="display-5 fw-bold text-primary my-2">{{ $totalActividades }}</h2>
                    <p class="mb-3 text-muted small">Recorridos, mingas y puntos de control</p>
                    <a href="{{ route('actividades.index') }}" class="btn btn-outline-primary btn-sm">Ver Actividades &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-dark shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted fw-bold">Certificados Emitidos</h6>
                    <h2 class="display-5 fw-bold text-dark my-2">{{ $totalCertificados }}</h2>
                    <p class="mb-3 text-muted small">Constancias con código de verificación</p>
                    <a href="{{ route('certificados.index') }}" class="btn btn-outline-dark btn-sm">Ir a Certificados &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm bg-light">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <strong>Acciones rápidas:</strong> Registra un nuevo comunero, programa un recorrido o expide una constancia al instante.
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('guardias.create') }}" class="btn btn-success btn-sm">+ Nuevo Guardia</a>
                <a href="{{ route('actividades.create') }}" class="btn btn-primary btn-sm">+ Nueva Actividad</a>
                <a href="{{ route('certificados.create') }}" class="btn btn-dark btn-sm">+ Emitir Certificado</a>
            </div>
        </div>
    </div>
</div>
@endsection