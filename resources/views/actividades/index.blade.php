@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Programación de Actividades</h3>
        <a href="{{ route('actividades.create') }}" class="btn btn-success">+ Nueva Actividad</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('actividades.index') }}" class="row g-2 mb-3">
                <div class="col-md-10">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por título, lugar o nivel..." value="{{ $busqueda }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Actividad</th>
                            <th>Territorio</th>
                            <th>Lugar</th>
                            <th>Nivel</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($actividades as $actividad)
                            <tr>
                                <td>
                                    <strong>{{ $actividad->titulo }}</strong>
                                    @if($actividad->descripcion)
                                        <br><small class="text-muted">{{ Str::limit($actividad->descripcion, 50) }}</small>
                                    @endif
                                </td>
                                <td>{{ $actividad->territorio->nombre ?? 'Sin asignar' }}</td>
                                <td>{{ $actividad->lugar }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $actividad->nivel }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($actividad->fecha_inicio)->format('d/m/Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($actividad->fecha_fin)->format('d/m/Y H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('actividades.edit', $actividad) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('actividades.destroy', $actividad) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta actividad?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No hay actividades programadas aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection