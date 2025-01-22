<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPublic extends Model
{
    use HasFactory;
    protected $table = "students";
    protected $fillable = [
        'primer-name',
        'segundo-name',
        'primer-apellido',
        'segundo-apellido',
        'genero',
        'nacionalidad',
        'cedula',
        'carrera',
        'trayecto',
    ];
}
