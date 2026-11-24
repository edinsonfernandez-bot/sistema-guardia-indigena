@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning fw-bold">Editar Datos del Guardia</div>
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

                    <form action="{{ route('guardias.update', $guardia) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Número de Documento *</label>
                                <input type="text" name="documento" class="form-control" value="{{ old('documento', $guardia->documento) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Territorio / Resguardo *</label>
                                <select name="territorio_id" class="form-select" required>
                                    @foreach($territorios as $territorio)
                                        <option value="{{ $territorio->id }}" {{ old('territorio_id', $guardia->territorio_id) == $territorio->id ? 'selected' : '' }}>
                                            {{ $territorio->nombre }} ({{ $territorio->zona }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nombres *</label>
                                <input type="text" name="nombres" class="form-control" value="{{ old('nombres', $guardia->nombres) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Apellidos *</label>
                                <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos', $guardia->apellidos) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha de Nacimiento *</label>
                                <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $guardia->fecha_nacimiento) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha de Ingreso *</label>
                                <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $guardia->fecha_ingreso) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Teléfono / Celular</label>
                                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $guardia->telefono) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Estado *</label>
                                <select name="estado" class="form-select" required>
                                    <option value="Activo" {{ $guardia->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ $guardia->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="Retirado" {{ $guardia->estado == 'Retirado' ? 'selected' : '' }}>Retirado</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('guardias.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection