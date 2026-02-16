<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSocioEconomico extends Model
{
    protected $table = 'students_socio_economico';
    protected $fillable = [
        'socioeconomico',
    ];
}
