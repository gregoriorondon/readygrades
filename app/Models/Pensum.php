<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pensum extends Model
{
    //
    protected $table = 'pensum';
    protected $fillable = [
        'carrera_id',
        'tramo_trayecto_id',
        'materia_id',
    ];
    public function carreras(){
        return $this->belongsTo(Carreras::class, 'carrera_id');
    }
    public function tramos(){
        return $this->belongsTo(Tramos::class, 'tramo_trayecto_id');
    }
    public function trayectos(){
        return $this->belongsTo(Trayectos::class, 'tramo_trayecto_id');
    }
    public function materias(){
        return $this->belongsTo(Materias::class, 'materia_id');
    }
}
