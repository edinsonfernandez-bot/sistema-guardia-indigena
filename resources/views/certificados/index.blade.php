@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Emisión y Control de Certificados</h3>
        <a href="{{ route('certificados.create') }}" class="btn btn-success">+ Emitir Certificado</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('certificados.index') }}" class="row g-2 mb-3">
                <div class="col-md-10">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por código de verificación, documento o nombre del guardia..." value="{{ $busqueda }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Código</th>
                            <th>Guardia (Kiwe Thegna)</th>
                            <th>Documento</th>
                            <th>Tipo de Certificado</th>
                            <th>Fecha Emisión</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($certificados as $certificado)
                            <tr>
                                <td><span class="badge bg-dark">{{ $certificado->codigo_verificacion }}</span></td>
                                <td>{{ $certificado->guardia->nombres }} {{ $certificado->guardia->apellidos }}</td>
                                <td>{{ $certificado->guardia->documento }}</td>
                                <td>{{ $certificado->tipo }}</td>
                                <td>{{ \Carbon\Carbon::parse($certificado->fecha_emision)->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('certificados.show', $certificado) }}" class="btn btn-sm btn-info text-dark fw-semibold">Ver / Imprimir</a>
                                    <form action="{{ route('certificados.destroy', $certificado) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Anular este certificado?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Anular</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No se han emitido certificados aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection