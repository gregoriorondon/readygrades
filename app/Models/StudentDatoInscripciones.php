<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDatoInscripciones extends Model
{
    protected $table = 'students_data_inscripcion';
    protected $fillable = [
        'students_data_id',
        'students_inscripcion_id'
    ];
    public function studentsData() {
        return $this->belongsTo(Students::class, 'students_data_id');
    }
    public function studentsInscripcion() {
        return $this->belongsTo(StudentsInscripciones::class, 'students_inscripcion_id');
    }
}
