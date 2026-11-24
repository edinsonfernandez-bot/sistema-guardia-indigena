@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-bold">Emitir Nuevo Certificado</div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('certificados.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Seleccionar Guardia Indígena *</label>
                                <select name="guardia_id" class="form-select" required>
                                    <option value="">Seleccione un guardia registrado...</option>
                                    @foreach($guardias as $guardia)
                                        <option value="{{ $guardia->id }}" {{ old('guardia_id') == $guardia->id ? 'selected' : '' }}>
                                            {{ $guardia->documento }} - {{ $guardia->nombres }} {{ $guardia->apellidos }} ({{ $guardia->territorio->nombre ?? 'Sin territorio' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tipo de Certificación *</label>
                                <select name="tipo" class="form-select" required>
                                    <option value="Pertenencia Activa a la Guardia Indígena">Pertenencia Activa a la Guardia Indígena</option>
                                    <option value="Participación en Control Territorial">Participación en Control Territorial</option>
                                    <option value="Servicio Comunitario y Minga">Servicio Comunitario y Minga</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Emisión *</label>
                                <input type="date" name="fecha_emision" class="form-control" value="{{ old('fecha_emision', date('Y-m-d')) }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Observaciones Adicionales (Opcional)</label>
                                <textarea name="observaciones" rows="3" class="form-control" placeholder="Ej. Se expide a solicitud del interesado para trámites administrativos...">{{ old('observaciones') }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('certificados.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Generar Certificado</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection