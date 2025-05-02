<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Inscripciones;
use App\Models\Nucleos;
use App\Models\Students;
use App\Models\Tramos;
use App\Models\Trayectos;
use App\Models\Trimestres;
use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Str;

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
        $courses = Carreras::all();
        $trayectos = Trayectos::with('tramos')->get();
        /* $trimestres = Trimestres::all(); */

        /* dd($carrera); */
        /* return view('auth.registro-estudiante', ['courses' => $carrera]); */
        return view('auth.registro-estudiante', compact('courses', 'trayectos'));
    }
    public function studentstore(Request $request){
        /* dd(request()->all()); */
        $studentatributes = $request->validate([
            'primer_name' => ['required', 'text'],
            /* 'segundo_name' => ['required'], */
            'primer_apellido' => ['required', 'string'],
            /* 'segundo_apellido' => ['required'], */
            'genero' => ['required'],
            'nacionalidad' => ['required'], 
            'cedula' => ['required', 'min:7', 'numeric'],
            /* 'telefono' => ['min:11', 'numeric'], */
            'fecha_nacimiento' => ['required', 'date'],
            /* 'email' => ['required'], */
            'direccion' => ['required'],
            'city' => ['required'],
            'carrera_id' => ['required'],
            'tramo_id' => ['required'],
        ],[
            'primer_name.required'=>'El primer nombre es obligatorio',
            'primer_name.string'=>'El nombre no debe contener caracteres numericos',
            'primer_apellido.required'=>'El primer apellido es obligatorio',
            'genero.required'=>'Debe colocar el genero del estudiante a inscribir',
            'nacionalidad.required'=>'Debe colocar la nacionalidad del estudiante a inscribir',
            'cedula.required'=>'La cédula del estudiante es obligatorio para la inscripción',
            'cedula.min'=>'La cédula debe tener minimo 7 números',
            'cedula.numeric'=>'La cedula no debe contener caráteres no numericos',
            /* 'telefono.min'=>'El número de teléfono debe tener 11 números', */
            /* 'telefono.numeric'=>'El número de teléfono no debe contener caráteres no numericos', */
            'fecha_nacimiento.required'=>'Es obligatorio colocar la fecha de nacimiento del estudiante a inscribir',
            'fecha_nacimiento.date'=>'La fecha de nacimiento debe de ser tipo fecha',
            'direccion.required'=>'La dirección  del estudiante a inscribir es obligatorio',
            'city.required'=>'La ciudad o pueblo donde vive el o la estudiante a inscribir es obligatorio',
            'carrera_id.required'=>'Debe seleccionar una carrera existente para inscribir al estudiante',
            'tramo_id.required'=>'Debe seleccionar un trayecto-tramo existente para inscribir al estudiante',
            /* 'primer_name'=>'PN', */
            /* 'segundo_name'=>'SN', */
            /* 'primer_apellido'=>'PA', */
            /* 'segundo_apellido'=>'SA', */
            /* 'genero'=>'genero', */
        ]);

        

        /* // Verificar si ya existe una inscripción para el mismo estudiante, carrera y trimestre */
        $existeInscripcion = Students::where('cedula', $request->cedula)
            ->where('carrera_id', $request->carrera_id)
            ->where('tramo_id', $request->tramo_id)
            ->exists();

        if ($existeInscripcion) {
            // Si ya existe, redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'El estudiante ya está inscrito en esta carrera y trimestre.']);
        }

        // Crear el estudiante
        Students::create([
            'cedula' => $request->cedula,
            'primer_name' => $request->primer_name,
            'segundo_name' => $request->segundo_name,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'genero' => $request->genero,
            'nacionalidad' => $request->nacionalidad,
            'telefono' => $request->telefono,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'city' => $request->city,
            'carrera_id' => $request->carrera_id,
            'tramo_id' => $request->tramo_id,
            /* $studentatributes */
        ]);

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
        $carreras = Carreras::count();
        $estudiantes = Students::count();
        /* $carreras = Carreras::count(); */
        return view('admin', compact('user', 'carreras', 'estudiantes'));
    }
    public function studentsadmin(){
        $estudiantes = Students::paginate(20);
        return view('auth.students', compact('estudiantes'));
    }
    /* public function studentsadmindetails(Students $student){ */
    /*     return view('auth.students-details', ['estudiantes' => $student]); */
    /* } */
    public function studentsadmindetails($id){
        $estudiantes = Students::with(['tramos.trayectos'])->findOrFail($id);
        $student = Trayectos::with('tramos')->get();
        return view('auth.students-details', compact('estudiantes', 'student'));
    }
    public function adminadd(){
        return view('auth.registro-admin');
    }
    public function profesornomina(){
        return view('auth.profesores-nomina');
    }
    /* public function courses(){ */
    /*     $courses = Carreras::all(); */
    /*     $trayectos = Trayectos::with('tramos')->get(); */
    /*     return view('auth.courses', compact('courses', 'trayectos')); */
    /* } */
    public function courses(){
        $courses = Carreras::all();
        $tra = Trayectos::with('tramos')->get();
        return view('auth.courses', compact('courses', 'tra'));
    }
    public function autocourses(Request $request) {
        $term = $request->input('term');
        $datos = Carreras::whereRaw('LOWER(carrera) LIKE ?', ['%' . strtolower($term) . '%'])->limit(7)->get();

        return response()->json($datos);
    }
    public function newcourses(){
        return view('auth.carreras-add');
    }
    public function carreraprocess(Request $request){
        $carreradatos = $request->validate([
            'carrera' => ['required', 'min:3', 'string', 'regex:/^[^\d]*$/'],
        ],[
            'carrera.regex'=>'La carrera no debe contener números',
            'carrera.min'=>'La carrera tiene que tener 3 carácteres como mínimo',
        ]);
        $existeCarrera = Carreras::whereRaw('LOWER(carrera) LIKE ?', ['%' . $request->carrera . '%'])->exists();
        if ($existeCarrera) {
            return redirect()->back()->withErrors(['error'=>'La carrera que está intentando crear ya existe en la base de datos.']);
        }
        $carreradatos['carrera'] = Str::title(strtolower(trim($carreradatos['carrera'])));
        Carreras::create($carreradatos);
        return redirect('/carreras');
    }
    public function nucleo(){
        $nucleos = Nucleos::all();
        return view('auth.registronucleo', compact('nucleos'));
    }
    public function nucleoadd(Request $request){
        // dd($request->all());
        $nucleos = $request->validate([
            'nucleo'=>'required|min:3',
        ],[
            'nucleo.required'=>'Tienes que colocar un nombre al nuevo núcleo que desea Registrar',
            'nucleo.min'=>'Necesitas colocar 3 caráteres como mínimo',
        ]);
        $existeNucleo = Nucleos::whereRaw('LOWER(nucleo) LIKE ?', ['%' . $request->nucleo . '%'])->exists();
        if ($existeNucleo) {
            return redirect()->back()->withErrors(['error'=>'El núcleo que está intentando crear ya existe en la base de datos.']);
        }
        $nucleos['nucleo'] = Str::title(strtolower(trim($nucleos['nucleo'])));
        Nucleos::create($nucleos);
        return redirect('/nucleos');
    }
    public function trayectosview() {
        $trayectos = Trayectos::with('tramos')->get();
        return view('auth.trayectos-tramos', compact('trayectos'));
        /* $tramos = Trayectos::all(); */
        /* return view('auth.trayectos-tramos', compact('tramos')); */
    }
    public function trayectosadd(Request $request){
        $request->validate([
            'trayectos' => 'required|integer|min:1',
        ]);
        $numTrayectos = $request->input('trayectos');
        // Obtener el número máximo actual de trayectos y tramos
        $currentMaxTrayecto = Trayectos::select(DB::raw("MAX(CAST(SUBSTRING_INDEX(trayectos, ' ', -1) AS UNSIGNED)) as max_num"))->value('max_num') ?? 0;
        $currentMaxTramo = Tramos::select(DB::raw("MAX(CAST(SUBSTRING_INDEX(tramos, ' ', -1) AS UNSIGNED)) as max_num"))->value('max_num') ?? 0;
        DB::beginTransaction();
        try{
            for ($i = 1; $i <= $numTrayectos; $i++) {
                // Crear trayecto
                $currentMaxTrayecto++;
                $trayecto = Trayectos::create([
                    'trayectos' => 'Trayecto ' . $currentMaxTrayecto,
                ]);
                // Crear 3 tramos para el trayecto
                for ($j = 1; $j <= 3; $j++) {
                    $currentMaxTramo++;
                    $tramo = Tramos::create([
                        'tramos' => 'Tramo ' . $currentMaxTramo,
                    ]);
                    // Vincular tramo al trayecto
                    $trayecto->tramos()->attach($tramo->id);
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Trayectos creados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear los trayectos: ' . $e->getMessage());
        }
    }
}
