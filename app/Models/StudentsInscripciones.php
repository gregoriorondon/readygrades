<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsInscripciones extends Model
{
    protected $table = 'students_inscripcion';
    protected $fillable = [
        'students_codigo_nucleo_id',
        'carrera_id',
        'tramo_trayecto_id',
        'seccion_id',
        'periodo_id',
    ];
    public function studentsDataInscripcion(){
        return $this->hasMany(StudentDatoInscripciones::class, 'students_inscripcion_id');
    }
    public function studentcodigonucleo(){
        return $this->belongsTo(StudentsCodigoNucleo::class, 'students_codigo_nucleo_id');
    }
    public function datosestudiante() {
        return $this->studentcodigonucleo()->datosestudiante();
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
    public function tramoTrayecto()
    {
        return $this->belongsTo(TramoTrayecto::class, 'tramo_trayecto_id')->with('tramos');
    }
    public function secciones(){
        return $this->belongsTo(Secciones::class, 'seccion_id');
    }
    public function periodo() {
        return $this->belongsTo(Periodos::class, 'periodo_id');
    }
}
