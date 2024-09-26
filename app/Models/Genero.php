<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombreGenero',
    ];

    public function solicitantes()
    {
        return $this->hasMany(Solicitante::class, 'id_genero');
    }




}
