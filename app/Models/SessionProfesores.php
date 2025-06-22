<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionProfesores extends Model
{
    protected $table = "sessionsteacher";
    protected $fillable = [
        'teacher_id',
        'session_token',
        'ip_address',
        'user_agent'
    ];
    public function cargos()
    {
        return $this->belongsTo(Cargos::class, 'cargo_id');
    }
}
