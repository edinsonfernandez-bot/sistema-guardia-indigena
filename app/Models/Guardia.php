<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardia extends Model
{
    use HasFactory;

    protected $table = 'guardias';

    protected $fillable = [
        'documento',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'telefono',
        'fecha_ingreso',
        'estado',
        'territorio_id',
        'user_id',
    ];

    public function territorio()
    {
        return $this->belongsTo(Territorio::class, 'territorio_id');
    }
}