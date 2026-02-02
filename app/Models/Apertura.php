<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apertura extends Model
{
    protected $table = 'students_public_inscripcion';
    protected $fillable = ['nucleo_id', 'estado'];
}
