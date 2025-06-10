<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\ConstanciaEstudios;
use App\Models\Inscripciones;
use App\Models\Nucleos;
use App\Models\Sessions;
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
        return redirect('/administracion');
    }
    public function studentadd(){
        $courses = Carreras::orderByRaw('carrera ASC')->get();
        $trayectos = Trayectos::with('tramos')->get();
        $nucleos = Nucleos::orderByRaw('nucleo ASC')->get();
        /* dd($carrera); */
        return view('auth.registro-estudiante', compact('courses', 'trayectos', 'nucleos'));
    }
    public function studentstore(Request $request){
        /* dd(request()->all()); */
        $datosEstudiante = $request->validate([
            'cedula'=>['required', 'numeric','min_digits:7'],
            'primer_name'=>['required','string'],
            'segundo_name'=>['nullable','string'],
            'primer_apellido'=>['required','string'],
            'segundo_apellido'=>['nullable','string'],
            'genero'=>['required','string'],
            'nacionalidad'=>['required'],
            'fecha_nacimiento'=>['required'],
            'email'=>['email','nullable'],
            'telefono'=>['numeric','nullable'],
            'direccion'=>['required','string'],
'city'=>['required','string'],
            'nucleo_id'=>['required','numeric'],
            'carrera_id'=>['required','numeric'],
            'tramo_id'=>['required','numeric'],
        ],[
            'cedula.required'=>'Es necesario que coloque la cédula de identidad del estudiante.',
            'cedula.numeric'=>'La cédula de identidad no debe contener carácteres no númericos.',
            'cedula.min_digits'=>'La longitud de la cédula no coincide con el mínimo requerido.',
            'primer_name.required'=>'Es obligatorio que el estudiante tenga su primer nombre.',
            'primer_name.string'=>'Es obligatorio que el estudiante tenga carácteres y no números en su nombre.',
            'primer_apellido.required'=>'Es obligatorio que el estudiante tenga su primer apellido.',
            'genero.required'=>'Es obligatorio colocar el verdadero genero/sexo del estudiante.',
            'telefono.numeric'=>'No se deben colocar carácteres especiales en el número de teléfono.',
            'email.email'=>'Debe colocar un correo electrónico valido.',
            'fecha_nacimiento.required'=>'Es obligatorio colocar la fecha de nacimiento del estudiante.',
            'direccion.required'=>'Es obligatorio que coloque la dirección donde reside el estudiante',
            'direccion.string'=>'Es obligatorio que no coloque caracteres especiales.',
            'city.required'=>'Es obligatorio colocar la ciudad/pueblo donde reside el estudiante.',
            'city.string'=>'Es obligatorio que no coloque caracteres especiales en la ciudad/pueblo.',
            'nacionalidad.required'=>'Es obligatorio agregar el tipo de nacionalidad del estudiante.',
            'nucleo.required'=>'Es obligatorio agregar el núcleo donde el estudiante va a estudiar.',
            'nucleo.numeric'=>'Es obligatorio que el núcleo no tenga carácteres especiales.',
            'carrera_id.required'=>'Es obligatorio seleccionar la carrera que el estudiante va a estudiar.',
            'carrera_id.numeric'=>'Es obligatorio que la carrera no tenga carácteres especiales.',
            'tramo_id.required'=>'Es obligatorio seleccionar el tramo y trayecto que el estudiante estará asignado/asignada.',
            'tramo_id.numeric'=>'Es obligatorio que el tramo y trayecto que seleccionó no tenga carácteres especiales.',
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

        Students::create($datosEstudiante);
        return redirect('/registro-estudiante');
    }
    public function admindashboard(){
        $user = Auth::user();
        $carreras = Carreras::count();
        $estudiantes = Students::count();
        $nucleos = Nucleos::count();

        return view('admin', compact('user', 'carreras', 'estudiantes', 'nucleos'));
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
    public function autonucleos(Request $request) {
        $term = $request->input('term');
        $datos = Nucleos::whereRaw('LOWER(nucleo) LIKE ?', ['%' . strtolower($term) . '%'])->limit(7)->get();

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
            'nucleo.min'=>'Necesitas colocar 3 carácteres como mínimo',
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
    public function config() {
        $datos = User::all();
        $sesiones = Sessions::where('user_id', Auth::id())->get();
        return view('auth.config', compact('sesiones', 'datos'));
    }
    public function eliminarSesion($id){
        $sesion = Sessions::findOrFail($id);
        if ($sesion->user_id !== Auth::id()) {
            abort(403);
        }
        $sesion->delete();
        return back()->with('status', 'Sesión cerrada exitosamente.');
    }
    public function constanciastudios(){
        $informacion = ConstanciaEstudios::all();
        /* $usuario = Auth::user()->nucleos->nucleo; */
        $usuario = Auth::user();
        /* dd($usuario); */
        return view('auth.constanciaestudios', compact('informacion', 'usuario'));
    }

}
