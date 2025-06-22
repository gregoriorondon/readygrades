<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionRoot extends Model
{
    //
    protected $table = "sessionsroot";
    protected $fillable = [
        'root_id',
        'session_token',
        'ip_address',
        'user_agent'
    ];
    public function cargos()
    {
        return $this->belongsTo(Cargos::class, 'cargo_id');
    }
}
