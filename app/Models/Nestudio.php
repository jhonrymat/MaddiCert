<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nestudio extends Model
{
    use HasFactory;
    protected $fillable = [
        'nivelEstudio',
    ];

    public function solicitantes()
    {
        return $this->hasMany(Solicitante::class, 'id_nivelEstudio');
    }



}
