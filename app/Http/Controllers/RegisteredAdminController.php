<?php

namespace App\Http\Controllers;

use App\Models\Cargos;
use App\Models\Carreras;
use App\Models\ConstanciaEstudios;
use App\Models\Estudios;
use App\Models\Inscripciones;
use App\Models\Nucleos;
use App\Models\Sessions;
use App\Models\Students;
use App\Models\Tipos;
use App\Models\Tramos;
use App\Models\Trayectos;
use App\Models\Trimestres;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
    public function store(Request $request){
        /* dd(request()->all()); */
        $atributos = $request->validate([
            'primer-name' => ['required', 'string'],
            'segundo-name' => ['nullable', 'string'],
            'primer-apellido' => ['required'],
            'segundo-apellido' => ['nullable'],
            'genero' => ['required'],
            'nacionalidad' => ['required'],
            'cedula' => ['required', 'min:7'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:7', 'confirmed'],
            'estudio_id' => ['required', 'numeric'],
            'cargo_id' => ['required', 'numeric'],
            'nucleo_id' => ['required', 'numeric'],
        ],[
            'primer-name.required'=>'Es necesario por lo menos el primer nombre.',
            'primer-apellido.required'=>'Es necesario por lo menos el primer apellido.',
            'password.required'=>'Es necesaria una contraseña',
            'password.confirmed'=>'Las contraseñas no coinciden',
            'password.min'=>'La contraseña debe tener un mínimo de 7 caracteres',
            'cedula.min'=>'Introduzca una cédula válida, compuesta únicamente por números, sin incluir caracteres especiales.',
            'email.required'=>'Debe colocar un correo electrónico valido.',
            'email.email'=>'Debe colocar un correo electrónico valido.',
            'estudio_id.required'=>'Introduzca un estudio válido.',
            'estudio_id.numeric'=>'Introduzca un estudio válido.',
            'cargo_id.required'=>'Introduzca un cargo válido.',
            'cargo_id.numeric'=>'Introduzca un cargo válido.',
            'nucleo_id.required'=>'Introduzca un núcleo válido.',
            'nucleo_id.numeric'=>'Introduzca un núcleo válido.',
        ]);
        User::create($atributos);
        return redirect('/registro-administrador')->with('alert', 'Se creo el usuario correctamente');
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
        $estudio = Estudios::orderByRaw('estudio ASC')->get();
        $cargo = Cargos::orderByRaw('cargo ASC')->get();
        $nucleo = Nucleos::orderByRaw('nucleo ASC')->get();
        return view('auth.registro-admin', compact(['estudio', 'cargo', 'nucleo']));
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
    public function generar(){
        return view('auth.generar');
    }
    public function generarprocess(Request $request){
        /* dd($request); */
        $datosgenerar = $request->validate([
            'cedula'=>['required', 'numeric','min_digits:7'],
        ],[
            'cedula.required'=>'Es necesario que coloque la cédula de identidad del estudiante.',
            'cedula.numeric'=>'La cédula de identidad no debe contener carácteres no númericos.',
            'cedula.min_digits'=>'La longitud de la cédula no coincide con el mínimo requerido.',
        ]);
        $existe = Students::where('cedula', $datosgenerar)->first();
        if (! $existe) {
            return redirect()->back()->withErrors(['cedula'=>'No se encuentra registrado el estudiante con ése número de cédula']);
        }
        if ($request->solicitud == 'record') {
            return redirect()->back()->with('alert','Todavia no funciona esa opcion');
        }
        if ($request->solicitud == 'constancia') {

            $fecha = Carbon::now();

            $diasEnLetras = [
                1 => 'uno', 2 => 'dos', 3 => 'tres', 4 => 'cuatro', 5 => 'cinco',
                6 => 'seis', 7 => 'siete', 8 => 'ocho', 9 => 'nueve', 10 => 'diez',
                11 => 'once', 12 => 'doce', 13 => 'trece', 14 => 'catorce', 15 => 'quince',
                16 => 'dieciséis', 17 => 'diecisiete', 18 => 'dieciocho', 19 => 'diecinueve',
                20 => 'veinte', 21 => 'veintiuno', 22 => 'veintidós', 23 => 'veintitrés',
                24 => 'veinticuatro', 25 => 'veinticinco', 26 => 'veintiséis', 27 => 'veintisiete',
                28 => 'veintiocho', 29 => 'veintinueve', 30 => 'treinta', 31 => 'treinta y uno'
            ];

            $dia = $fecha->day;
            $mes = $fecha->isoFormat('MMMM');
            $anio = $fecha->year;
            $diaTexto = $diasEnLetras[$dia] ?? $dia;

            $opciones = [
                'fontDir' => resource_path('fonts/Courierpdf/'),
            ];
            $informacion = ConstanciaEstudios::all();
            $usuario = Auth::user();
            $estudiante = Students::where('cedula', $datosgenerar)->first();
            $pdf = Pdf::loadView('pdf.constanciaestudios', compact(['informacion', 'usuario', 'estudiante', 'diaTexto', 'mes', 'anio']))->setOption($opciones);
            $filename = 'Constancia_de_estudios_' . $estudiante['primer_name'] . '_' . $estudiante['primer_apellido'] . '_' . $estudiante['cedula'] . '.pdf';
            if ($request->descargar == 'on') {
                return $pdf->download($filename);
            } else {
                return $pdf->stream($filename);
            }
        }
        return view('auth.generar');
    }
    public function generarrecarga(){
        return view('pdf.cerrar');
    }
    public function cargoadd(){
        $tipo = Tipos::all();
        return view('auth.cargoadd', compact('tipo'));
    }
    public function cargosave(Request $request){
        // dd($request);
        if ($request->check == 'on') {
            $atributos = $request->validate([
                'tipo' => 'required|string|max:100|unique:tipos,tipo'
            ],[
                'tipo.required'=>'Es necesario que coloque un tipo de empleo real. Ejemplo: Profesor, Administrador o Secretario',
                'tipo.unique'=>'El tipo de cargo que está creando ya existe',
            ]);
            Tipos::create($atributos);
            return redirect()->route('cargo.index')->with('alert', 'Tipo de cargo creado exitosamente!');
        } else {
            $atributos = $request->validate([
                'cargo' => 'required|string|max:100',
                'tipo_id' => 'required|integer',
            ],[
                'cargo.required'=>'Es necesario que coloque un cargo real. Ejemplo Jefe Administrador',
                'cargo.string'=>'Es necesario que contenga valores alfabeticos y no númericos',
                'cargo.max'=>'No debe se sobrepasar mas de 100 carácteres',
                'tipo_id.required'=>'Debe colocar un tipo de cargo real',
                'tipo_id.integer'=>'No debe contener carácteres especiales',
            ]);
            Cargos::create($atributos);
            return redirect()->route('cargo.index')->with('alert', 'Cargo creado exitosamente!');
        }
    }

}
