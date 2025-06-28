<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramos extends Model
{
    use HasFactory;
    protected $table = 'tramos';
    protected $fillable = ['tramos'];
    public function trayectos() {
        return $this->belongsToMany(Trayectos::class, 'tramo_trayecto', 'tramo_id', 'trayecto_id')->withPivot('id');
    }
}
