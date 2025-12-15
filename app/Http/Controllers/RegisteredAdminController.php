<?php

namespace App\Http\Controllers;

use App\Exports\StudentsList;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Asignar;
use App\Models\Cargos;
use App\Models\Carreras;
use App\Models\ConstanciaEstudios;
use App\Models\Datospresistema;
use App\Models\Estudios;
use App\Models\Materias;
use App\Models\Notas;
use App\Models\Nucleos;
use App\Models\Pensum;
use App\Models\Periodos;
use App\Models\Profesores;
use App\Models\Secciones;
use App\Models\Sessions;
use App\Models\StudentDatoInscripciones;
use App\Models\Students;
use App\Models\StudentsCodigoNucleo;
use App\Models\StudentsInscripciones;
use App\Models\Tipos;
use App\Models\TituloAcademico;
use App\Models\Tramos;
use App\Models\TramoTrayecto;
use App\Models\Trayectos;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisteredAdminController extends Controller
{
    //
    public function create()
    {
        return view('auth.registro-admin');
    }

    public function store(Request $request)
    {
        /* dd(request()->all()); */
        $atributos = $request->validate([
            'primer-name' => ['required', 'string'],
            'segundo-name' => ['nullable', 'string'],
            'primer-apellido' => ['required'],
            'segundo-apellido' => ['nullable'],
            'genero' => ['required'],
            'nacionalidad' => ['required'],
            'cedula' => ['required', 'min:7', 'unique:users,cedula', 'unique:profesores,cedula'],
            'email' => ['required', 'email', 'unique:users,email', 'unique:profesores,email'],
            'password' => ['required', 'min:7', 'confirmed'],
            'estudio_id' => ['required', 'numeric', 'exists:estudios,id'],
            'cargo_id' => ['required', 'numeric', 'exists:cargos,id'],
            'nucleo_id' => ['required', 'numeric', 'exists:nucleos,id'],
        ], [
            'primer-name.required' => 'Es necesario por lo menos el primer nombre.',
            'primer-apellido.required' => 'Es necesario por lo menos el primer apellido.',
            'password.required' => 'Es necesaria una contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener un mínimo de 7 caracteres',
            'cedula.min' => 'Introduzca una cédula válida, compuesta únicamente por números, sin incluir caracteres especiales.',
            'cedula.unique' => 'La persona que está tratando de registrar ya su cédula fue registrada en este sistema.',
            'email.required' => 'Debe colocar un correo electrónico valido.',
            'email.email' => 'Debe colocar un correo electrónico valido.',
            'email.unique' => 'El correo que está tratando de registrar ya fue registrado en este sistema.',
            'estudio_id.required' => 'Introduzca un estudio válido.',
            'estudio_id.numeric' => 'Introduzca un estudio válido.',
            'estudio_id.exists' => 'Introduzca un estudio válido.',
            'cargo_id.required' => 'Introduzca un cargo válido.',
            'cargo_id.numeric' => 'Introduzca un cargo válido.',
            'cargo_id.exists' => 'Introduzca un cargo válido.',
            'nucleo_id.required' => 'Introduzca un núcleo válido.',
            'nucleo_id.numeric' => 'Introduzca un núcleo válido.',
            'nucleo_id.exists' => 'Introduzca un núcleo válido.',
        ]);
        $atributos['primer-name'] = Str::title(ucwords($atributos['primer-name']));
        $atributos['primer-apellido'] = Str::title(ucwords($atributos['primer-apellido']));
        $atributos['nacionalidad'] = Str::upper($atributos['nacionalidad']);
        $atributos['genero'] = Str::lower($atributos['genero']);
        $atributos['email'] = Str::lower($atributos['email']);
        $atributos['segundo-name'] = $atributos['segundo-name'] ? Str::title(ucwords($atributos['segundo-name'])) : null;
        $atributos['segundo-apellido'] = $atributos['segundo-apellido'] ? Str::title(ucwords($atributos['segundo-apellido'])) : null;
        User::create($atributos);
        return redirect('/registro-administrador')->with('alert', 'Se creo el usuario correctamente');
    }

    public function admininfo()
    {
        $administradores = User::wherehas('cargos.tipos', function ($query) {
            $query->where('tipo', 'administrador');
        })->paginate(20);
        return view('auth.administradores-nomina', compact('administradores'));
    }

    public function admindetails($id)
    {
        $administrador = User::all()->findOrFail($id);
        return view('auth.administradores-details', compact('administrador'));
    }

    // =====================================================================================
    // ================= ESTUDIANTE SECCION CONTROLLER =====================================
    // =====================================================================================
    public function studentadd()
    {
        $datos = Auth::user();
        $user = User::where('id', $datos->id)->firstOrFail();
        $courses = Carreras::orderByRaw('carrera ASC')->get();
        $trayectos = Trayectos::with(['tramos' => function ($query) {
            $query->withPivot('id');
        }])->get();
        $nucleos = Nucleos::orderByRaw('nucleo ASC')->get();
        $secciones = Secciones::orderByRaw('seccion ASC')->get();
        $periodo = Periodos::where('activo', true)->first();
        return view('auth.registro-estudiante', compact('courses', 'trayectos', 'nucleos', 'secciones', 'periodo', 'user'));
    }

    public function studentstore(Request $request)
    {
        // dd($request);
        $datosEstudiante = $request->validate([
            'cedula' => ['required', 'numeric', 'min_digits:7'],
            'primer_name' => ['required', 'string'],
            'segundo_name' => ['nullable', 'string'],
            'primer_apellido' => ['required', 'string'],
            'segundo_apellido' => ['nullable', 'string'],
            'genero' => ['required', 'string'],
            'nacionalidad' => ['required'],
            'fecha_nacimiento' => ['required'],
            'email' => ['email', 'nullable'],
            'telefono' => ['numeric', 'nullable'],
            'direccion' => ['required', 'string'],
            'city' => ['required', 'string'],
            'nucleo_id' => ['required', 'numeric'],
            'carrera_id' => ['required', 'numeric', 'exists:carreras,id'],
            'tramo_trayecto_id' => ['required', 'numeric', 'exists:tramo_trayecto,id'],
            'seccion_id' => ['nullable', 'numeric', 'exists:secciones,id'],
            'codigo' => 'nullable|integer',
        ], [
            'cedula.required' => 'Es necesario que coloque la cédula de identidad del estudiante.',
            'cedula.numeric' => 'La cédula de identidad no debe contener carácteres no númericos.',
            'cedula.min_digits' => 'La longitud de la cédula no coincide con el mínimo requerido.',
            'primer_name.required' => 'Es obligatorio que el estudiante tenga su primer nombre.',
            'primer_name.string' => 'Es obligatorio que el estudiante tenga carácteres y no números en su nombre.',
            'primer_apellido.required' => 'Es obligatorio que el estudiante tenga su primer apellido.',
            'genero.required' => 'Es obligatorio colocar el verdadero genero/sexo del estudiante.',
            'telefono.numeric' => 'No se deben colocar carácteres especiales en el número de teléfono.',
            'email.email' => 'Debe colocar un correo electrónico valido.',
            'fecha_nacimiento.required' => 'Es obligatorio colocar la fecha de nacimiento del estudiante.',
            'direccion.required' => 'Es obligatorio que coloque la dirección donde reside el estudiante',
            'direccion.string' => 'Es obligatorio que no coloque caracteres especiales.',
            'city.required' => 'Es obligatorio colocar la ciudad/pueblo donde reside el estudiante.',
            'city.string' => 'Es obligatorio que no coloque caracteres especiales en la ciudad/pueblo.',
            'nacionalidad.required' => 'Es obligatorio agregar el tipo de nacionalidad del estudiante.',
            'nucleo_id.required' => 'Es obligatorio agregar el núcleo donde el estudiante va a estudiar.',
            'nucleo_id.numeric' => 'Es obligatorio que el núcleo no tenga carácteres especiales.',
            'carrera_id.required' => 'Es obligatorio seleccionar la carrera que el estudiante va a estudiar.',
            'carrera_id.numeric' => 'Es obligatorio que la carrera no tenga carácteres especiales.',
            'carrera_id.exists' => 'La carrera no es válida.',
            'tramo_trayecto_id.required' => 'Es obligatorio seleccionar el tramo y trayecto que el estudiante estará asignado/asignada.',
            'tramo_trayecto_id.numeric' => 'Es obligatorio que el tramo y trayecto que seleccionó no tenga carácteres especiales.',
            'tramo_trayecto_id.exists' => 'El tramo y trayecto no es válido.',
            'codigo.integer' => 'Es obligatorio que coloque un código al estudiante con valor numéricos',
        ]);

        $usuario = Auth::user();
        $user = User::with('cargos.tipos')->find($usuario->id);
        $datos = User::where('id', $usuario->id)->firstOrFail();
        $esRoot = $user && $user->cargos()->whereHas('tipos', function ($q) {
            $q->where('tipo', 'superadmin');
        })->exists();

        $nucleo_id = $datos->nucleo_id;
        if ($esRoot) {
            $nucleo_id = $request->nucleo_id;
        } else {
            if ((int) $request->nucleo_id !== (int) $datos->nucleo_id) {
                return redirect()->back()->withInput()->withErrors([
                    'error' => 'No tiene permiso para cambiar el núcleo asignado.'
                ]);
            }
        }
        $periodo = Periodos::where('activo', true)->first();

        if (!$periodo) {
            return redirect()->back()->withInput()->withErrors(['error' => 'El periodo que está tratando de usar está cerrado.']);
        }

        $studentsExist = Students::where('cedula', $request->cedula)->first();
        $tramo = TramoTrayecto::with('tramos')->find($request->tramo_trayecto_id);
        $ultimoCodigo = StudentsCodigoNucleo::where('nucleo_id', $nucleo_id)->max('codigo');

        if (!$tramo) {
            return redirect()->back()->withInput()->withErrors([
                'tramo_trayecto_id' => 'El tramo y trayecto seleccionado no existe.'
            ]);
        }
        if ($tramo->id === 1) {
            if (is_null($studentsExist)) {
                if (empty($ultimoCodigo)) {
                    if (is_null($request->codigo)) {
                        return redirect()->back()->withInput()->withErrors([
                            'error' => 'Está registrando al primer estudiante, por favor ingrese el código manualmente del último estudiante inscripto en el trayecto inicial (el valor mas alto para seguir con la secuencia en tú núcleo)'
                        ]);
                    } else {
                        $codigo = $request->codigo;
                    }
                } else {
                    $codigo = (int) $ultimoCodigo + 1;
                }
            } else {
                $codigoStudent = StudentsCodigoNucleo::where('students_data_id', $studentsExist->id)
                    ->where('nucleo_id', $nucleo_id)
                    ->first();
                if ($codigoStudent) {
                    $inscripcionExistente = StudentsInscripciones::where('students_codigo_nucleo_id', $codigoStudent->id)
                    ->where('carrera_id', $request->carrera_id)
                    ->where('periodo_id', $periodo->id)
                    ->first();
                    if ($inscripcionExistente) {
                        return redirect()->back()->withInput()->withErrors([
                            'error' => 'El estudiante ya está inscrito en esta carrera y periodo.'
                        ]);
                    }
                     $codigo = $codigoStudent->codigo;
                }
            }
        } else {
            $codigoStudent = StudentsCodigoNucleo::where('students_data_id', $studentsExist->id)
                ->where('nucleo_id', $nucleo_id)
                ->first();
            if (is_null($codigoStudent)) {
                if (empty($ultimoCodigo)) {
                    return redirect()->back()->withInput()->withErrors([
                        'error' => 'Está registrando al primer estudiante, por favor ingrese el código manualmente del último estudiante inscripto en el trayecto inicial (el valor mas alto para seguir con la secuencia en tú núcleo)'
                    ]);
                } else {
                    $codigo = (int) $ultimoCodigo + 1;
                }
            } else {
                $inscripcionExistente = StudentsInscripciones::where('students_codigo_nucleo_id', $codigoStudent->id)
                    ->where('carrera_id', $request->carrera_id)
                    ->where('periodo_id', $periodo->id)
                    ->first();
                if ($inscripcionExistente) {
                    return redirect()->back()->withInput()->withErrors([
                        'error' => 'El estudiante ya está inscrito en esta carrera y periodo.'
                    ]);
                }
                if (is_null($request->codigo)) {
                    $codigo = $codigoStudent->codigo;
                } elseif ($request->codigo !== $codigoStudent->codigo) {
                    return redirect()->back()->withInput()->withErrors(['error' => 'El código que le estas asignado a este estudiante no corresponde con una inscripción anterior en este núcleo, si no recuerda su código dejalo en blanco para que el sistema lo haga automáticamente.']);
                } else {
                    $codigo = $request->codigo;
                }
            }
        }

        $materiasPensum = Pensum::where('carrera_id', $request->carrera_id)
            ->where('tramo_trayecto_id', $request->tramo_trayecto_id)
            ->get();

        if ($materiasPensum->isEmpty()) {
            return redirect()->back()->withInput()->withErrors(['error' => 'No se puede inscribir al estudiante, no existe un pensum definido para esta carrera y tramo.']);
        }

        if (!$studentsExist) {
            $datosStudent = [
                'primer_name' => Str::title(ucwords($request->primer_name)),
                'segundo_name' => $request->segundo_name ? Str::title(ucwords($request->segundo_name)) : null,
                'primer_apellido' => Str::title(ucwords($request->primer_apellido)),
                'segundo_apellido' => $request->segundo_apellido ? Str::title(ucwords($request->segundo_apellido)) : null,
                'genero' => Str::lower($request->genero),
                'nacionalidad' => Str::upper($request->nacionalidad),
                'cedula' => $request->cedula,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'email' => $request->email ? Str::lower($request->email) : null,
                'direccion' => Str::title(ucwords($request->direccion)),
                'city' => Str::title(ucwords($request->city)),
            ];
            $student = Students::create($datosStudent);

            $studentCodigoNucleo = [
                'students_data_id' => $student->id,
                'nucleo_id' => $nucleo_id,
                'codigo' => $codigo,
            ];
            $studentCodigoNucleoCreate = StudentsCodigoNucleo::create($studentCodigoNucleo);
            StudentsInscripciones::create([
                'students_codigo_nucleo_id' => $studentCodigoNucleoCreate->id,
                'carrera_id' => $request->carrera_id,
                'tramo_trayecto_id' => $request->tramo_trayecto_id,
                'seccion_id' => $request->seccion_id,
                'periodo_id' => $periodo->id,
            ]);
            foreach ($materiasPensum as $materia) {
                Notas::create([
                    'pensum_id' => $materia->id,
                    'students_codigo_nucleo_id' => $studentCodigoNucleoCreate->id,
                    'periodo_id' => $periodo->id,
                    'nota' => null
                ]);
            }
        } else {
            $idStudent = StudentsCodigoNucleo::where('students_data_id', $studentsExist->id)
                ->where('nucleo_id', $nucleo_id)
                ->first();
            if (is_null($idStudent)) {
                if (empty($ultimoCodigo)) {
                    if (is_null($request->codigo)) {
                        return redirect()->back()->withInput()->withErrors([
                            'error' => 'Está registrando al primer estudiante, por favor ingrese el código manualmente del último estudiante inscripto en el trayecto inicial (el valor mas alto para seguir con la secuencia en tú núcleo)'
                        ]);
                    } else {
                        $codigo = $request->codigo;
                    }
                } else {
                    $codigo = (int) $ultimoCodigo + 1;
                }
                $studentCodigoNucleo = [
                    'students_data_id' => $studentsExist->id,
                    'nucleo_id' => $nucleo_id,
                    'codigo' => $codigo,
                ];
                $studentCodigoNucleoCreate = StudentsCodigoNucleo::create($studentCodigoNucleo);

                StudentsInscripciones::create([
                    'students_codigo_nucleo_id' => $studentCodigoNucleoCreate->id,
                    'carrera_id' => $request->carrera_id,
                    'tramo_trayecto_id' => $request->tramo_trayecto_id,
                    'seccion_id' => $request->seccion_id,
                    'periodo_id' => $periodo->id,
                ]);
                foreach ($materiasPensum as $materia) {
                    Notas::create([
                        'pensum_id' => $materia->id,
                        'students_codigo_nucleo_id' => $studentCodigoNucleoCreate->id,
                        'periodo_id' => $periodo->id,
                        'nota' => null
                    ]);
                }
            } else {
                StudentsInscripciones::create([
                    'students_codigo_nucleo_id' => $idStudent->id,
                    'carrera_id' => $request->carrera_id,
                    'tramo_trayecto_id' => $request->tramo_trayecto_id,
                    'seccion_id' => $request->seccion_id,
                    'periodo_id' => $periodo->id,
                ]);
                foreach ($materiasPensum as $materia) {
                    Notas::create([
                        'pensum_id' => $materia->id,
                        'students_codigo_nucleo_id' => $idStudent->id,
                        'periodo_id' => $periodo->id,
                        'nota' => null
                    ]);
                }
            }
            $student = $studentsExist;
        }
        if (is_null($student)) {
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Error interno: No se pudo determinar el estudiante.'
            ]);
        }
        return redirect()->back()->with('alert', 'El estudiante fue registado correctamente. ' . $codigo);
    }

    public function studentedit($estudiante)
    {
        $estudiantes = Students::findOrFail($estudiante);
        $trayectos = Trayectos::with(['tramos' => function ($query) {
            $query->withPivot('id');
        }])->get();
        $courses = Carreras::orderByRaw('carrera ASC')->get();
        $nucleos = Nucleos::orderByRaw('nucleo ASC')->get();
        $secciones = Secciones::orderByRaw('seccion ASC')->get();
        $periodo = Periodos::where('activo', true)->first();
        return view('auth.studentedit', compact('estudiantes', 'courses', 'trayectos', 'nucleos', 'secciones', 'periodo'));
    }

    public function savestudentedit(Request $request)
    {
        $validar = $request->validate([
            'cedula' => ['required', 'numeric', 'min_digits:7'],
            'primer_name' => ['required', 'string'],
            'segundo_name' => ['nullable', 'string'],
            'primer_apellido' => ['required', 'string'],
            'segundo_apellido' => ['nullable', 'string'],
            'genero' => ['required', 'string'],
            'nacionalidad' => ['required'],
            'fecha_nacimiento' => ['required'],
            'email' => ['email', 'nullable'],
            'telefono' => ['numeric', 'nullable'],
            'direccion' => ['required', 'string'],
            'city' => ['required', 'string'],
            'nucleo_id' => ['required', 'numeric'],
            'carrera_id' => ['required', 'numeric', 'exists:carreras,id'],
            'tramo_trayecto_id' => ['required', 'numeric', 'exists:tramo_trayecto,id'],
            'seccion_id' => ['nullable', 'numeric', 'exists:secciones,id'],
            'estudiante_id' => 'required|numeric|exists:students,id',
            'periodo_id' => 'required|numeric|exists:periodos,id',
        ], [
            'cedula.required' => 'Es necesario que coloque la cédula de identidad del estudiante.',
            'cedula.numeric' => 'La cédula de identidad no debe contener carácteres no númericos.',
            'cedula.min_digits' => 'La longitud de la cédula no coincide con el mínimo requerido.',
            'primer_name.required' => 'Es obligatorio que el estudiante tenga su primer nombre.',
            'primer_name.string' => 'Es obligatorio que el estudiante tenga carácteres y no números en su nombre.',
            'primer_apellido.required' => 'Es obligatorio que el estudiante tenga su primer apellido.',
            'genero.required' => 'Es obligatorio colocar el verdadero genero/sexo del estudiante.',
            'telefono.numeric' => 'No se deben colocar carácteres especiales en el número de teléfono.',
            'email.email' => 'Debe colocar un correo electrónico valido.',
            'fecha_nacimiento.required' => 'Es obligatorio colocar la fecha de nacimiento del estudiante.',
            'direccion.required' => 'Es obligatorio que coloque la dirección donde reside el estudiante',
            'direccion.string' => 'Es obligatorio que no coloque caracteres especiales.',
            'city.required' => 'Es obligatorio colocar la ciudad/pueblo donde reside el estudiante.',
            'city.string' => 'Es obligatorio que no coloque caracteres especiales en la ciudad/pueblo.',
            'nacionalidad.required' => 'Es obligatorio agregar el tipo de nacionalidad del estudiante.',
            'nucleo.required' => 'Es obligatorio agregar el núcleo donde el estudiante va a estudiar.',
            'nucleo.numeric' => 'Es obligatorio que el núcleo no tenga carácteres especiales.',
            'carrera_id.required' => 'Es obligatorio seleccionar la carrera que el estudiante va a estudiar.',
            'carrera_id.numeric' => 'Es obligatorio que la carrera no tenga carácteres especiales.',
            'carrera_id.exists' => 'La carrera no es válida.',
            'tramo_trayecto_id.required' => 'Es obligatorio seleccionar el tramo y trayecto que el estudiante estará asignado/asignada.',
            'tramo_trayecto_id.numeric' => 'Es obligatorio que el tramo y trayecto que seleccionó no tenga carácteres especiales.',
            'tramo_trayecto_id.exists' => 'El tramo y trayecto no es válido.',
        ]);
        $student = Students::find($request->estudiante_id);
        if (!$student) {
            return redirect()->back()->withErrors(['error' => 'El identificador del estudiante no es válido']);
        }
        $igual = Students::where('cedula', $request->cedula)
            ->where('carrera_id', $request->carrera_id)
            ->where('tramo_trayecto_id', $request->tramo_trayecto_id)
            ->where('periodo_id', '!=', $request->periodo_id)
            ->where('id', '!=', $student)
            ->exists();

        if ($igual) {
            return redirect()->back()->withErrors(['error' => 'El estudiante que está tratando de editar ya está registrado en el mismo periodo académico']);
        }
        $materiasPensum = Pensum::where('carrera_id', $request->carrera_id)
            ->where('tramo_trayecto_id', $request->tramo_trayecto_id)
            ->get();

        if ($materiasPensum->isEmpty()) {
            return redirect()->back()->withInput()->withErrors(['error' => 'No se puede editar al estudiante, no existe un pensum definido para esta carrera y tramo.']);
        }

        $validar['primer_name'] = Str::title(ucwords($validar['primer_name']));
        $validar['segundo_name'] = $validar['segundo_name'] ? Str::title(ucwords($validar['segundo_name'])) : null;
        $validar['primer_apellido'] = Str::title(ucwords($validar['primer_apellido']));
        $validar['segundo_apellido'] = $validar['segundo_apellido'] ? Str::title(ucwords($validar['segundo_apellido'])) : null;
        $validar['genero'] = Str::lower($validar['genero']);
        $validar['nacionalidad'] = Str::upper($validar['nacionalidad']);
        $validar['email'] = $validar['email'] ? Str::lower($validar['email']) : null;
        $validar['direccion'] = Str::title(ucwords($validar['direccion']));
        $validar['city'] = Str::title(ucwords($validar['city']));
        $student->update($validar);

        foreach ($materiasPensum as $materia) {
            Notas::firstOrCreate([
                'pensum_id' => $materia->id,
                'student_id' => $student->id,
                'periodo_id' => $request->periodo_id,
            ], [
                'nota' => null
            ]);
        }
        return redirect('/estudiantes-panel-administrativo/' . $student->id)->with('alert', 'El estudiante fue actualizado correctamente.');
    }

    public function admindashboard()
    {
        $user = Auth::guard('admins')->user() ?? Auth::guard('root')->user();
        if (!$user) {
            return redirect('/login');
        }
        $usuario = Auth::user();
        $datos = User::where('id', $usuario->id)->firstOrFail();
        // $mujeres = Students::where('genero', 'femenino')
        //     ->whereHas('studentsDataInscripcion.studentsInscripcion', function($n) use ($datos) {
        //         $n->where('nucleo_id', $datos->nucleo_id);
        //     })
        //     ->count();
        // $hombres = Students::where('genero', 'masculino')
        //     ->whereHas('studentsDataInscripcion.studentsInscripcion', function($u) use ($datos) {
        //         $u->where('nucleo_id', $datos->nucleo_id);
        //     })
        //     ->count();
        $activo = Periodos::where('activo', true)->where('nucleo_id', $datos->nucleo_id)->first();
        // $graficoGeneros = [
        //     'hombres' => $hombres,
        //     'mujeres' => $mujeres,
        // ];
        // $carreras = Carreras::count();
        // $estudiantes = Students::count();
        // $nucleos = Nucleos::count();
        //
        return view('auth.dashSection',
            compact(
                'user',
                // 'carreras',
                // 'estudiantes',
                // 'nucleos',
                'activo',
                // 'graficoGeneros'
            )
        );
    }

    public function datadetails()
    {
        $usuario = Auth::user();
        $user = User::with('cargos.tipos')->find($usuario->id);
        $datos = User::where('id', $usuario->id)->firstOrFail();
        $esRoot = $user && $user->cargos()->whereHas('tipos', function ($q) {
            $q->where('tipo', 'superadmin');
        })->exists();

        $graficoPorCarrera = [];

        if (!$esRoot) {
            $conteoPorCarrera = Students::selectRaw('carrera_id, genero, count(*) as total')
                ->where('nucleo_id', $datos->nucleo_id)
                ->groupBy('carrera_id', 'genero')
                ->get();

            $carreraIds = $conteoPorCarrera->pluck('carrera_id')->unique()->toArray();

            $carreras = Carreras::whereIn('id', $carreraIds)->pluck('carrera', 'id');

            $carrerasLabels = $carreras->values()->toArray(); // Nombres de las carreras
            $hombresData = array_fill(0, count($carrerasLabels), 0); // Inicializar a 0
            $mujeresData = array_fill(0, count($carrerasLabels), 0); // Inicializar a 0

            foreach ($conteoPorCarrera as $conteo) {
                $carreraNombre = $carreras[$conteo->carrera_id] ?? 'Desconocida';
                $index = array_search($carreraNombre, $carrerasLabels);

                if ($index !== false) {
                    if ($conteo->genero === 'masculino') {
                        $hombresData[$index] = $conteo->total;
                    } elseif ($conteo->genero === 'femenino') {
                        $mujeresData[$index] = $conteo->total;
                    }
                }
            }

            $graficoPorCarrera = [
                'labels' => $carrerasLabels,
                'hombres' => $hombresData,
                'mujeres' => $mujeresData,
            ];
        } else {
            $conteoPorCarrera = Students::selectRaw('carrera_id, genero, count(*) as total')
                ->groupBy('carrera_id', 'genero')
                ->get();

            $carreraIds = $conteoPorCarrera->pluck('carrera_id')->unique()->toArray();

            $carreras = Carreras::whereIn('id', $carreraIds)->pluck('carrera', 'id');

            $carrerasLabels = $carreras->values()->toArray(); // Nombres de las carreras
            $hombresData = array_fill(0, count($carrerasLabels), 0); // Inicializar a 0
            $mujeresData = array_fill(0, count($carrerasLabels), 0); // Inicializar a 0

            foreach ($conteoPorCarrera as $conteo) {
                $carreraNombre = $carreras[$conteo->carrera_id] ?? 'Desconocida';
                $index = array_search($carreraNombre, $carrerasLabels);

                if ($index !== false) {
                    if ($conteo->genero === 'masculino') {
                        $hombresData[$index] = $conteo->total;
                    } elseif ($conteo->genero === 'femenino') {
                        $mujeresData[$index] = $conteo->total;
                    }
                }
            }

            $graficoPorCarrera = [
                'labels' => $carrerasLabels,
                'hombres' => $hombresData,
                'mujeres' => $mujeresData,
            ];
        }

        return view('auth.datadetails', compact('graficoPorCarrera'));
    }

    public function exportStudentData(){
        return Excel::download(new StudentsList, 'EstadisticasGeneroEstudiantes.xlsx');
    }

    public function studentsadmin()
    {
        // $usuario = Auth::user();
        // $user = User::with('cargos.tipos')->find($usuario->id);
        // $nucleo = User::where('id', $usuario->id)->firstOrFail();
        // $esRoot = $user && $user->cargos()->whereHas('tipos', function ($q) {
        //     $q->where('tipo', 'superadmin');
        // })->exists();
        // if (!$esRoot) {
        //     $estudiantes = Students::where('nucleo_id', $nucleo->nucleo_id)->orderByRaw('created_at DESC')->paginate(20);
        //     $carreras = Carreras::all();
        // } else {
        //     $estudiantes = Students::orderByRaw('created_at DESC')->paginate(20);
        //     $carreras = Carreras::all();
        // }
        // return view('auth.students', compact('estudiantes', 'carreras'));
        return view('auth.students');
    }

    public function studentsadmincalification($id)
    {
        $estudiante = Students::all()->findOrFail($id);
        $notas = Notas::with('pensums.materias')->where('student_id', $id)->get();
        return view('auth.students-calification', compact('estudiante', 'notas'));
    }

    public function studentsadmindetails($id)
    {
        $estudiantes = Students::with(['tramos.trayectos'])->findOrFail($id);
        $nota = Notas::all();
        $student = Trayectos::with('tramos')->get();
        return view('auth.students-details', compact('estudiantes', 'student'));
    }

    public function studentsadminsearch(Request $request)
    {
        // dd($request['carreras']);
        if ($request['carreras'] === '0') {
            $validar = $request->validate([
                'carreras' => ['required', 'numeric'],
                'search' => ['required', 'string', 'min:4']
            ], [
                'carreras.required' => 'Introduzca Una Opción Para Buscar',
                'carreras.numeric' => 'Introduzca Un Valor Númerico',
                'search.required' => ucwords('Por favor, ingresa un término de búsqueda'),
                'search.string' => 'Debes Colocar Carácteres De Texto',
                'search.min' => 'Introduzca Minimo 4 Dígitos En La Busqueda',
            ]);
        } else {
            $validar = $request->validate([
                'carreras' => ['required', 'numeric', 'exists:carreras,id'],
                'search' => ['required', 'string', 'min:4']
            ], [
                'carreras.required' => 'Introduzca Una Opción Para Buscar',
                'carreras.numeric' => 'Introduzca Un Valor Númerico',
                'carreras.exists' => 'Introduzca Una Carrera Registrada',
                'search.required' => ucwords('Por favor, ingresa un término de búsqueda'),
                'search.string' => 'Debes Colocar Carácteres De Texto',
                'search.min' => 'Introduzca Minimo 4 Dígitos En La Busqueda',
            ]);
        }

        $carrera = $validar['carreras'];
        $search = $validar['search'];
        $usuario = Auth::user();
        $user = User::with('cargos.tipos')->find($usuario->id);
        $nucleo = User::where('id', $usuario->id)->firstOrFail();
        $esRoot = $user && $user->cargos()->whereHas('tipos', function ($q) {
            $q->where('tipo', 'superadmin');
        })->exists();
        if (!$esRoot) {
            // $estudiantes = Students::where('nucleo_id', $nucleo->nucleo_id)->orderByRaw('created_at DESC')->paginate(20);
            $estudiantes = Students::where(function ($query) use ($search) {
                $query
                    ->where('cedula', 'LIKE', "%{$search}%")
                    ->orWhere('codigo', 'LIKE', "%{$search}%")
                    ->orWhere('primer_name', 'LIKE', "%{$search}%")
                    ->orWhere('segundo_name', 'LIKE', "%{$search}%")
                    ->orWhere('primer_apellido', 'LIKE', "%{$search}%")
                    ->orWhere('segundo_apellido', 'LIKE', "%{$search}%")
                    ->orWhere('telefono', 'LIKE', "%{$search}%")
                    ->orWhere('direccion', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%");
            })->when($carrera !== '0', function ($query) use ($carrera) {
                $query->where('carrera_id', $carrera);
            })->orderByRaw('created_at DESC')->paginate(20);
            $carreras = Carreras::all();
        } else {
            $estudiantes = Students::orderByRaw('created_at DESC')->paginate(20);
            $carreras = Carreras::all();
        }
        return view('auth.students', compact('estudiantes', 'carreras', 'carrera', 'search'));
    }

    public function adminadd()
    {
        $estudio = Estudios::orderByRaw('estudio ASC')->get();
        $cargo = Cargos::wherehas('tipos', function ($query) {
            $query->where('tipo', 'administrador');
        })->orderByRaw('cargo ASC')->get();
        $nucleo = Nucleos::orderByRaw('nucleo ASC')->get();
        return view('auth.registro-admin', compact(['estudio', 'cargo', 'nucleo']));
    }

    public function profesornomina()
    {
        $docentes = Profesores::orderByRaw('created_at DESC')->paginate(20);
        return view('auth.profesores-nomina', compact('docentes'));
    }

    public function teacheradd()
    {
        $estudio = Estudios::orderByRaw('estudio ASC')->get();
        $cargo = Cargos::whereHas('tipos', function ($query) {
            $query->where('tipo', 'profesor');
        })->orderByRaw('cargo ASC')->get();
        $nucleo = Nucleos::orderByRaw('nucleo ASC')->get();
        return view('auth.registro-profesor', compact(['estudio', 'cargo', 'nucleo']));
    }

    public function teacherstore(Request $request)
    {
        $atributos = $request->validate([
            'primer-name' => ['required', 'string'],
            'segundo-name' => ['nullable', 'string'],
            'primer-apellido' => ['required'],
            'segundo-apellido' => ['nullable'],
            'genero' => ['required'],
            'nacionalidad' => ['required'],
            'cedula' => ['required', 'min:7', 'unique:profesores,cedula', 'unique:users,cedula'],
            'email' => ['required', 'email', 'unique:profesores,email', 'unique:users,email'],
            'password' => ['required', 'min:7', 'confirmed'],
            'estudio_id' => ['required', 'numeric', 'exists:estudios,id'],
            'cargo_id' => ['required', 'numeric'],
            'nucleo_id' => ['required', 'numeric', 'exists:nucleos,id'],
        ], [
            'primer-name.required' => 'Es necesario por lo menos el primer nombre.',
            'primer-apellido.required' => 'Es necesario por lo menos el primer apellido.',
            'password.required' => 'Es necesaria una contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener un mínimo de 7 caracteres',
            'cedula.min' => 'Introduzca una cédula válida, compuesta únicamente por números, sin incluir caracteres especiales.',
            'cedula.unique' => 'La persona que está tratando de registrar ya su cédula fue registrada en este sistema.',
            'email.required' => 'Debe colocar un correo electrónico valido.',
            'email.email' => 'Debe colocar un correo electrónico valido.',
            'email.unique' => 'El correo/Email que está tratando de usar ya está registrado en el sistema.',
            'estudio_id.required' => 'Introduzca un estudio válido.',
            'estudio_id.numeric' => 'Introduzca un estudio válido.',
            'estudio_id.exists' => 'Introduzca un estudio válido.',
            'cargo_id.required' => 'Introduzca un cargo válido.',
            'cargo_id.numeric' => 'Introduzca un cargo válido.',
            'nucleo_id.required' => 'Introduzca un núcleo válido.',
            'nucleo_id.numeric' => 'Introduzca un núcleo válido.',
            'nucleo_id.exists' => 'Introduzca un núcleo válido.',
        ]);
        Profesores::create($atributos);
        return redirect()->back()->with('alert', 'Se creo el usuario correctamente');
    }

    public function teacherinfo($id)
    {
        $docentes = Profesores::all()->findOrFail($id);
        return view('auth.profesores-details', compact('docentes'));
    }

    /* public function courses(){ */
    /* $courses = Carreras::all(); */
    /* $trayectos = Trayectos::with('tramos')->get(); */
    /* return view('auth.courses', compact('courses', 'trayectos')); */

    /* } */
    public function courses()
    {
        $courses = Carreras::all();
        $tra = Trayectos::with('tramos')->get();
        return view('auth.superadmin.courses', compact('courses', 'tra'));
    }

    public function autocourses(Request $request)
    {
        $term = $request->input('term');
        $datos = Carreras::whereRaw('LOWER(carrera) LIKE ?', ['%' . strtolower($term) . '%'])->limit(7)->get();

        return response()->json($datos);
    }

    public function autonucleos(Request $request)
    {
        $term = $request->input('term');
        $datos = Nucleos::whereRaw('LOWER(nucleo) LIKE ?', ['%' . strtolower($term) . '%'])->limit(7)->get();

        return response()->json($datos);
    }

    public function searchpensum(Request $request)
    {
        $term = $request->input('term');
        $datos = Materias::whereRaw('LOWER(materia) LIKE ?', ['%' . strtolower($term) . '%'])->orWhereRaw('LOWER(codigo) LIKE ?', ['%' . strtolower($term) . '%'])->limit(7)->get(['id', 'materia', 'codigo']);

        return response()->json($datos);
    }

    public function carreraprocess(Request $request)
    {
        $carreradatos = $request->validate([
            'carrera' => ['required', 'min:3', 'string', 'regex:/^[^\d]*$/'],
        ], [
            'carrera.regex' => 'La carrera no debe contener números',
            'carrera.min' => 'La carrera tiene que tener 3 carácteres como mínimo',
        ]);
        $existeCarrera = Carreras::whereRaw('LOWER(carrera) LIKE ?', ['%' . $request->carrera . '%'])->exists();
        if ($existeCarrera) {
            return redirect()->back()->withErrors(['error' => 'La carrera que está intentando crear ya existe en la base de datos.']);
        }
        $carreradatos['carrera'] = Str::title(strtolower(trim($carreradatos['carrera'])));
        Carreras::create($carreradatos);
        return redirect('/carreras')->with('alert', 'La carrera se creó con exito.');
    }

    public function carreraedit($id)
    {
        $courses = Carreras::all()->findOrFail($id);
        return view('auth.superadmin.editcourses', compact('courses'));
    }

    public function cambiarcarrera(Request $request, $id)
    {
        $request->validate([
            'carrera' => ['required', 'min:3', 'string', 'regex:/^[^\d]*$/'],
        ], [
            'carrera.regex' => 'La carrera no debe contener números',
            'carrera.min' => 'La carrera tiene que tener 3 carácteres como mínimo',
        ]);
        $carreranormalizada = Str::title(strtolower(trim($request->carrera)));

        $existeCarrera = Carreras::where('id', '!=', $id)->whereRaw('LOWER(carrera) LIKE ?', [strtolower($carreranormalizada)])->exists();
        if ($existeCarrera) {
            return redirect()->back()->withErrors(['error' => 'La carrera que está intentando crear ya existe en la base de datos.']);
        }
        Carreras::where('id', $id)->update(['carrera' => $carreranormalizada]);

        return redirect('/carreras')->with('alert', 'Se guardó con exito los cambios');
    }

    public function searchseccion(Request $request)
    {
        $term = $request->input('term');
        $datos = Secciones::whereRaw('LOWER(seccion) LIKE ?', ['%' . strtolower($term) . '%'])->limit(7)->get();

        return response()->json($datos);
    }

    public function seccionadd(Request $request)
    {
        $secciondatos = $request->validate([
            'seccion' => ['required', 'min:1', 'string', 'regex:/^[^\d]*$/'],
        ], [
            'seccion.regex' => 'La sección no debe contener números',
            'seccion.min' => 'La sección tiene que tener 1 carácter como mínimo',
        ]);
        $existeSeccion = Secciones::whereRaw('LOWER(seccion) LIKE ?', ['%' . $request->seccion . '%'])->exists();
        if ($existeSeccion) {
            return redirect()->back()->withErrors(['error' => 'La sección que está intentando crear ya existe en la base de datos.']);
        }
        $secciondatos['seccion'] = Str::title(strtolower(trim($secciondatos['seccion'])));
        Secciones::create($secciondatos);
        return redirect()->back()->with('alert', 'La sección se creó con exito.');
    }

    public function nucleo()
    {
        $nucleos = Nucleos::all();
        return view('auth.superadmin.registronucleo', compact('nucleos'));
    }

    public function nucleoadd(Request $request)
    {
        // dd($request->all());
        $nucleos = $request->validate([
            'nucleo' => 'required|min:3',
        ], [
            'nucleo.required' => 'Tienes que colocar un nombre al nuevo núcleo que desea Registrar',
            'nucleo.min' => 'Necesitas colocar 3 carácteres como mínimo',
        ]);
        $existeNucleo = Nucleos::whereRaw('LOWER(nucleo) LIKE ?', ['%' . $request->nucleo . '%'])->exists();
        if ($existeNucleo) {
            return redirect()->back()->withErrors(['error' => 'El núcleo que está intentando crear ya existe en la base de datos.']);
        }
        $nucleos['nucleo'] = Str::title(strtolower(trim($nucleos['nucleo'])));
        Nucleos::create($nucleos);
        return redirect('/nucleos');
    }

    public function nucleoedit($id)
    {
        $nucleo = Nucleos::all()->findOrFail($id);
        return view('auth.superadmin.nucleoedit', compact('nucleo'));
    }

    public function editnucleosave(Request $request, $id)
    {
        $request->validate([
            'nucleo' => ['required', 'min:3', 'string', 'regex:/^[^\d]*$/'],
        ], [
            'nucleo.required' => 'El núcleo no debe estar vacío',
            'nucleo.regex' => 'El núcleo no debe contener números',
            'nucleo.min' => 'El núcleo debe de tener 3 carácteres como mínimo',
        ]);
        $nucleonormalizada = Str::title(strtolower(trim($request->nucleo)));

        $existeNucleo = Nucleos::where('id', '!=', $id)->whereRaw('LOWER(nucleo) LIKE ?', [strtolower($nucleonormalizada)])->exists();
        if ($existeNucleo) {
            return redirect()->back()->withErrors(['error' => 'El núcleo que está intentando guardar ya existe en la base de datos.']);
        }
        Nucleos::where('id', $id)->update(['nucleo' => $nucleonormalizada]);
        return redirect('/nucleos')->with('alert', 'Se guardó con exito los cambios');
    }

    public function trayectosview()
    {
        $trayectos = Trayectos::with('tramos')->get();
        return view('auth.superadmin.trayectos-tramos', compact('trayectos'));
        /* $tramos = Trayectos::all(); */
        /* return view('auth.trayectos-tramos', compact('tramos')); */
    }

    public function trayectosadd(Request $request)
    {
        $request->validate([
            'trayectos' => 'required|integer|min:1',
        ]);
        $numTrayectos = $request->input('trayectos');
        // Obtener el número máximo actual de trayectos y tramos
        $currentMaxTrayecto = Trayectos::select(DB::raw("MAX(CAST(SUBSTRING_INDEX(trayectos, ' ', -1) AS UNSIGNED)) as max_num"))->value('max_num') ?? 0;
        $currentMaxTramo = Tramos::select(DB::raw("MAX(CAST(SUBSTRING_INDEX(tramos, ' ', -1) AS UNSIGNED)) as max_num"))->value('max_num') ?? 0;
        DB::beginTransaction();
        try {
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

    public function config()
    {
        $usuario = Auth::user();
        $datos = User::where('id', $usuario->id)->firstOrFail();
        // dd($datos);
        $sesiones = Sessions::where('user_id', Auth::id())->get();
        return view('auth.config', compact('sesiones', 'datos'));
    }

    public function saveconfigbasic(Request $request)
    {
        $validar = $request->validate([
            'primer-name' => ['required', 'string'],
            'segundo-name' => ['nullable', 'string'],
            'primer-apellido' => ['required'],
            'segundo-apellido' => ['nullable'],
            'genero' => ['required'],
            'nacionalidad' => ['required'],
            'cedula' => ['required', 'min:7'],
        ], [
            'primer-name.required' => 'Es necesario por lo menos el primer nombre.',
            'primer-apellido.required' => 'Es necesario por lo menos el primer apellido.',
            'cedula.min' => 'Introduzca una cédula válida, compuesta únicamente por números, sin incluir caracteres especiales.',
            'cedula.unique' => 'La persona que está tratando de registrar ya su cédula fue registrada en este sistema.',
        ]);
        $usuario = Auth::user();
        $validar['primer-name'] = Str::title(ucwords($validar['primer-name']));
        $validar['primer-apellido'] = Str::title(ucwords($validar['primer-apellido']));
        $validar['genero'] = Str::lower($validar['genero']);
        $validar['nacionalidad'] = Str::upper($validar['nacionalidad']);
        $validar['segundo-name'] = $validar['segundo-name'] ? Str::title(ucwords($validar['segundo-name'])) : null;
        $validar['segundo-apellido'] = $validar['segundo-apellido'] ? Str::title(ucwords($validar['segundo-apellido'])) : null;
        User::where('id', $usuario->id)->update($validar);
        return redirect()->back()->with('alert', 'Se guardaron los cambios de la configuración con exito');
    }

    public function eliminarSesion($id)
    {
        $sesion = Sessions::findOrFail($id);
        if ($sesion->user_id !== Auth::id()) {
            abort(403);
        }
        $sesion->delete();
        return back()->with('status', 'Sesión cerrada exitosamente.');
    }

    // ======================================================
    //      GENERAR
    // ======================================================
    public function generar()
    {
        return view('auth.generar');
    }

    public function busquedagenerar(Request $request)
    {
        $datosgenerar = $request->validate([
            'cedula' => ['required', 'numeric', 'min_digits:7'],
        ], [
            'cedula.required' => 'Es necesario que coloque la cédula de identidad del estudiante.',
            'cedula.numeric' => 'La cédula de identidad no debe contener carácteres no númericos.',
            'cedula.min_digits' => 'La longitud de la cédula no coincide con el mínimo requerido.',
        ]);
        $cedula = Students::where('cedula', $datosgenerar)->first();
        if (!$cedula) {
            return redirect()->back()->withErrors(['cedula' => 'No se encuentra registrado el estudiante con ése número de cédula']);
        }
        $activo = Periodos::where('activo', true)->first();
        if (!$activo) {
            return redirect()->back()->withErrors(['error' => 'No hay un periodo activo para proceder']);
        }
        $estudiantes = Students::where('cedula', $datosgenerar)
            ->where('periodo_id', $activo->id)
            ->get();
        if ($estudiantes->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'El estudiante no está registrado en un periodo activo']);
        }
        return view('auth.busqueda-generar', compact('cedula', 'estudiantes'));
    }

    public function generarprocess(Request $request)
    {
        $datosgenerar = $request->validate([
            'cedula' => ['required', 'numeric', 'min_digits:7'],
            'carrera_id' => 'required|numeric|exists:carreras,id',
        ], [
            'cedula.required' => 'Es necesario que coloque la cédula de identidad del estudiante.',
            'cedula.numeric' => 'La cédula de identidad no debe contener carácteres no númericos.',
            'cedula.min_digits' => 'La longitud de la cédula no coincide con el mínimo requerido.',
            'carrera_id.required' => 'Es necesario que coloque la ccarrera del estudiante.',
            'carrera_id.numeric' => 'La carrera no debe contener carácteres no númericos.',
            'carrera_id.exists' => 'La ccarrera no coincide con las carreras del sistema.',
        ]);
        $existe = Students::where('cedula', $datosgenerar)->first();
        if (!$existe) {
            return redirect()->back()->withErrors(['cedula' => 'No se encuentra registrado el estudiante con ése número de cédula']);
        }
        $fecha = Carbon::now();

        $diasEnLetras = [
            1 => 'uno',
            2 => 'dos',
            3 => 'tres',
            4 => 'cuatro',
            5 => 'cinco',
            6 => 'seis',
            7 => 'siete',
            8 => 'ocho',
            9 => 'nueve',
            10 => 'diez',
            11 => 'once',
            12 => 'doce',
            13 => 'trece',
            14 => 'catorce',
            15 => 'quince',
            16 => 'dieciséis',
            17 => 'diecisiete',
            18 => 'dieciocho',
            19 => 'diecinueve',
            20 => 'veinte',
            21 => 'veintiuno',
            22 => 'veintidós',
            23 => 'veintitrés',
            24 => 'veinticuatro',
            25 => 'veinticinco',
            26 => 'veintiséis',
            27 => 'veintisiete',
            28 => 'veintiocho',
            29 => 'veintinueve',
            30 => 'treinta',
            31 => 'treinta y uno'
        ];

        $dia = $fecha->day;
        $mes = $fecha->isoFormat('MMMM');
        $anio = $fecha->year;
        $diaTexto = $diasEnLetras[$dia] ?? $dia;

        $opciones = [
            'fontDir' => resource_path('fonts/Courierpdf/'),
        ];
        $informacion = ConstanciaEstudios::first();
        $usuario = Auth::user();
        $activo = Periodos::where('activo', true)->first();
        $estudiante = Students::where('cedula', $request->cedula)
            ->where('carrera_id', $request->carrera_id)
            ->where('periodo_id', $activo->id)
            ->first();
        $estudiantes = Students::where('cedula', $datosgenerar)
            ->where('periodo_id', $activo->id)
            ->get();
        $carreras = Carreras::with('titulos')->find($estudiante->carrera_id);
        $titulosacademicos = TituloAcademico::where('carrera_id', $estudiante->carrera_id)
            ->where('tramo_trayecto_id', '<=', $estudiante->tramo_trayecto_id)
            ->orderBy('tramo_trayecto_id', 'desc')
            ->first();
        $pdf = Pdf::loadView(
            'pdf.constanciaestudios',
            compact([
                'informacion',
                'usuario',
                'estudiante',
                'estudiantes',
                'diaTexto',
                'mes',
                'anio',
                'titulosacademicos',
                'carreras'
            ])
        )->setOption($opciones);
        $filename = 'Constancia_de_estudios_' . $estudiante['primer_name'] . '_' . $estudiante['primer_apellido'] . '_' . $estudiante['cedula'] . '.pdf';
        return $pdf->download($filename);
        return view('auth.generar');
    }

    // *************** RECORD DE Notas ***************
    public function generarrecord(Request $request)
    {
        $validar = $request->validate([
            'cedula' => ['required', 'numeric', 'min_digits:7'],
        ], [
            'cedula.required' => 'Es necesario que coloque la cédula de identidad del estudiante.',
            'cedula.numeric' => 'La cédula de identidad no debe contener carácteres no númericos.',
            'cedula.min_digits' => 'La longitud de la cédula no coincide con el mínimo requerido.',
        ]);
        $cedula = Students::where('cedula', $validar)->first();
        if (!$cedula) {
            return redirect()->back()->withErrors(['cedula' => 'No se encuentra registrado el estudiante con ése número de cédula']);
        }
        $activo = Periodos::where('activo', true)->first();
        $student = Students::where('cedula', $validar)
            ->where('periodo_id', $activo->id)
            ->get();
        $studentPreSis = Datospresistema::where('cedula', $validar)
            ->select('carrera_id')
            ->distinct()
            ->get();
        $estudiantes = collect()->merge($student)->merge($studentPreSis)->values();
        return view('auth.generar-record', compact('cedula', 'estudiantes'));
    }

    public function generarrecordpdf(Request $request)
    {
        $validar = $request->validate([
            'cedula' => ['required', 'numeric', 'min_digits:7'],
        ], [
            'cedula.required' => 'Es necesario que coloque la cédula de identidad del estudiante.',
            'cedula.numeric' => 'La cédula de identidad no debe contener carácteres no númericos.',
            'cedula.min_digits' => 'La longitud de la cédula no coincide con el mínimo requerido.',
        ]);
        $cedula = Students::where('cedula', $validar['cedula'])->first();
        $cedulaPre = Datospresistema::where('cedula', $validar['cedula'])->first();
        if (!$cedula) {
            return redirect()->back()->withErrors(['cedula' => 'No se encuentra registrado el estudiante con ése número de cédula']);
        }
        $estudiante = Students::where('cedula', $request->cedula)
            ->where('carrera_id', $request->carrera_id)
            ->first();
        $estudiantePreSistema = Datospresistema::where('cedula', $request->cedula)->where('carrera_id', $request->carrera_id)->first();
        if ($estudiante !== null) {
            $carreras = Carreras::with('titulos')->find($estudiante->carrera_id);
            $titulosacademicos = TituloAcademico::where('carrera_id', $estudiante->carrera_id)
                ->where('tramo_trayecto_id', '<=', $estudiante->tramo_trayecto_id)
                ->orderBy('tramo_trayecto_id', 'desc')
                ->first();
        } elseif ($estudiantePreSistema !== null) {
            $carreras = Carreras::with('titulos')->find($estudiantePreSistema->carrera_id);
            $titulosacademicos = TituloAcademico::where('carrera_id', $estudiantePreSistema->carrera_id)
                ->first();
        } else {
            return back()->with('error', 'No se encontró registro del estudiante en el sistema ni en pre-sistema.');
        }

        $student = Students::where('cedula', $request->cedula)
            ->where('carrera_id', $request->carrera_id)
            ->get();
        $student_ids = $student->pluck('id');
        $notas = Notas::whereIn('student_id', $student_ids)
            ->with(['pensums.materias', 'periodos'])
            ->get()
            ->map(function ($item) {
                return (object)[
                    'periodo_nombre' => isset($item->periodos) ? $item->periodos->nombre : 'SIN PERIODO',
                    'codigo' => optional($item->pensums->materias)->codigo ?? '—',
                    'materia' => optional($item->pensums->materias)->materia ?? 'SIN REGISTRO',
                    'uc' => optional($item->pensums->materias)->unidadcurricular ?? 0,
                    'definitiva' => round(($item->nota_uno + $item->nota_dos + $item->nota_tres + $item->nota_cuatro + $item->nota_extra) / 4),
                ];
            });

        $preSistema = DatosPreSistema::where('cedula', $request->cedula)
            ->where('carrera_id', $request->carrera_id)
            ->with(['materia'])
            ->get()
            ->map(function ($item) {
                return (object)[
                    'periodo_nombre' => $item->periodo_name ?? 'SIN PERIODO',
                    'codigo' => $item->materia->codigo ?? '—',
                    'materia' => $item->materia->materia ?? 'SIN REGISTRO',
                    'uc' => $item->materia->unidadcurricular ?? 0,
                    'definitiva' => $item->definitiva ?? 0,
                ];
            });

        $notasCombinadas = collect()
            ->merge($notas)
            ->merge($preSistema)
            ->sortBy('periodo_nombre', SORT_NATURAL | SORT_FLAG_CASE)
            ->values();
        $admin = Auth::user();
        $fecha = Carbon::now();

        $dia = $fecha->day;
        $mes = $fecha->month;
        $anio = $fecha->year;
        $opciones = [
            'fontDir' => resource_path('fonts/Courierpdf/'),
        ];
        $pdf = Pdf::loadView(
            'pdf.record',
            compact([
                'estudiante',
                'estudiantePreSistema',
                'dia',
                'mes',
                'anio',
                'titulosacademicos',
                'carreras',
                'student',
                'notasCombinadas',
                'admin',
            ])
        )->setOption($opciones);
        $filename = 'record.pdf';
        if ($estudiante !== null) {
            $filename = 'Record_Academico_' . $estudiante['primer_name'] . '_' . $estudiante['primer_name'] . '_' . $estudiante['primer_apellido'] . '_' . $estudiante['cedula'] . '.pdf';
        } elseif ($estudiantePreSistema !== null) {
            $filename = 'Record_Academico_' . $estudiantePreSistema['primer_name'] . '_' . $estudiantePreSistema['primer_name'] . '_' . $estudiantePreSistema['primer_apellido'] . '_' . $estudiantePreSistema['cedula'] . '.pdf';
        } else {
            return back()->with('error', 'No se encontró registro del estudiante en el sistema ni en pre-sistema.');
        }
        return $pdf->download($filename);
        return view('auth.generar');
        // return view('pdf.record', compact('dia', 'mes', 'anio', 'estudiante', 'titulosacademicos', 'carreras', 'student', 'notas',));
    }

    public function generarrecarga()
    {
        return view('pdf.cerrar');
    }

    // ======================================================
    //      CARGOS DE LOS USUARIOS
    // ======================================================
    public function cargoadd()
    {
        $tipo = Tipos::where('tipo', '!=', 'superadmin')->get();
        $cargo = Cargos::with('tipos')->get();
        return view('auth.superadmin.cargoadd', compact('tipo', 'cargo'));
    }

    public function cargosave(Request $request)
    {
        $tipo = Tipos::find($request->tipo_id);
        if ($tipo && $tipo->tipo == 'superadmin') {
            return redirect()->back()->withErrors(['error' => 'El tipo de cargo no es valido.']);
        } else {
            $atributos = $request->validate([
                'cargo' => 'required|unique:cargos,cargo|string|max:100',
                'tipo_id' => 'required|exists:tipos,id|integer',
                'encargado' => 'required|string',
            ], [
                'cargo.required' => 'Es necesario que coloque un cargo real. Ejemplo Jefe Administrador',
                'cargo.string' => 'Es necesario que contenga valores alfabeticos y no númericos',
                'cargo.unique' => 'El cargo que está intentando crear ya existe.',
                'cargo.max' => 'No debe se sobrepasar mas de 100 carácteres',
                'tipo_id.required' => 'Debe colocar un tipo de cargo real',
                'tipo_id.integer' => 'No debe contener carácteres especiales',
                'tipo_id.exists' => 'El tipo de cargo que está intentando usar no existe.',
                'encargado.required' => 'Es necesario que seleccione si es encargado o no en su tipo de cargo',
                'encargado.string' => 'Es necesario que tenga valores alfabeticos',
            ]);
            if ($request->encargado !== 'si') {
                $atributos['encargado'] = false;
            } else {
                $atributos['encargado'] = true;
            }

            $atributos['cargo'] = Str::title(ucwords($atributos['cargo']));
            Cargos::create($atributos);
            return redirect()->route('cargo.index')->with('alert', 'Cargo creado exitosamente!');
        }
    }

    public function cargoedit($id)
    {
        $cargo = Cargos::all()->findOrFail($id);
        $tipos = Tipos::where('tipo', '!=', 'superadmin')->get();
        return view('auth.superadmin.cargoedit', compact('cargo', 'tipos'));
    }

    public function cargoeditsave(Request $request, $id)
    {
        $tipo = Tipos::find($request->tipo_id);
        if ($tipo && $tipo->tipo == 'superadmin') {
            return redirect()->back()->withErrors(['error' => 'El tipo de cargo no es valido.']);
        } else {
            $request->validate([
                'cargo' => 'required|string|max:100',
                'tipo_id' => 'required|exists:tipos,id|integer',
            ], [
                'cargo.required' => 'Es necesario que coloque un cargo real. Ejemplo Jefe Administrador',
                'cargo.string' => 'Es necesario que contenga valores alfabeticos y no númericos',
                'cargo.max' => 'No debe se sobrepasar mas de 100 carácteres',
                'tipo_id.required' => 'Debe colocar un tipo de cargo real',
                'tipo_id.integer' => 'No debe contener carácteres especiales',
                'tipo_id.exists' => 'El tipo de cargo que está intentando usar no existe.',
            ]);
            $cargoNormalizado = Str::title(strtolower(trim($request->cargo)));
            $existeCargo = Cargos::where('id', '!=', $id)
                ->where('cargo', $cargoNormalizado)
                ->exists();

            if ($existeCargo) {
                return redirect()->back()->withErrors(['error' => 'El cargo ya existe']);
            }
            Cargos::where('id', $id)->update([
                'cargo' => $cargoNormalizado,
                'tipo_id' => $request->tipo_id
            ]);
            return redirect('/agregar-cargo')->with('alert', 'Se guardaron los cambios de manera correcta');
        }
    }

    // =========================================================
    // ========== MATERIAS ===========
    // =========================================================
    public function materias()
    {
        $materias = Materias::orderBy('materia')->paginate(20);
        return view('auth.superadmin.materias', compact('materias'));
    }

    public function materiaedit($id)
    {
        $materias = Materias::all()->findOrFail($id);
        return view('auth.superadmin.materiaedit', compact('materias'));
    }

    public function cambiaredit(Request $request, $id)
    {
        $request->validate([
            'materia' => ['required', 'min:3', 'string', 'regex:/^[^\d]*$/'],
            'codigo' => ['required', 'min:3', 'string'],
            'unidadcurricular' => ['required', 'numeric'],
            'per' => 'nullable',
        ], [
            'materia.required' => 'La materia no debe estar vacía',
            'materia.regex' => 'La materia no debe contener números',
            'materia.min' => 'La materia tiene que tener 3 carácteres como mínimo',
            'codigo.required' => 'El código no debe estar vacía',
            'codigo.min' => 'El código debe tener 3 carácteres como mínimo',
            'codigo.string' => 'El código debe ser texto y no carácteres especiales',
            'unidadcurricular.required' => 'Es necesario la unidad curricular para crear la materia',
            'unidadcurricular.numeric' => 'La unidad curricular deben ser números',
        ]);
        $materianormalizada = Str::title(strtolower(trim($request->materia)));
        $codigonormalizada = Str::title(strtolower(trim($request->codigo)));

        $existeCarrera = Materias::where('id', '!=', $id)->whereRaw('LOWER(materia) LIKE ?', [strtolower($materianormalizada)])->exists();
        if ($existeCarrera) {
            return redirect()->back()->withErrors(['error' => 'La materia que está intentando guardar ya existe en la base de datos.']);
        }
        $existeCarrera = Materias::where('id', '!=', $id)->whereRaw('LOWER(codigo) LIKE ?', [strtolower($codigonormalizada)])->exists();
        if ($existeCarrera) {
            return redirect()->back()->withErrors(['error' => 'El codigo que está intentando guardar ya existe en la base de datos.']);
        }
        Materias::where('id', $id)->update([
            'materia' => $materianormalizada,
            'codigo' => $codigonormalizada,
            'per' => $request->boolean('per'),
        ]);

        return redirect('/materias')->with('alert', 'Se guardó con exito los cambios');
    }

    public function materiasadd(Request $request)
    {
        $request->validate([
            'materia' => 'string|unique:materias,materia',
            'codigo' => 'string|unique:materias,codigo',
            'unidadcurricular' => ['required', 'numeric'],
            'per' => 'nullable',
        ], [
            'materia.string' => 'debe colocar texto',
            'materia.unique' => 'La materia que está tratando de registrar ya existe',
            'codigo.string' => 'debe colocar texto',
            'codigo.unique' => 'La materia que está tratando de registrar ya existe',
            'unidadcurricular.required' => 'Es necesario la unidad curricular para crear la materia',
            'unidadcurricular.numeric' => 'La unidad curricular deben ser números',
            'per.required' => 'Debe seleccionar si puede tener PER la materia',
        ]);
        $atributosuno = strtolower($request->input('materia'));
        $atributosdos = strtolower($request->input('codigo'));
        $atributos = [
            'materia' => $atributosuno,
            'codigo' => $atributosdos,
            'unidadcurricular' => $request->unidadcurricular,
            'per' => $request->boolean('per'),
        ];
        Materias::create($atributos);
        return redirect()->back()->with('alert', 'Se Registró con Exito');
    }

    // =========================================================
    // ========== PENSUM ===========
    // =========================================================
    public function pensum()
    {
        $trayecto = Trayectos::with('tramos')->get();
        $materias = Materias::all();
        $carrera = Carreras::all();
        $pensum = Pensum::with('tramos', 'carreras', 'trayectos')
            ->select('tramo_trayecto_id', 'carrera_id')
            ->groupBy('tramo_trayecto_id', 'carrera_id')
            ->get();
        $pensumUnidos = Pensum::select('tramo_trayecto_id')->distinct()->get();
        return view('auth.superadmin.pensum', compact(['trayecto', 'materias', 'carrera', 'pensum', 'pensumUnidos']));
    }

    public function pensumadd()
    {
        $trayecto = Trayectos::with('tramos')->get();
        $materias = Materias::orderBy('materia')->get();
        $carrera = Carreras::orderBy('carrera')->get();
        return view('auth.superadmin.crearpensum', compact(['trayecto', 'materias', 'carrera']));
    }

    public function pensumstore(Request $request)
    {
        $request->validate([
            'tramo_trayecto_id' => 'required',
            'carrera_id' => 'required|exists:carreras,id',
            'materias' => 'required|array',
            'materias.*' => 'exists:materias,id'
        ], [
            'tramo_trayecto_id.required' => 'requiere tramo_trayecto',
            'carrera_id.required' => 'Requiere carrera',
            'materias.required' => 'Requiere materias',
        ]);
        $existePensum = Pensum::where('carrera_id', $request->carrera_id)->where('tramo_trayecto_id', $request->tramo_trayecto_id)->where('materia_id', $request->materias)->exists();
        if ($existePensum) {
            return redirect()->back()->withErrors(['error' => 'El plan de estudios tiene por lo menos una materia ya registrada en ese tramo y carrera.']);
        }
        foreach ($request->materias as $materiaId) {
            Pensum::create([
                'tramo_trayecto_id' => $request->tramo_trayecto_id,
                'carrera_id' => $request->carrera_id,
                'materia_id' => $materiaId
            ]);
        }
        return redirect()->back()->with('alert', 'Plan de estudios creado correctamente');
    }

    // =========================================================
    // ========== PERIODOS ACADEMICOS ===========
    // =========================================================
    public function periodos()
    {
        $usuario = Auth::user();
        $datos = User::where('id', $usuario->id)->firstOrFail();
        $periodo = Periodos::where('nucleo_id', $datos->nucleo_id)->orderBy('created_at', 'desc')->paginate(20);
        return view('auth.periodo-academico', compact('periodo'));
    }

    public function addperiodo(Request $request)
    {
        $atributos = $request->validate([
            'inicio' => 'required|unique:periodos,inicio',
            'fin' => 'required|unique:periodos,fin',
            'nombre' => 'required|string',
        ], [
            'inicio.date' => 'Se necesita colocar el periodo de inicio como una fecha.',
            'inicio.required' => 'Es obligatorio colocar el periodo de inicio.',
            'inicio.unique' => 'Ya existe esa fecha de inicio de periodo academico.',
            'fin.date' => 'Se necesita colocar el periodo de inicio como una fecha.',
            'fin.required' => 'Es obligatorio colocar la fecha final del periodo académico.',
            'fin.unique' => 'Ya existe esta fecha de inicio de periodo académico.',
            'nombre.required' => 'No debe dejar el nombre del periodo académico en blanco.',
            'nombre.string' => 'No debe colocar carácteres especiales en el nombre del periodo académico.',
        ]);
        $usuario = Auth::user();
        $datos = User::where('id', $usuario->id)->firstOrFail();

        $activo = Periodos::where('activo', true)->first();
        if ($activo) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Actualmente ya existe un periodo activo']);
        }
        $atributos['activo'] = true;
        $atributos['nucleo_id'] = $datos->nucleo_id;
        Periodos::create($atributos);
        return redirect()->back()->with('alert', 'Se creó e inició un nuevo periodo académico.');
    }

    public function desasignarperiodo(Request $request)
    {
        $request->validate([
            'accion' => 'required|string',
        ], [
            'accion.required' => 'Debe colocar la acción que desea llevar a cabo.',
            'accion.string' => 'Debe colocar la accion como un texto sin caracteres especiales',
        ]);

        $normalizar = Str::lower($request->accion);
        if ($normalizar !== 'si') {
            return redirect()->back()->with('alert', 'Se canceló la desactivación del periodo académico.');
        } else {
            $periodo = Periodos::where('activo', true)->first();
            $periodo->activo = false;
            $periodo->save();

            return redirect()->back()->with('alert', 'Periodo académico desactivado correctamente.');
        }
    }

    // =========================================================
    // ========== ASIGNAR PENSUM A PROFESOR O DOCENTE===========
    // =========================================================
    public function preasignar()
    {
        $carreras = Carreras::all();
        $secciones = Secciones::all();
        $periodos = Periodos::all();
        return view('auth.asignar', compact('carreras', 'secciones', 'periodos'));
    }

    public function asignar(Request $request)
    {
        if (!$request->filled('cedula')) {
            return redirect()->back()->withErrors(['error' => 'No ingresaste una cédula para búscar.']);
        }
        $request->validate(['cedula' => 'required|string']);
        $profesor = Profesores::where('cedula', $request->cedula)->first();
        if (!$profesor) {
            return redirect()->back()->withErrors(['error' => 'Profesor no encontrado']);
        }
        $asignaciones = $profesor
            ->asignaciones()
            ->with('pensums.carreras', 'pensums.tramoTrayecto.tramos', 'pensums.tramoTrayecto.trayectos', 'pensums.materias', 'secciones')
            ->get();
        $pensumcarrera = Pensum::pluck('carrera_id')->unique();
        $carreras = Carreras::whereIn('id', $pensumcarrera)->get();
        $secciones = Secciones::all();
        $pensums = Pensum::pluck('tramo_trayecto_id')->unique();
        $trayectos = Trayectos::whereHas('tramos', function ($query) use ($pensums) {
            $query->whereIn('tramo_trayecto.id', $pensums);
        })->with(['tramos' => function ($query) use ($pensums) {
            $query->whereIn('tramo_trayecto.id', $pensums);
        }])->get();
        return view('auth.asignar-form', compact('profesor', 'asignaciones', 'carreras', 'secciones', 'trayectos', 'pensums'));
    }

    public function desasignarprofesor($id)
    {
        Asignar::destroy($id);
        return back()->with('success', 'Materia desasignada');
    }

    public function crearasignacion(Profesores $profesor)
    {
        $carreras = Carreras::all();
        $secciones = Secciones::all();
        $periodos = Periodos::all();

        return view('admin.asignar-form', compact('profesor', 'carreras', 'secciones', 'periodos'));
    }

    public function asignardocentesave(Request $request)
    {
        $periodoActivo = Periodos::where('activo', true)->first();

        if (!$periodoActivo) {
            return redirect()->back()->withErrors('No hay un período activo configurado.');
        }
        $request->validate([
            'profesor_id' => 'required|exists:profesores,id',
            'carrera_id' => 'required|exists:carreras,id',
            'tramo_trayecto_id' => 'required|exists:tramo_trayecto,id'
        ], [
            'profesor_id.required' => 'Necesitas ingresar un profesor',
            'profesor_id.exists' => 'El profesor que esta tratando de usar no existe',
            'carrera_id.required' => 'Necesitas ingresar una carrera',
            'carrera_id.exists' => 'La carrera que estas tratanto de usar no existe',
            'tramo_trayecto_id.required' => 'Necesitas ingresar un Tramo',
            'tramo_trayecto_id.exists' => 'El tramo que estes tratanto de usar no existe',
        ]);
        $profesor = $request->profesor_id;
        $carrera = $request->carrera_id;
        $tramotrayecto = $request->tramo_trayecto_id;
        $materias = Pensum::where('carrera_id', $request->carrera_id)
            ->where('tramo_trayecto_id', $request->tramo_trayecto_id)
            ->whereNotIn('id', function ($query) use ($request) {
                $query
                    ->select('pensum_id')
                    ->from('profesor_asignar')
                    ->where('profesor_id', $request->profesor_id);
            })
            ->with('materias')
            ->get();
        $carreras = Carreras::find($carrera);
        $tramos = TramoTrayecto::with('tramos')->find($tramotrayecto);
        $secciones = Secciones::all();
        return view('auth.asignar-materias', compact('profesor', 'tramotrayecto', 'carrera', 'materias', 'secciones', 'carreras', 'tramos'));
    }

    public function asignardocentesavemateria(Request $request)
    {
        $request->validate([
            'profesor_id' => 'required|exists:profesores,id',
            'carrera_id' => 'required|exists:carreras,id',
            'materia_id' => 'required|array',
            'materia_id.*' => 'exists:materias,id',
            'seccion_id' => 'required|array',
            'seccion_id.*' => 'exists:secciones,id',
            'tramo_trayecto_id' => 'required|exists:tramo_trayecto,id'
        ], [
            'profesor_id.required' => 'Necesitas ingresar un profesor',
            'profesor_id.exists' => 'El profesor que esta tratando de usar no existe',
            'carrera_id.required' => 'Necesitas ingresar una carrera',
            'carrera_id.exists' => 'La carrera que estas tratanto de usar no existe',
            'tramo_trayecto_id.required' => 'Necesitas ingresar un Tramo',
            'tramo_trayecto_id.exists' => 'El tramo que estes tratanto de usar no existe',
        ]);
        $periodoActivo = Periodos::where('activo', true)->first();

        if (!$periodoActivo) {
            return redirect()->back()->with('error', 'No hay un período activo configurado');
        }
        $asignacioncreada = 0;
        $materiaenpensum = [];
        foreach ($request->materia_id as $materiaId) {
            $pensum = Pensum::where('carrera_id', $request->carrera_id)->where('tramo_trayecto_id', $request->tramo_trayecto_id)->where('materia_id', $materiaId)->first();
            if (!$pensum) {
                $materiaenpensum[] = $materiaId;
                continue;
            }
            foreach ($request->seccion_id as $seccionesId) {
                Asignar::updateOrCreate([
                    'pensum_id' => $pensum->id,
                    'seccion_id' => $seccionesId,
                ], [
                    'profesor_id' => $request->profesor_id,
                ]);
                $asignacioncreada++;
            }
        }
        $mensaje = $asignacioncreada > 0
            ? "Se asignaron {$asignacioncreada} materias/secciones correctamente"
            : 'No se realizaron asignaciones';

        if (!empty($materiasNoEnPensum)) {
            $materias = Materias::whereIn('id', $materiasNoEnPensum)->pluck('materia')->toArray();
            $mensaje .= '. Materias no en pensum: ' . implode(', ', $materias);
        }
        return redirect()->route('asignar')->with('alert', $mensaje);
    }

    // =============================================================================
    // correccion de notas
    // =============================================================================
    public function correccion($nota_id, $estudiante_id, $periodo_id, $pensums_id)
    {
        $notas = Notas::where('pensum_id', $pensums_id)->where('periodo_id', $periodo_id)->where('student_id', $estudiante_id)->first();
        $estudiante = Students::findOrFail($estudiante_id);
        $pensum = Pensum::findOrFail($pensums_id);
        $periodo = Periodos::findOrFail($periodo_id);
        return view('auth.correccion', compact('notas', 'estudiante', 'pensum', 'periodo'));
    }

    public function savecorreccion(Request $request)
    {
        $request->validate([
            'correccion' => 'required|numeric|min:1|max:20',
        ], [
            'correccion.required' => 'La casilla de la nota corregida no debe ser la anterior ni debe estar vacía',
            'correccion.numeric' => 'La nota corregida debe ser un número',
            'correccion.min' => 'La nota no debe de ser un valor inferior a 1',
            'correccion.max' => 'La nota no debe de ser un valor superior a 20',
        ]);
        $nota = Notas::where('pensum_id', $request->pensum_id)
            ->where('periodo_id', $request->periodo_id)
            ->where('student_id', $request->estudiante_id)
            ->firstOrFail();
        $campoEditar = $nota->nota_editar;
        if (!in_array($campoEditar, ['nota_uno', 'nota_dos', 'nota_tres', 'nota_cuatro', 'nota_extra'])) {
            return back()->withErrors(['nota_editar' => 'No se puede identificar qué nota debe corregirse.']);
        }
        $nota->$campoEditar = $request->correccion;
        $nota->editado = false;
        $nota->nota_editar = null;
        $nota->save();
        return redirect('/estudiantes-calificacion/' . $request->estudiante_id)->with('alert', 'La nota fue corregida exitosamente.');
    }

    // ======================================================
    //      TITULO UNIVERSITARIO DE LOS USUARIOS
    // ======================================================
    public function titulos()
    {
        $estudios = Estudios::paginate(20);
        return view('auth.superadmin.titulos', compact('estudios'));
    }

    public function savetitulo(Request $request)
    {
        $request->validate([
            'estudio' => 'required|string|unique:estudios,estudio',
            'abrev' => 'required|string|unique:estudios,abrev',
        ], [
            'estudio.required' => 'No debe dejar la casilla del título vacío',
            'estudio.string' => 'El título debe ser un texto',
            'estudio.unique' => 'El título que intenta crear ya existe',
            'abrev.required' => 'No debe dejar la casilla del la abreviatura vacía',
            'abrev.string' => 'La abreviatura debe ser un texto',
            'abrev.unique' => 'La abreviatura que intenta crear ya existe',
        ]);

        $normalisarTitulo = Str::lower($request->estudio);
        $normalisarAbrev = Str::lower($request->abrev);

        Estudios::create(['estudio' => $normalisarTitulo, 'abrev' => $normalisarAbrev]);
        return redirect()->back()->with('alert', 'El título profesional se registro con exito');
    }

    public function edittitulo($titulo_id)
    {
        $titulo = Estudios::where('id', $titulo_id)->firstOrFail();
        if (!$titulo) {
            return redirect()->back()->withErrors(['error' => 'El identificador del título no existe en el sistema']);
        }
        return view('auth.superadmin.editar-titulo-user', compact('titulo'));
    }

    public function saveedittitulo(Request $request)
    {
        $validar = $request->validate([
            'estudio' => 'required|string|unique:estudios,estudio',
            'abrev' => 'required|string|unique:estudios,abrev',
            'titulo_id' => 'required|numeric|exists:estudios,id',
        ], [
            'estudio.required' => 'No debe dejar la casilla del título vacío',
            'estudio.string' => 'El título debe ser un texto',
            'estudio.unique' => 'El título que intenta crear ya existe',
            'abrev.required' => 'No debe dejar la casilla del la abreviatura vacía',
            'abrev.string' => 'La abreviatura debe ser un texto',
            'abrev.unique' => 'La abreviatura que intenta crear ya existe',
            'titulo_id.required' => 'No debes omitir el identificador del titulo',
            'titulo_id.numeric' => 'El identificar debe ser numerico',
            'titulo_id.exists' => 'El titulo no existe en la base de datos',
        ]);
        $normalisarTitulo = Str::lower($validar['estudio']);
        $normalisarAbrev = Str::lower($validar['abrev']);
        Estudios::where('id', $validar['titulo_id'])->update([
            'estudio' => $normalisarTitulo,
            'abrev' => $normalisarAbrev,
        ]);
        return redirect('/agregar-titulo')->with('alert', 'Se guardó con exito los cambios');
    }

    // ======================================================
    //      ESTUDIANTES PRE-SISTEMA
    // ======================================================
    public function cargarnotas()
    {
        $datos = Auth::user();
        $user = User::where('id', $datos->id)->firstOrFail();
        $courses = Carreras::orderByRaw('carrera ASC')->get();
        $nucleos = Nucleos::orderByRaw('nucleo ASC')->get();
        $secciones = Secciones::orderByRaw('seccion ASC')->get();
        $periodo = Periodos::where('activo', true)->first();
        $materias = Materias::all();
        return view('auth.carga-manual', compact('courses', 'nucleos', 'secciones', 'periodo', 'user', 'materias'));
    }

    public function cargarnotasstore(Request $request)
    {
        $datosEstudiante = $request->validate([
            'cedula' => ['required', 'numeric', 'min_digits:7'],
            'primer_name' => ['required', 'string'],
            'segundo_name' => ['nullable', 'string'],
            'primer_apellido' => ['required', 'string'],
            'segundo_apellido' => ['nullable', 'string'],
            'genero' => ['required', 'string'],
            'nacionalidad' => ['required'],
            'fecha_nacimiento' => ['required'],
            'nucleo_id' => ['required', 'numeric'],
            'carrera_id' => ['required', 'numeric', 'exists:carreras,id'],
            'seccion_id' => ['nullable', 'numeric', 'exists:secciones,id'],
            'definitiva' => ['required', 'numeric', 'max_digits:2'],
            'materia_id' => ['required', 'numeric'],
            'fecha_periodo' => ['required'],
            'periodo_name' => ['required', 'string'],
            // 'codigo' => 'required|string',
        ], [
            'cedula.required' => 'Es necesario que coloque la cédula de identidad del estudiante.',
            'cedula.numeric' => 'La cédula de identidad no debe contener carácteres no númericos.',
            'cedula.min_digits' => 'La longitud de la cédula no coincide con el mínimo requerido.',
            'primer_name.required' => 'Es obligatorio que el estudiante tenga su primer nombre.',
            'primer_name.string' => 'Es obligatorio que el estudiante tenga carácteres y no números en su nombre.',
            'primer_apellido.required' => 'Es obligatorio que el estudiante tenga su primer apellido.',
            'genero.required' => 'Es obligatorio colocar el verdadero genero/sexo del estudiante.',
            'fecha_nacimiento.required' => 'Es obligatorio colocar la fecha de nacimiento del estudiante.',
            'nacionalidad.required' => 'Es obligatorio agregar el tipo de nacionalidad del estudiante.',
            'nucleo_id.required' => 'Es obligatorio agregar el núcleo donde el estudiante va a estudiar.',
            'nucleo_id.numeric' => 'Es obligatorio que el núcleo no tenga carácteres especiales.',
            'carrera_id.required' => 'Es obligatorio seleccionar la carrera que el estudiante va a estudiar.',
            'carrera_id.numeric' => 'Es obligatorio que la carrera no tenga carácteres especiales.',
            'carrera_id.exists' => 'La carrera no es válida.',
            // 'codigo.required' => 'Es obligatorio que coloque un código al estudiante',
        ]);

        $usuario = Auth::user();
        $user = User::with('cargos.tipos')->find($usuario->id);
        $datos = User::where('id', $usuario->id)->firstOrFail();
        $esRoot = $user && $user->cargos()->whereHas('tipos', function ($q) {
            $q->where('tipo', 'superadmin');
        })->exists();

        if (!$esRoot) {
            if ((int) $request->nucleo_id !== (int) $datos->nucleo_id) {
                return redirect()->back()->withInput()->withErrors([
                    'error' => 'No tiene permiso para cambiar el núcleo asignado.'
                ]);
            }
            $datosEstudiante['nucleo_id'] = $datos->nucleo_id;
        } else {
            $datosEstudiante['nucleo_id'] = $request->nucleo_id;
        }

        $periodo = Periodos::where('activo', true)->first();

        if (!$periodo) {
            return redirect()->back()->withInput()->withErrors(['error' => 'El periodo está cerrado.']);
        }

        $existeInscripcion = Datospresistema::where('cedula', $request->cedula)
            ->where('carrera_id', $request->carrera_id)
            ->where('periodo_name', $request->periodo_name)
            ->where('fecha_periodo', $request->fecha_periodo)
            ->exists();

        if ($existeInscripcion) {
            return redirect()->back()->withInput()->withErrors(['error' => 'El estudiante ya está inscrito en esta carrera y periodo.']);
        }

        $codigoVerifi =  Datospresistema::where('cedula', $request->cedula)->first();
        if (empty($request->codigo)) {
            if (!is_null($codigoVerifi)) {
                if (empty($request->codigo)) {
                    $datosEstudiante['codigo'] = $codigoVerifi->codigo;
                }
            } else {
                return redirect()->back()->withInput()->withErrors(['error' => 'No se pudo encontrar el código del estudiante, probablemente aúno no fue registrado, por favor ingrese el código manualmente']);
            }
        } elseif (empty($codigoVerifi)) {
            $datosEstudiante['codigo'] = $request->codigo;
        } else {
            if ($request->codigo !== $codigoVerifi->codigo) {
                $datosEstudiante['codigo'] = $codigoVerifi->codigo;
            } else {
                $datosEstudiante['codigo'] = $request->codigo;
            }
        }

        $datosEstudiante['periodo_id'] = $periodo->id;
        $datosEstudiante['primer_name'] = Str::title(ucwords($datosEstudiante['primer_name']));
        $datosEstudiante['segundo_name'] = $datosEstudiante['segundo_name'] ? Str::title(ucwords($datosEstudiante['segundo_name'])) : null;
        $datosEstudiante['primer_apellido'] = Str::title(ucwords($datosEstudiante['primer_apellido']));
        $datosEstudiante['segundo_apellido'] = $datosEstudiante['segundo_apellido'] ? Str::title(ucwords($datosEstudiante['segundo_apellido'])) : null;
        $datosEstudiante['genero'] = Str::lower($datosEstudiante['genero']);
        $datosEstudiante['nacionalidad'] = Str::upper($datosEstudiante['nacionalidad']);
        Datospresistema::create($datosEstudiante);

        return redirect()->back()->with('alert', 'El estudiante fue registado correctamente. ' . $datosEstudiante['codigo']);
    }


    // ======================================================
    //      TITULO ACADEMICO PARA LOS ESTUDIANTES
    // ======================================================
    public function tituloAcademicoUniversitario()
    {
        $carreras = Carreras::orderBy('carrera', 'asc')->get();
        $tramos = Trayectos::with('tramos')->get();
        $titulos = TituloAcademico::orderBy('titulo', 'asc')->get();
        return view('auth.superadmin.titulo-academicos', compact('carreras', 'tramos', 'titulos'));
    }

    public function tituloAcademicoSave(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'nullable|string',
            'carrera_id' => 'required|numeric|exists:carreras,id',
            'tramo_trayecto_id' => 'required|numeric|exists:tramo_trayecto,id',
        ], [
            'titulo.required' => 'Debe colocar el título académico',
            'titulo.string' => 'Debe ser de tipo texto el título académico',
            'descripcion.string' => 'Debe ser de tipo texto la descripcion',
            'carrera_id.required' => 'Debe colocar la carrera',
            'carrera_id.numeric' => 'No debe de contener texto la carrera',
            'carrera_id.exists' => 'No existe la carrera que seleccionó en el sistema',
            'tramo_trayecto_id.required' => 'Debe colocar la carrera',
            'tramo_trayecto_id.numeric' => 'No debe de contener texto la carrera',
            'tramo_trayecto_id.exists' => 'No existe la carrera que seleccionó en el sistema',
        ]);
        if (strlen($request->titulo) < 4) {
            $normalizar = Str::upper($request->titulo);
        } else {
            $normalizar = Str::title(ucwords($request->titulo));
        }
        $normalizardos = Str::title(ucwords($request->descripcion));

        $normalizarExist = TituloAcademico::where('carrera_id', $request->carrera_id)->where('titulo', $normalizar)->exists();
        if ($normalizarExist) {
            return redirect()->back()->withInput()->withErrors(['error' => 'El título académico ya existe en el sistema']);
        }
        $normalizarExistCaTra = TituloAcademico::where('carrera_id', $request->carrera_id)->where('tramo_trayecto_id', $request->tramo_trayecto_id)->exists();
        if ($normalizarExistCaTra) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Ya existe un título en esta carrera y tramo en el sistema']);
        }
        TituloAcademico::create([
            'titulo' => $normalizar,
            'descripcion' => $normalizardos,
            'carrera_id' => $request->carrera_id,
            'tramo_trayecto_id' => $request->tramo_trayecto_id,
        ]);
        return redirect()->back()->with('alert', 'El título académico para los estudiantes se creó correctamente');
    }

    public function editartituloacademico($titulo_id)
    {
        $buscar = TituloAcademico::findOrFail($titulo_id);
        $carreras = Carreras::orderBy('carrera', 'desc')->get();
        $tramos = Trayectos::with('tramos')->get();
        return view('auth.superadmin.titulos-academicos-edit', compact('buscar', 'carreras', 'tramos'));
    }

    public function saveeditartituloacademico(Request $request)
    {
        $validar = $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'nullable|string',
            'carrera_id' => 'required|numeric|exists:carreras,id',
            'tramo_trayecto_id' => 'required|numeric|exists:tramo_trayecto,id',
        ], [
            'titulo.required' => 'Debes de introducir el nombre del título.',
            'descripcion.string' => 'Debes de usar texto y no carácteres númericos',
            'carrera_id.required' => 'El identificador de la carrera debe tener un valor válido',
            'tramo_trayecto_id' => 'El identificar del tramo debe ser válido',
        ]);
        if (strlen($request->titulo) <= 4) {
            $normalizar = Str::upper($request->titulo);
        } else {
            $normalizar = Str::title(ucwords($request->titulo));
        }
        $normalizardos = Str::title(ucwords($request->descripcion));
        $validar['titulo'] = $normalizar;
        $validar['descripcion'] = $normalizardos;
        TituloAcademico::where('id', $request->titulo_id)->update($validar);
        return redirect('/students-academic-tittle');
    }
}
