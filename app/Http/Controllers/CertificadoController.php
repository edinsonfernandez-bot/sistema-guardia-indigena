<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\Guardia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CertificadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $busqueda = $request->get('buscar');

        $certificados = Certificado::with(['guardia.territorio', 'emisor'])
            ->when($busqueda, function ($query, $busqueda) {
                return $query->where('codigo_verificacion', 'like', "%{$busqueda}%")
                    ->orWhereHas('guardia', function ($q) use ($busqueda) {
                        $q->where('documento', 'like', "%{$busqueda}%")
                          ->orWhere('nombres', 'like', "%{$busqueda}%")
                          ->orWhere('apellidos', 'like', "%{$busqueda}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('certificados.index', compact('certificados', 'busqueda'));
    }

    public function create()
    {
        $guardias = Guardia::with('territorio')->orderBy('apellidos')->get();
        return view('certificados.create', compact('guardias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guardia_id' => 'required|exists:guardias,id',
            'tipo' => 'required|string|max:100',
            'fecha_emision' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        // Calcular tiempo de servicio automático desde la fecha de ingreso
        $guardia = Guardia::findOrFail($request->guardia_id);
        $ingreso = Carbon::parse($guardia->fecha_ingreso);
        $diferencia = $ingreso->diff(Carbon::now());

        if ($diferencia->y > 0) {
            $tiempoServicio = $diferencia->y . ' año(s) y ' . $diferencia->m . ' mes(es)';
        } elseif ($diferencia->m > 0) {
            $tiempoServicio = $diferencia->m . ' mes(es) y ' . $diferencia->d . ' día(s)';
        } else {
            $tiempoServicio = $diferencia->d . ' día(s)';
        }

        // Generar código único: CERT-AÑO-XXXXXX
        $codigo = 'CERT-' . date('Y') . '-' . strtoupper(Str::random(6));

        $certificado = Certificado::create([
            'codigo_verificacion' => $codigo,
            'tipo' => $request->tipo,
            'tiempo_servicio' => $tiempoServicio,
            'autorizado_por' => Auth::id(),
            'fecha_emision' => $request->fecha_emision,
            'observaciones' => $request->observaciones,
            'guardia_id' => $request->guardia_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('certificados.show', $certificado)
            ->with('success', 'Certificado generado exitosamente.');
    }

    public function show(Certificado $certificado)
    {
        $certificado->load(['guardia.territorio', 'emisor']);
        return view('certificados.show', compact('certificado'));
    }

    public function destroy(Certificado $certificado)
    {
        $certificado->delete();
        return redirect()->route('certificados.index')
            ->with('success', 'Certificado anulado/eliminado.');
    }
}