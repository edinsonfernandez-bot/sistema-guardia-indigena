<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Territorio;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatosInicialesSeeder extends Seeder
{
    public function run()
    {
        // 1. Roles del sistema
        $rolAdmin = Rol::create([
            'nombre' => 'Coordinador General',
            'descripcion' => 'Administrador total del sistema y emisor de certificados'
        ]);

        Rol::create([
            'nombre' => 'Coordinador Zonal',
            'descripcion' => 'Registro de guardias y actividades por territorio'
        ]);

        // 2. Territorios iniciales
        $territorioNorte = Territorio::create([
            'nombre' => 'Resguardo de Huellas - Caloto',
            'zona' => 'Zona Norte'
        ]);

        Territorio::create([
            'nombre' => 'Resguardo de López Adentro',
            'zona' => 'Zona Norte'
        ]);

        // 3. Usuario Administrador
        User::create([
            'name' => 'Edinson Fernández (Coordinador)',
            'email' => 'admin@guardia.org',
            'password' => Hash::make('Guardia2026*'),
            'rol_id' => $rolAdmin->id,
            'territorio_id' => $territorioNorte->id,
        ]);
    }
}