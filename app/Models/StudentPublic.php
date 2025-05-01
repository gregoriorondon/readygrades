<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPublic extends Model
{
    use HasFactory;
    protected $table = "students";
    public function carreras() {
        return $this->belongsTo(Carreras::class, 'carrera_id');
    }
    public function tramos() {
        return $this->belongsTo(Tramos::class, 'tramo_id');
    }
    public function trayectos() {
        return $this->belongsToMany(Trayectos::class, 'tramo_trayecto');
    }
}
