<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripciones extends Model
{
    use HasFactory;
    public function students(){
        return $this->belongsTo(Students::class);
    }
    public function carreras(){
        return $this->belongsTo(Carreras::class);
    }
    public function trimestres(){
        return $this->belongsTo(Trimestres::class);
    }
}
