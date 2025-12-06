<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodos extends Model
{
    protected $table = 'periodos';
    protected $fillable = [
        'inicio',
        'fin',
        'nombre',
        'activo',
        'nucleo_id',
    ];
}
