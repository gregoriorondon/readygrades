<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TramoTrayecto extends Model
{
    protected $table = 'tramo_trayecto';
    public function tramos() {
        return $this->belongsTo(Tramos::class, 'tramo_id');
    }
    public function trayectos() {
        return $this->belongsTo(Trayectos::class, 'trayecto_id');
    }
}
