<?php

namespace App\Http\Controllers;

use App\Models\Guardia;
use App\Models\Actividad;
use App\Models\Certificado;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalGuardias = Guardia::count();
        $guardiasActivos = Guardia::where('estado', 'Activo')->count();
        $totalActividades = Actividad::count();
        $totalCertificados = Certificado::count();

        return view('home', compact(
            'totalGuardias',
            'guardiasActivos',
            'totalActividades',
            'totalCertificados'
        ));
    }
}