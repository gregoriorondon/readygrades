<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trayectos extends Model
{
    use HasFactory;
    protected $table = 'trayectos';
    protected $fillable = ['trayectos'];
    public function tramos(){
        return $this->belongsToMany(Tramos::class, 'tramo_trayecto', 'trayecto_id', 'tramo_id')->withPivot('id');
    }
}
