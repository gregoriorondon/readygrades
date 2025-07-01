<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignar extends Model
{
    protected $table = 'profesor_asignar';
    protected $fillable = ['pensum_id','profesor_id','seccion_id','periodo_id'];
    public function asignaciones() {
        return $this->hasMany(Asignar::class);
    }
    public function pensums() {
        return $this->belongsTo(Pensum::class, 'pensum_id');
    }
    public function secciones() {
        return $this->belongsTo(Secciones::class, 'seccion_id');
    }
    public function periodos() {
        return $this->belongsTo(Periodos::class);
    }
}
