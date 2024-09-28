<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nombre_1',
        'nombre_2',
        'apellido_1',
        'apellido_2',
        'correoElectronico',
        'telefonoContacto',
        'id_tipoSolicitante',
        'id_tipoDocumento',
        'numeroIdentificacion',
        'ciudadExpedicion',
        'fechaNacimiento',
        'id_nivelEstudio',
        'id_genero',
        'ocupacion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipoSolicitante()
    {
        return $this->belongsTo(TSolicitant::class, 'id_tipoSolicitante');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(Tdocumento::class, 'id_tipoDocumento');
    }

    public function nivelEstudio()
    {
        return $this->belongsTo(Nestudio::class, 'id_nivelEstudio');
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'id_genero');
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

}
