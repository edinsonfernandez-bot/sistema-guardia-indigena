<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;

    protected $table = 'certificados';

    protected $fillable = [
        'codigo_verificacion',
        'tipo',
        'tiempo_servicio',
        'autorizado_por',
        'fecha_emision',
        'observaciones',
        'guardia_id',
        'user_id',
    ];

    public function guardia()
    {
        return $this->belongsTo(Guardia::class, 'guardia_id');
    }

    public function emisor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}