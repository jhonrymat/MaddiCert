<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';
    protected $fillable = [
        'fechaSolicitud',
        'numeroIdentificacion',
        'fechaActual',
        'id_barrio',
        'direccion',
        'ubicacion',
        'evidenciaPDF',
        'id_solicitante'
    ];

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class, 'id_solicitante');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'id_barrio');
    }

    public function validaciones()
    {
        return $this->hasMany(Validacion::class, 'id_solicitud');
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion');
    }





}
