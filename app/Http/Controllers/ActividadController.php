<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Territorio;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $busqueda = $request->get('buscar');

        $actividades = Actividad::with('territorio')
            ->when($busqueda, function ($query, $busqueda) {
                return $query->where('titulo', 'like', "%{$busqueda}%")
                    ->orWhere('lugar', 'like', "%{$busqueda}%")
                    ->orWhere('nivel', 'like', "%{$busqueda}%");
            })
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        return view('actividades.index', compact('actividades', 'busqueda'));
    }

    public function create()
    {
        $territorios = Territorio::orderBy('nombre')->get();
        return view('actividades.create', compact('territorios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'lugar' => 'required|string|max:150',
            'nivel' => 'required|string',
            'territorio_id' => 'required|exists:territorios,id',
        ]);

        Actividad::create($request->all());

        return redirect()->route('actividades.index')
            ->with('success', 'Actividad programada correctamente.');
    }

    public function edit(Actividad $actividade)
    {
        $territorios = Territorio::orderBy('nombre')->get();
        return view('actividades.edit', ['actividad' => $actividade, 'territorios' => $territorios]);
    }

    public function update(Request $request, Actividad $actividade)
    {
        $request->validate([
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'lugar' => 'required|string|max:150',
            'nivel' => 'required|string',
            'territorio_id' => 'required|exists:territorios,id',
        ]);

        $actividade->update($request->all());

        return redirect()->route('actividades.index')
            ->with('success', 'Actividad actualizada correctamente.');
    }

    public function destroy(Actividad $actividade)
    {
        $actividade->delete();
        return redirect()->route('actividades.index')
            ->with('success', 'Actividad eliminada.');
    }
}
