<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodos extends Model
{
    protected $table = 'periodos';
    protected $fillable = [
        'inicio',
        'fin',
        'fin_inscripcion',
        'nombre',
        'activo',
        'nucleo_id',
    ];
}
