<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    /* use HasFactory; */
    protected $table = "carreras";
    protected $fillable = [
        /* 'id', */
        'carrera',
    ];
    public function inscripciones(){
        return $this->hasMany(Inscripciones::class);
    }
}
