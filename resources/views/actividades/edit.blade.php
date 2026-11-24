@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning fw-bold">Editar Actividad</div>
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

                    <form action="{{ route('actividades.update', $actividad) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Título de la Actividad *</label>
                                <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $actividad->titulo) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nivel / Alcance *</label>
                                <select name="nivel" class="form-select" required>
                                    <option value="Veredal" {{ old('nivel', $actividad->nivel) == 'Veredal' ? 'selected' : '' }}>Veredal</option>
                                    <option value="Resguardo" {{ old('nivel', $actividad->nivel) == 'Resguardo' ? 'selected' : '' }}>Resguardo</option>
                                    <option value="Zonal" {{ old('nivel', $actividad->nivel) == 'Zonal' ? 'selected' : '' }}>Zonal</option>
                                    <option value="Regional" {{ old('nivel', $actividad->nivel) == 'Regional' ? 'selected' : '' }}>Regional</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Territorio / Resguardo *</label>
                                <select name="territorio_id" class="form-select" required>
                                    @foreach($territorios as $territorio)
                                        <option value="{{ $territorio->id }}" {{ old('territorio_id', $actividad->territorio_id) == $territorio->id ? 'selected' : '' }}>
                                            {{ $territorio->nombre }} ({{ $territorio->zona }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Lugar Específico *</label>
                                <input type="text" name="lugar" class="form-control" value="{{ old('lugar', $actividad->lugar) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha y Hora de Inicio *</label>
                                <input type="datetime-local" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', \Carbon\Carbon::parse($actividad->fecha_inicio)->format('Y-m-d\TH:i')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha y Hora de Finalización *</label>
                                <input type="datetime-local" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', \Carbon\Carbon::parse($actividad->fecha_fin)->format('Y-m-d\TH:i')) }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Descripción / Logística</label>
                                <textarea name="descripcion" rows="3" class="form-control">{{ old('descripcion', $actividad->descripcion) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('actividades.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar Actividad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection