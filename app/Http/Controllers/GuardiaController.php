<?php

namespace App\Http\Controllers;

use App\Models\Guardia;
use App\Models\Territorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $busqueda = $request->get('buscar');

        $guardias = Guardia::with('territorio')
            ->when($busqueda, function ($query, $busqueda) {
                return $query->where('documento', 'like', "%{$busqueda}%")
                    ->orWhere('nombres', 'like', "%{$busqueda}%")
                    ->orWhere('apellidos', 'like', "%{$busqueda}%");
            })
            ->orderBy('apellidos')
            ->get();

        return view('guardias.index', compact('guardias', 'busqueda'));
    }

    public function create()
    {
        $territorios = Territorio::orderBy('nombre')->get();
        return view('guardias.create', compact('territorios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|string|max:30|unique:guardias,documento',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:20',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|string',
            'territorio_id' => 'required|exists:territorios,id',
        ]);

        Guardia::create([
            'documento' => $request->documento,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'fecha_ingreso' => $request->fecha_ingreso,
            'estado' => $request->estado,
            'territorio_id' => $request->territorio_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('guardias.index')
            ->with('success', 'Guardia indígena registrado correctamente.');
    }

    public function edit(Guardia $guardia)
    {
        $territorios = Territorio::orderBy('nombre')->get();
        return view('guardias.edit', compact('guardia', 'territorios'));
    }

    public function update(Request $request, Guardia $guardia)
    {
        $request->validate([
            'documento' => 'required|string|max:30|unique:guardias,documento,' . $guardia->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:20',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|string',
            'territorio_id' => 'required|exists:territorios,id',
        ]);

        $guardia->update($request->all());

        return redirect()->route('guardias.index')
            ->with('success', 'Datos del guardia actualizados correctamente.');
    }

    public function destroy(Guardia $guardia)
    {
        $guardia->delete();
        return redirect()->route('guardias.index')
            ->with('success', 'Registro eliminado.');
    }
}