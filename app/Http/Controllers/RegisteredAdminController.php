<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Inscripciones;
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
        /* return view('auth.registro-estudiante', ['courses' => $carrera]); */
        return view('auth.registro-estudiante', ['courses' => $carrera]);
    }
    public function studentstore(Request $request){
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
        ],[
            /* 'cedula.exists'=>'El Estudiante Ya Está Inscripto', */
        ]);

        // Crear el estudiante
        Students::create(
            /* 'cedula' => $request->cedula, */
            /* 'primer-name' => $request->primer_name, */
            /* 'primer-apellido' => $request->primer_apellido, */
            /* 'email' => $request->email, */
            $studentatributes
        );

        /* // Verificar si ya existe una inscripción para el mismo estudiante, carrera y trimestre */
        /* $existeInscripcion = Inscripciones::where('estudiante_id', $estudiante->id) */
        /*     ->where('carrera_id', $request->carrera_id) */
        /*     ->where('trimestres_id', $request->trimestre_id) */
        /*     ->exists(); */

        /* if ($existeInscripcion) { */
        /*     // Si ya existe, redirigir con un mensaje de error */
        /*     return redirect()->back()->with('error', 'El estudiante ya está inscrito en esta carrera y trimestre.'); */
        /* } */

        /* // Crear la inscripción */
        /* Inscripciones::create([ */
        /*     'students_id' => $estudiante->id, */
        /*     'carreras_id' => $request->carreras_id, */
        /*     'trimestres_id' => $request->trimestres_id, */
        /*     /1* 'fecha_inscripcion' => $request->fecha_inscripcion, *1/ */
        /* ]); */
        /* /1* Students::create($studentatributes); *1/ */
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
