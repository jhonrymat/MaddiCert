<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombreBarrio', 'unidad', 'numero', 'tipo'
    ];
    

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_barrio');
    }


}
