@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Caracterización de Guardias (Kiwe Thegnas)</h3>
        <a href="{{ route('guardias.create') }}" class="btn btn-success">+ Nuevo Guardia</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('guardias.index') }}" class="row g-2 mb-3">
                <div class="col-md-10">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por documento, nombres o apellidos..." value="{{ $busqueda }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Documento</th>
                            <th>Nombre Completo</th>
                            <th>Territorio / Resguardo</th>
                            <th>Teléfono</th>
                            <th>Ingreso</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guardias as $guardia)
                            <tr>
                                <td>{{ $guardia->documento }}</td>
                                <td>{{ $guardia->nombres }} {{ $guardia->apellidos }}</td>
                                <td>{{ $guardia->territorio->nombre ?? 'Sin asignar' }}</td>
                                <td>{{ $guardia->telefono ?? '-' }}</td>
                                <td>{{ $guardia->fecha_ingreso }}</td>
                                <td>
                                    <span class="badge {{ $guardia->estado == 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $guardia->estado }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('guardias.edit', $guardia) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('guardias.destroy', $guardia) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este registro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No hay guardias registrados aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection