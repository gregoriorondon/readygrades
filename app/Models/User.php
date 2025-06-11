<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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
    public function cargos(){
        return $this->belongsTo(Cargos::class, 'cargo_id');
    }
    public function estudios(){
        return $this->belongsTo(Estudios::class, 'estudio_id');
    }
    public function nucleos(){
        return $this->belongsTo(Nucleos::class, 'nucleo_id');
    }
}
