<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsInscripciones extends Model
{
    protected $table = 'students_inscripcion';
    protected $fillable = [
        'nucleo_id',
        'carrera_id',
        'tramo_trayecto_id',
        'seccion_id',
        'periodo_id',
    ];
    public function studentsDataInscripcion(){
        return $this->hasMany(StudentDatoInscripciones::class, 'students_data_id');
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
    public function periodo() {
        return $this->belongsTo(Periodos::class, 'periodo_id');
    }
}
