<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'lugar',
        'nivel',
        'territorio_id',
    ];

    public function territorio()
    {
        return $this->belongsTo(Territorio::class, 'territorio_id');
    }
}