<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\StudentPublic;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityController extends Controller
{
    public function index(){
        return view('home');
    }
    public function organigrama(){
        return view('organigrama');
    }
    public function students(){
        return view('estudiantes');
    }
    public function studentspublicdetails(Request $request){
        $request->validate([
            'cedula'=>'required|numeric|exists:students,cedula',
        ], [
            'cedula.exists'=>'La cédula ingresada no se encuentra registrada.',
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.numeric' => 'El campo cédula debe contener solo números.',
        ]);
        $estudiante = StudentPublic::with(['tramos.trayectos','carreras','secciones'])->where('cedula', $request->cedula)->first();
        if (! $estudiante) {
            return redirect()->back()->withErros(['cedula'=>'No se encuentra registrado en nuestra institución como un estudiante.']);
        }
        /* return view('detalles-estudiante-publico', ['estudiante' => $student]); */
        return view('detalles-estudiante-publico', compact('estudiante'));
    }
    public function admin(){
        return view ('auth.login');
    }
    public function courses(){
        $carrera = Carreras::all();
        return view('auth.courses', ['courses' => $carrera]);
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
}
