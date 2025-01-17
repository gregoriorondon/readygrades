<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisteredAdminController extends Controller
{
    //
    public function create(){
        /* dd('hola mundo'); */
        return view('auth.registro-admin');
    }
    public function store(){
        /* dd(request()->all()); */
        $atributos = request()->validate([
            'primer-name' => ['required'],
            'segundo-name' => ['required'],
            'primer-apellido' => ['required'],
            'segundo-apellido' => ['required'],
            'genero' => ['required'],
            'nacionalidad' => ['required'],
            'cedula' => ['required', 'min:7'],
            'email' => ['required'],
            'password' => ['required', 'min:7', 'confirmed'],
        ],[
            'password.required'=>'Es necesaria una contraseña',
            'password.confirmed'=>'Las contraseñas no coinciden',
            'password.min'=>'La contraseña debe tener un mínimo de 7 caracteres',
            'cedula.min'=>'Introduzca una cédula válida, compuesta únicamente por números, sin incluir caracteres especiales.',
        ]);
        User::create($atributos);
        /* Auth::login($user); */
        return redirect('/administracion');
    }
    public function studentadd(){
        return view('auth.registro-estudiante');
    }
    public function studentstore(){
        /* dd(request()->all()); */
        $studentatributes = request()->validate([
            'primer-name' => ['required'],
            'segundo-name' => ['required'],
            'primer-apellido' => ['required'],
            'segundo-apellido' => ['required'],
            'genero' => ['required'],
            'nacionalidad' => ['required'],
            'cedula' => ['required', 'min:7'],
            'telefono' => ['required', 'min:11'],
            'fecha-nacimiento' => ['required', 'date'],
            'email' => ['required'],
            'direccion' => ['required'],
            'city' => ['required'],
            'carrera' => ['required'],
            'trayecto' => ['required'],
        ]);
        Students::create($studentatributes);
        return redirect('/registro-estudiante');
    }
}
