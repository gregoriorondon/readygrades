<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTemporalInscripcion extends Model
{
    protected $table = "students_temporal_data";
    protected $fillable = [
        'nucleo_id',
        'carrera_id',
        'primer_name',
        'segundo_name',
        'primer_apellido',
        'segundo_apellido',
        'nacionalidad',
        'cedula',
        'genero',
        'fecha_nacimiento',
        'nacimiento_city',
        'civil',
        'email',
        'telefono',
        'telefono2',
        'direccion',
        'city',
        'consejo',
        'comuna',
        'discapacidad',
        'disciplina',
        'title_student_temporal_id',
        'mencion',
        'institucion',
        'cityinstitucion',
        'fecha_grado',
        'promedio',
        'students_socio_economico_id',
    ];
    public function titulos() {
        return $this->belongsTo(TitleStudentTemporal::class, 'title_student_temporal_id');
    }
    public function nivelSocial() {
        return $this->belongsTo(StudentSocioEconomico::class, 'students_socio_economico_id');
    }
}
