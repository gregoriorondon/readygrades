<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsCodigoNucleo extends Model
{
    protected $table = "students_codigo_nucleo";
    protected $fillable = [
        'students_data_id',
        'nucleo_id',
        'codigo'
    ];
    public function nucleo() {
        return $this->belongsTo(Nucleos::class, 'nucleo_id');
    }
    public function student() {
        return $this->belongsTo(Students::class, 'students_data_id');
    }
    public function inscripciones() {
        return $this->hasMany(StudentsInscripciones::class, 'students_codigo_nucleo_id');
    }
}
