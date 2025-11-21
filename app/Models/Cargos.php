<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    use HasFactory;
    protected $table = 'cargos';
    protected $fillable = [
        'cargo',
        'tipo_id',
        'encargado'
    ];
    public function tipos(){
        return $this->belongsTo(Tipos::class, 'tipo_id');
    }
}
