<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'direccion',
        'conjunto',
        'casa_apto',  // Recuerda reemplazar el campo 'casa/apto' por 'casa_apto'
        'barrio_id'
    ];

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id');
    }

    // Si las direcciones están relacionadas con las solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'direccion');
    }

}
