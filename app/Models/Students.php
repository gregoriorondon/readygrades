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
        'codigo',
        'telefono',
        'fecha_nacimiento',
        'email',
        'direccion',
        'city',
        'nucleo_id',
        'carrera_id',
        'tramo_trayecto_id',
        'seccion_id',
        'periodo_id'
    ];
    public function inscripciones(){
        return $this->hasMany(Inscripciones::class);
    }
    public function nucleos(){
        return $this->belongsTo(Nucleos::class, 'nucleo_id');
    }
    public function carreras(){
        return $this->belongsTo(Carreras::class, 'carrera_id');
    }
    public function trayectos(){
        return $this->belongsToMany(Trayectos::class, 'tramo_trayecto_id');
    }
    public function tramos(){
        return $this->belongsTo(Tramos::class, 'tramo_trayecto_id');
    }
    public function secciones(){
        return $this->belongsTo(Secciones::class, 'seccion_id');
    }
    public function notas() {
        return $this->hasMany(Notas::class);
    }
    public function periodos() {
        return $this->belongsTo(Periodos::class);
    }
}
