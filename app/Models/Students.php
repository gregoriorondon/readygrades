<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = "students";
    protected $fillable = [
        'primer_name',
        'segundo_name',
        'primer_apellido',
        'segundo_apellido',
        'genero',
        'nacionalidad',
        'cedula',
        'telefono',
        'fecha_nacimiento',
        'email',
        'direccion',
        'city',
        'carrera_id',
        'tramo_id',
    ];
    public function inscripciones(){
        return $this->hasMany(Inscripciones::class);
    }
    public function carreras(){
        return $this->belongsTo(Carreras::class, 'carrera_id');
    }
    public function trayectos(){
        return $this->belongsToMany(Trayectos::class, 'tramo_trayecto');
    }
    public function tramos(){
        return $this->belongsTo(Tramos::class, 'tramo_id');
    }
}
