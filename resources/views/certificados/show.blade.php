@extends('layouts.app')

@section('content')
<style>
    @media print {
        .no-print, nav.navbar {
            display: none !important;
        }
        body {
            background: #fff !important;
        }
        .certificado-hoja {
            border: 4px double #198754 !important;
            box-shadow: none !important;
            margin: 0 !important;
            width: 100% !important;
        }
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <a href="{{ route('certificados.index') }}" class="btn btn-secondary">&larr; Volver al listado</a>
        <button onclick="window.print()" class="btn btn-primary fw-bold">Imprimir / Guardar PDF</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success no-print">{{ session('success') }}</div>
    @endif

    <div class="card shadow p-5 certificado-hoja" style="border: 4px double #198754; background-color: #ffffff;">
        <div class="text-center mb-4">
            <h5 class="text-uppercase text-success fw-bold mb-1">Autoridad Tradicional y Coordinación Territorial</h5>
            <h2 class="fw-bold text-uppercase mb-0">Guardia Indígena (Kiwe Thegnas)</h2>
            <p class="text-muted mb-0">{{ $certificado->guardia->territorio->nombre ?? 'Territorio Ancestral' }} - {{ $certificado->guardia->territorio->zona ?? '' }}</p>
            <hr class="my-4 border-success opacity-75">
            <h3 class="fw-bold text-uppercase letter-spacing-1">Certifica Que:</h3>
        </div>

        <div class="my-4 px-md-4 fs-5" style="line-height: 1.8; text-align: justify;">
            <p>
                El(la) comunero(a) <strong>{{ strtoupper($certificado->guardia->nombres . ' ' . $certificado->guardia->apellidos) }}</strong>,
                identificado(a) con documento de identidad N.° <strong>{{ $certificado->guardia->documento }}</strong>,
                se encuentra debidamente caracterizado(a) y registrado(a) en nuestro censo organizativo bajo el estado
                <strong>{{ strtoupper($certificado->guardia->estado) }}</strong> desde el
                <strong>{{ \Carbon\Carbon::parse($certificado->guardia->fecha_ingreso)->format('d/m/Y') }}</strong>,
                en el territorio de <strong>{{ $certificado->guardia->territorio->nombre ?? 'su resguardo' }}</strong>.
            </p>

            <p>
                La presente constancia se expide por concepto de: <strong>{{ $certificado->tipo }}</strong>.
            </p>

            @if($certificado->observaciones)
                <p><strong>Observaciones:</strong> {{ $certificado->observaciones }}</p>
            @endif

            <p class="mt-4">
                Se firma y expide el día <strong>{{ \Carbon\Carbon::parse($certificado->fecha_emision)->format('d/m/Y') }}</strong>.
            </p>
        </div>

        <div class="row mt-5 pt-4 text-center">
            <div class="col-md-6 offset-md-3">
                <div class="border-top border-dark pt-2">
                    <strong>{{ $certificado->emisor->name ?? 'Coordinación Guardia Indígena' }}</strong><br>
                    <span class="text-muted">Coordinación Territorial - Kiwe Thegnas</span>
                </div>
            </div>
        </div>

        <div class="mt-5 pt-3 border-top d-flex justify-content-between align-items-center text-muted small">
            <span>Sistema de Información Guardia Indígena</span>
            <span>Código de Verificación: <strong class="text-dark">{{ $certificado->codigo_verificacion }}</strong></span>
        </div>
    </div>
</div>
@endsection