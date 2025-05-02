<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nucleos extends Model
{
    use HasFactory;
    protected $table = 'nucleos';
    protected $fillable = ['nucleo']; 
    public function inscripciones(){
        return $this->hasMany(Inscripciones::class);
    }
}
