<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudios extends Model
{
    use HasFactory;
    protected $table = 'estudios';
    protected $fillable = [
        'estudio',
        'abrev',
    ];
}
