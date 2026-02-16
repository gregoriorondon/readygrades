<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NucleoCarrera extends Model
{
    protected $table = 'nucleo_carrera';
    protected $fillable = [
        'nucleo_id',
        'carrera_id',
    ];
    public function carreras() {
        return $this->belongsTo(Carreras::class, 'carrera_id');
    }
    public function nucleos() {
        return $this->belongsTo(Nucleos::class, 'nucleo_id');
    }
}
