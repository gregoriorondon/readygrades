<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = "students";
    protected $fillable = [
        'primer-name',
        'segundo-name',
        'primer-apellido',
        'segundo-apellido',
        'genero',
        'nacionalidad',
        'cedula',
        'telefono',
        'fecha-nacimiento',
        'email',
        'direccion',
        'city',
        'carrera',
        'trayecto',
    ];
}
