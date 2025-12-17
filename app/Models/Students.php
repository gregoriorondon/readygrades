<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = "students_data";
    protected $fillable = [
        'primer_name',
        'segundo_name',
        'primer_apellido',
        'segundo_apellido',
        'genero',
        'nacionalidad',
        'cedula',
        'telefono',
        'fecha_nacimiento',
        'email',
        'direccion',
        'city',
    ];
    public function studentsDataInscripcion(){
        return $this->hasMany(StudentDatoInscripciones::class, 'students_data_id');
    }
    public function codigonucleo() {
        return $this->hasMany(StudentsCodigoNucleo::class, 'students_data_id');
    }
    public function nucleo() {
        return $this->hasMany(Nucleos::class, 'nucleo_id');
    }
}
