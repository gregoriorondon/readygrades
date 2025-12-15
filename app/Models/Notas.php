<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = 'notas';
    protected $fillable = [
        'nota_uno',
        'nota_dos',
        'nota_tres',
        'nota_cuatro',
        'nota_recuperacion',
        'editado',
        'pensum_id',
        'students_codigo_nucleo_id',
        'periodo_id'
    ];
    public function pensums() {
        return $this->belongsTo(Pensum::class, 'pensum_id');
    }
    public function students() {
        return $this->belongsTo(Students::class, 'students_data_id');
    }
    public function periodos() {
        return $this->belongsTo(Periodos::class, 'periodo_id');
    }
}
