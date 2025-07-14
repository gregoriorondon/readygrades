<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TituloAcademico extends Model
{
    //
    protected $table = 'titulosacademicos';
    protected $fillable = [
        'titulo',
        'descripcion',
        'carrera_id',
        'tramo_trayecto_id',
    ];
    public function carreras() {
        return $this->belongsTo(Carreras::class,  'carrera_id');
    }
    public function tramoTrayecto() {
        return $this->belongsTo(TramoTrayecto::class, 'tramo_trayecto_id');
    }
}
