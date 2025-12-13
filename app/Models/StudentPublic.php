<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPublic extends Model
{
    use HasFactory;
    protected $table = "students_data";
    public function studentsDataInscripcion(){
        return $this->hasMany(StudentDatoInscripciones::class, 'students_data_id');
    }
    public function carreras() {
        return $this->belongsTo(Carreras::class, 'carrera_id');
    }
    public function nucleos(){
        return $this->belongsTo(Nucleos::class, 'nucleo_id');
    }
    public function tramos() {
        return $this->belongsTo(Tramos::class, 'tramo_trayecto_id');
    }
    public function trayectos() {
        return $this->belongsToMany(Trayectos::class, 'tramo_trayecto_id');
    }public function tramoTrayecto() {
    return $this->belongsTo(TramoTrayecto::class, 'tramo_trayecto_id');
}
    public function secciones(){
        return $this->belongsTo(Secciones::class, 'seccion_id');
    }
    public function notas() {
        return $this->hasMany(Notas::class);
    }
}
