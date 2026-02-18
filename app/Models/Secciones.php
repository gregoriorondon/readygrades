<?php

namespace App\Models;

use App\Exports\StudentsList;
use Illuminate\Database\Eloquent\Model;

class Secciones extends Model
{
    protected $table = 'secciones';
    protected $fillable = ['seccion'];

    public function inscripcion() {
        return $this->hasMany(StudentsInscripciones::class, 'seccion_id');
    }
}
