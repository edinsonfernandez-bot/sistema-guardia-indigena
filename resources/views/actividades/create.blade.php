@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-bold">Programar Nueva Actividad</div>
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

                    <form action="{{ route('actividades.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Título de la Actividad *</label>
                                <input type="text" name="titulo" class="form-control" placeholder="Ej. Recorrido territorial punto de control" value="{{ old('titulo') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nivel / Alcance *</label>
                                <select name="nivel" class="form-select" required>
                                    <option value="Veredal" {{ old('nivel') == 'Veredal' ? 'selected' : '' }}>Veredal</option>
                                    <option value="Resguardo" {{ old('nivel') == 'Resguardo' ? 'selected' : '' }}>Resguardo</option>
                                    <option value="Zonal" {{ old('nivel') == 'Zonal' ? 'selected' : '' }}>Zonal</option>
                                    <option value="Regional" {{ old('nivel') == 'Regional' ? 'selected' : '' }}>Regional</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Territorio / Resguardo *</label>
                                <select name="territorio_id" class="form-select" required>
                                    <option value="">Seleccione un territorio...</option>
                                    @foreach($territorios as $territorio)
                                        <option value="{{ $territorio->id }}" {{ old('territorio_id') == $territorio->id ? 'selected' : '' }}>
                                            {{ $territorio->nombre }} ({{ $territorio->zona }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Lugar Específico *</label>
                                <input type="text" name="lugar" class="form-control" placeholder="Ej. Vereda El Credo / Casa Grande" value="{{ old('lugar') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha y Hora de Inicio *</label>
                                <input type="datetime-local" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha y Hora de Finalización *</label>
                                <input type="datetime-local" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Descripción / Logística</label>
                                <textarea name="descripcion" rows="3" class="form-control" placeholder="Detalles, recomendaciones o elementos requeridos...">{{ old('descripcion') }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('actividades.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Actividad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection