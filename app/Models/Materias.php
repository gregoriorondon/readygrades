<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    //
    protected $table = "materias";
    protected $fillable = ['materia','codigo', 'unidadcurricular'];
    public function pensums() {
        return $this->belongsTo(Pensum::class, 'pensum_id');
    }
    public function materiasRelacionadas() {
        return $this->hasMany(Materias::class);
    }
}
