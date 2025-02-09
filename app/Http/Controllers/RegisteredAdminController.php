<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Students;
use App\Models\Trimestres;
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
        $carrera = Carreras::all();
        /* $trimestres = Trimestres::all(); */

        /* dd($carrera); */
        return view('auth.registro-estudiante', ['courses' => $carrera]);
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
            'cedula' => ['required', 'min:7', 'exists:students,cedula'],
            'telefono' => ['required', 'min:11'],
            'fecha-nacimiento' => ['required', 'date'],
            'email' => ['required'],
            'direccion' => ['required'],
            'city' => ['required'],
            'carreras_id' => ['required'],
            'trimestres_id' => ['required'],
        ],[
            'cedula.exists'=>'El Estudiante Ya Está Inscripto',
        ]);
        Students::create($studentatributes);
        return redirect('/registro-estudiante');
    }
    public function admindashboard(){
        $user = Auth::user();
        return view('admin', ['user'=>$user]);
    }
    public function studentsadmin(){
        $students = Students::paginate(20);
        return view('auth.students', ['estudiantes' => $students]);
    }
    public function studentsadmindetails(Students $student){
        return view('auth.students-details', ['estudiantes' => $student]);
    }
    public function adminadd(){
        return view('auth.registro-admin');
    }
    public function profesornomina(){
        return view('auth.profesores-nomina');
    }
    public function courses(){
        $carrera = Carreras::all();
        return view('auth.courses', ['courses' => $carrera]);
    }
}
