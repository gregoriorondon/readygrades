<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    //
    protected $table = 'sessions';

    protected $fillable = [
        'user_id',
        'session_token',
        'ip_address',
        'user_agent'
    ];

    public function cargos()
    {
        return $this->belongsTo(Cargos::class, 'cargo_id');
    }
}
