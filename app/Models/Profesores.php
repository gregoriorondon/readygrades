<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Profesores extends Authenticatable
{
    //
    use Notifiable;
    protected $fillable = [
        'primer-name',
        'segundo-name',
        'primer-apellido',
        'segundo-apellido',
        'genero',
        'nacionalidad',
        'cedula',
        'email',
        'password',
        'nucleo_id',
        'estudio_id',
        'cargo_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cargos()
    {
        return $this->belongsTo(Cargos::class, 'cargo_id');
    }

    public function estudios()
    {
        return $this->belongsTo(Estudios::class, 'estudio_id');
    }

    public function nucleos()
    {
        return $this->belongsTo(Nucleos::class, 'nucleo_id');
    }
    public function asignaciones() {
        return $this->hasMany(Asignar::class, 'profesor_id');
    }
}
