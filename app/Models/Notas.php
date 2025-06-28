<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = 'notas';
    protected $fillable = [
        'nota',
        'pensum_id',
        'student_id'
    ];
    public function pensums() {
        return $this->belongsTo(Pensum::class, 'pensum_id');
    }
    public function students() {
        return $this->belongsTo(Students::class, 'student_id');
    }
}
