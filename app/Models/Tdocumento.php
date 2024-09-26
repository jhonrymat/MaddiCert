<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tdocumento extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipoDocumento',
    ];

    public function solicitantes()
    {
        return $this->hasMany(Solicitante::class, 'id_tipoDocumento');
    }


}
