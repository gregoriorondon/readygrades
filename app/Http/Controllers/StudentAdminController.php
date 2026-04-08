<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmInscripcion;
use App\Mail\Inscripcion;
use App\Models\Apertura;
use App\Models\Carreras;
use App\Models\Notas;
use App\Models\Nucleos;
use App\Models\Pensum;
use App\Models\Periodos;
use App\Models\Secciones;
use App\Models\Students;
use App\Models\StudentsCodigoNucleo;
use App\Models\StudentsInscripciones;
use App\Models\StudentSocioEconomico;
use App\Models\StudentTemporalInscripcion;
use App\Models\TitleStudentTemporal;
use App\Models\TramoTrayecto;
use App\Models\Trayectos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StudentAdminController extends Controller
{
    public function studentsadmin()
    {
        $usuario = Auth::user();
        // $user = User::with('cargos.tipos')->find($usuario->id);
        $nucleo = User::where('id', $usuario->id)->firstOrFail();
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
        $activo = Periodos::where('activo', true)->first();
        $estado = Apertura::where('nucleo_id', $nucleo->nucleo_id)->first();
        return view('auth.students', compact('estado', 'activo'));
    }

    public function studentsadmindetails($cedula)
    {
        $usuario = Auth::user();
        $nucleo = User::where('id', $usuario->id)->firstOrFail();
        $estudiantes = Students::where('cedula',$cedula)->firstOrFail();
        $estudianteData = StudentsInscripciones::whereHas('studentcodigonucleo', function ($a) use ($estudiantes, $nucleo) {
            $a->where('students_data_id', $estudiantes->id)->where('nucleo_id', $nucleo->nucleo_id);
        })->get();
        $titulo = TitleStudentTemporal::where('id', $estudiantes->title_student_temporal_id)->first();
        $nivelSocial = StudentSocioEconomico::where('id', $estudiantes->students_socio_economico_id)->first();
        $carrerasIds = $estudianteData->pluck('carrera_id')->unique()->toArray();
        $tramoTrayectoIds = $estudianteData->pluck('tramo_trayecto_id')->unique()->toArray();
        $notas = Notas::whereHas('pensums', function ($a) use ($carrerasIds, $tramoTrayectoIds) {
                $a->whereIn('carrera_id', $carrerasIds)->whereIn('tramo_trayecto_id', $tramoTrayectoIds);
            })->whereIn('students_inscripcion_id', $estudianteData->pluck('id'))->get();
        $notasAgrupada = $notas->groupBy([
            fn ($i) => $i->pensums->carreras->carrera,
            fn ($i) => $i->pensums->tramoTrayecto->tramos->tramos
        ]);
        $student = Trayectos::with('tramos')->get();
        return view('auth.students-details', compact('estudiantes', 'student', 'estudianteData', 'titulo', 'nivelSocial', 'notas', 'notasAgrupada'));
    }

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
        $nivelsocial = StudentSocioEconomico::all();
        $titulo = TitleStudentTemporal::all();
        return view('auth.registro-estudiante', compact('courses', 'trayectos', 'nucleos', 'secciones', 'periodo', 'user', 'nivelsocial', 'titulo'));
    }

    public function studentstore(Request $request)
    {
        $rules = [
            'nucleo_id'          => 'required|numeric|exists:nucleos,id',
            'carrera_id'         => 'required|numeric|exists:carreras,id',
            'primer_name'        => 'required|string|min:2|max:80',
            'segundo_name'       => 'nullable|string|max:80',
            'primer_apellido'    => 'required|string|min:2|max:80',
            'segundo_apellido'   => 'nullable|string|max:80',
            'nacionalidad'       => 'required',
            'cedula'             => 'required|numeric|min_digits:7',
            'genero'             => 'required|string',
            'fecha_nacimiento'   => 'required',
            'nacimiento_city'    => 'nullable|string|max:43',
            'civil'              => 'required|string',
            'email'              => 'required|email|max:100',
            'telefono'           => 'required|numeric|digits:11',
            'telefonohabitacion' => 'nullable|numeric|digits_between:7,11',
            'direccion'          => 'required|string|min:7|max:100',
            'city'               => 'required|string|min:4|max:43',
            'consejo'            => 'nullable|string|min:4|max:80',
            'comuna'             => 'nullable|string|min:4|max:80',
            'discapacidad'       => 'nullable|string|min:4|max:80',
            'disciplina'         => 'nullable|string|min:4|max:80',
            'titulo'             => 'nullable|numeric|exists:title_student_temporal,id',
            'mencion'            => 'nullable|string|min:3|max:30',
            'institucion'        => 'nullable|string|min:4|max:80',
            'fecha_grado'        => 'nullable',
            'promedio'           => 'nullable|numeric|max:3',
            'nivel_social'       => 'nullable|numeric|exists:students_socio_economico,id',
            'trabaja'            => 'nullable|string|min:4|max:43',
            'cityinstitucion'    => 'nullable|string|min:4|max:43',
        ];

        $messages = [
            'required'    => 'El campo :attribute es obligatorio.',
            'numeric'     => 'El campo :attribute debe ser un número.',
            'exists'      => 'El valor seleccionado para :attribute no es válido.',
            'email'       => 'El formato del :attribute es inválido.',
            'max'         => 'El campo :attribute no debe superar los :max caracteres.',
            'min'         => 'El campo :attribute debe tener al menos :min caracteres.',
            'min_digits'  => 'El campo :attribute debe tener al menos :min dígitos.',
            'digits'      => 'El campo :attribute debe tener exactamente :digits dígitos.',
            'string'      => 'El campo :attribute debe ser una cadena de texto.',
        ];

        $fieldNames = [
            'nucleo_id'          => 'Núcleo',
            'carrera_id'         => 'Carrera',
            'primer_name'        => 'Primer Nombre',
            'segundo_name'       => 'Segundo Nombre',
            'primer_apellido'    => 'Primer Apellido',
            'segundo_apellido'   => 'Segundo Apellido',
            'nacionalidad'       => 'Nacionalidad',
            'cedula'             => 'Cédula de Identidad',
            'genero'             => 'Género',
            'fecha_nacimiento'   => 'Fecha de Nacimiento',
            'nacimiento_city'    => 'Ciudad de Nacimiento',
            'civil'              => 'Estado Civil',
            'email'              => 'Correo Electrónico',
            'telefono'           => 'Teléfono Móvil',
            'telefonohabitacion' => 'Teléfono de Habitación',
            'direccion'          => 'Dirección',
            'city'               => 'Ciudad',
            'consejo'            => 'Consejo Comunal',
            'comuna'             => 'Comuna',
            'discapacidad'       => 'Discapacidad',
            'disciplina'         => 'Disciplina',
            'titulo'             => 'Título',
            'mencion'            => 'Mención',
            'institucion'        => 'Institución Educativa',
            'fecha_grado'        => 'Fecha de Grado',
            'promedio'           => 'Promedio',
            'nivel_social'       => 'Nivel Social',
            'trabaja'            => 'Lugar de Trabajo',
            'cityinstitucion'    => 'Ciudad de la Institución',
        ];

        $request->validate($rules, $messages, $fieldNames);

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
            if (is_null($studentsExist)) {
                if (empty($ultimoCodigo)) {
                    if (is_null($request->codigo)) {
                        return redirect()->back()->withInput()->withErrors([
                            'error' => 'Está registrando al primer estudiante, por favor ingrese el código manualmente del último estudiante inscripto en el trayecto inicial (el valor mas alto para seguir con la secuencia en tú núcleo)'
                        ]);
                    } else {
                        $codigo = $request->codigo;
                    }
                } elseif (!is_null($request->codigo)) {
                    $codigo = $request->codigo;
                } else {
                    $codigo = (int) $ultimoCodigo + 1;
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
        }

        $materiasPensum = Pensum::where('carrera_id', $request->carrera_id)
            ->where('tramo_trayecto_id', $request->tramo_trayecto_id)
            ->get();

        if ($materiasPensum->isEmpty()) {
            return redirect()->back()->withInput()->withErrors(['error' => 'No se puede inscribir al estudiante, no existe un pensum definido para esta carrera y tramo.']);
        }

        try {
            $genero = decrypt($request->genero);
        } catch (DecryptException) {
            abort(403, 'Género inválido o manipulado');
        }
        if ($genero !== 'masculino') {
            if ($genero !== 'femenino') {
                return abort(403, 'Genero Manipulado');
            }
        }
        try {
            $nacionalidad = decrypt($request->nacionalidad);
        } catch (DecryptException) {
            abort(403, 'Nacionalidad inválida o manipulada');
        }
        if ($nacionalidad !== 'VE') {
            if ($nacionalidad !== 'EX') {
                return abort(403, 'Nacionalidad Manipulado');
            }
        }
        try {
            $civil = decrypt($request->civil);
        } catch (DecryptException) {
            abort(403, 'Estado Civil inválido o manipulado');
        }
        if ($civil !== 's') {
            if ($civil !== 'c') {
                if ($civil !== 'd') {
                    if ($civil !== 'v') {
                        return abort(403, 'Estado Civil Manipulado');
                    }
                }
            }
        }

        if (!$studentsExist) {
            try {
            DB::transaction(function () use ($civil, $codigo, $genero, $nacionalidad, $nucleo_id, $request, $materiasPensum, $periodo,){
                $datosStudent = [
                    'primer_name' => Str::title(ucwords($request->primer_name)),
                    'segundo_name' => $request->segundo_name ? Str::title(ucwords($request->segundo_name)) : null,
                    'primer_apellido' => Str::title(ucwords($request->primer_apellido)),
                    'segundo_apellido' => $request->segundo_apellido ? Str::title(ucwords($request->segundo_apellido)) : null,
                    'genero' => Str::lower($genero),
                    'nacionalidad' => Str::upper($nacionalidad),
                    'cedula' => $request->cedula,
                    'telefono' => $request->telefono,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'email' => $request->email ? Str::lower($request->email) : null,
                    'direccion' => Str::title(ucwords($request->direccion)),
                    'city' => Str::title(ucwords($request->city)),
                    'nacimiento_city'=> Str::title(ucwords($request->nacimiento_city)),
                    'civil'=>$civil,
                    'telefono2'=>$request->telefono2,
                    'consejo'=> Str::title(ucwords($request->consejo)),
                    'comuna'=> Str::title(ucwords($request->comuna)),
                    'discapacidad'=> Str::title(ucwords($request->discapacidad)),
                    'disciplina'=> Str::title(ucwords($request->disciplina)),
                    'title_student_temporal_id'=>$request->title_student_temporal_id,
                    'mencion'=> Str::title(ucwords($request->mencion)),
                    'institucion'=> Str::title(ucwords($request->institucion)),
                    'cityinstitucion'=> Str::title(ucwords($request->cityinstitucion)),
                    'fecha_grado'=>$request->fecha_grado,
                    'promedio'=>$request->promedio,
                    'students_socio_economico_id'=>$request->students_socio_economico_id,
                    'trabaja'=> Str::title(ucwords($request->trabaja)),
                ];
                $student = Students::create($datosStudent);

                $studentCodigoNucleo = [
                    'students_data_id' => $student->id,
                    'nucleo_id' => $nucleo_id,
                    'codigo' => $codigo,
                ];
                $studentCodigoNucleoCreate = StudentsCodigoNucleo::create($studentCodigoNucleo);
                $inscrip = StudentsInscripciones::create([
                    'students_codigo_nucleo_id' => $studentCodigoNucleoCreate->id,
                    'carrera_id' => $request->carrera_id,
                    'tramo_trayecto_id' => $request->tramo_trayecto_id,
                    'seccion_id' => $request->seccion_id,
                    'periodo_id' => $periodo->id,
                ]);
                foreach ($materiasPensum as $materia) {
                    Notas::create([
                        'pensum_id' => $materia->id,
                        'students_inscripcion_id' => $inscrip->id,
                        'periodo_id' => $periodo->id,
                        'nota' => null
                    ]);
                }
                Mail::to($student->email)->send(new Inscripcion($student, $inscrip));
            });
            } catch (\Exception $th) {
                return redirect()->back()->withInput()->withErrors(['error'=>'Error al procesar los datos: ' . $th]);
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
                try{
                DB::transaction(function () use ($codigo, $nucleo_id, $request, $materiasPensum, $periodo, $studentsExist,){
                    $studentCodigoNucleo = [
                        'students_data_id' => $studentsExist->id,
                        'nucleo_id' => $nucleo_id,
                        'codigo' => $codigo,
                    ];
                    $studentCodigoNucleoCreate = StudentsCodigoNucleo::create($studentCodigoNucleo);

                    $inscrip = StudentsInscripciones::create([
                        'students_codigo_nucleo_id' => $studentCodigoNucleoCreate->id,
                        'carrera_id' => $request->carrera_id,
                        'tramo_trayecto_id' => $request->tramo_trayecto_id,
                        'seccion_id' => $request->seccion_id,
                        'periodo_id' => $periodo->id,
                    ]);
                    foreach ($materiasPensum as $materia) {
                        Notas::create([
                            'pensum_id' => $materia->id,
                            'students_inscripcion_id' => $inscrip->id,
                            'periodo_id' => $periodo->id,
                            'nota' => null
                        ]);
                    }
                });
                } catch (\Exception $th) {
                    return redirect()->back()->withInput()->withErrors(['error'=>'Error al procesar los datos: ' . $th]);
                }
            } else {
                try {
                DB::transaction(function () use ($idStudent, $request, $materiasPensum, $periodo,){
                    $inscrip = StudentsInscripciones::create([
                        'students_codigo_nucleo_id' => $idStudent->id,
                        'carrera_id' => $request->carrera_id,
                        'tramo_trayecto_id' => $request->tramo_trayecto_id,
                        'seccion_id' => $request->seccion_id,
                        'periodo_id' => $periodo->id,
                    ]);
                    foreach ($materiasPensum as $materia) {
                        Notas::create([
                            'pensum_id' => $materia->id,
                            'students_inscripcion_id' => $inscrip->id,
                            'periodo_id' => $periodo->id,
                            'nota' => null
                        ]);
                    }
                });
                } catch (\Exception $th) {
                    return redirect()->back()->withInput()->withErrors(['error'=>'Error al procesar los datos: ' . $th]);
                }
            }
            $student = $studentsExist;
            if (is_null($student)) {
                return redirect()->back()->withInput()->withErrors([
                    'error' => 'Error interno: No se pudo determinar el estudiante.'
                ]);
            }
        }
        return redirect()->back()->with('alert', 'El estudiante fue registado correctamente. ' . $codigo);
    }

    public function studentedit($student)
    {
        $nucleo = Auth::user();
        $estudiantes = Students::where('cedula', $student)->first();
        $courses = Carreras::orderByRaw('carrera ASC')->get();
        $periodo = Periodos::where('activo', true)->first();
        $estudianteData = StudentsInscripciones::whereHas('studentcodigonucleo', function ($a) use ($estudiantes, $nucleo) {
            $a->where('students_data_id', $estudiantes->id)->where('nucleo_id', $nucleo->nucleo_id);
        })->where('periodo_id', $periodo->id)->get();

        // $carrerasIds = $estudianteData->pluck('carrera_id')->unique()->values()->toArray();
        $tramosTrayectosIds = $estudianteData->pluck('tramo_trayecto_id')->unique()->values()->toArray();

        foreach ($estudianteData as $inscripcion) {
            $inscripcion->secciones_conteo = Secciones::withCount(['inscripcion as conteo' => function ($a) use ($inscripcion, $nucleo, $periodo, $tramosTrayectosIds) {
                $a->where('carrera_id', $inscripcion->carrera_id)->where('periodo_id', $periodo->id)
                    ->where('tramo_trayecto_id', $tramosTrayectosIds)
                    ->whereHas('studentcodigonucleo', function ($b) use ($nucleo) {
                        $b->where('nucleo_id', $nucleo->nucleo_id);
                });
            }])->orderByRaw('seccion ASC')->get();
        }

        $titulo = TitleStudentTemporal::all();
        $nivelsocial = StudentSocioEconomico::all();
        return view('auth.studentedit', compact('estudiantes', 'courses', 'periodo', 'titulo', 'nivelsocial', 'estudianteData'));
    }

    public function savestudentedit(Request $request)
    {
        $rules = [
            'primer_name'        => 'required|string|min:2|max:80',
            'segundo_name'       => 'nullable|string|max:80',
            'primer_apellido'    => 'required|string|min:2|max:80',
            'segundo_apellido'   => 'nullable|string|max:80',
            'nacionalidad'       => 'required',
            'cedula'             => 'required|numeric|min_digits:7',
            'genero'             => 'required|string',
            'fecha_nacimiento'   => 'required',
            'nacimiento_city'    => 'nullable|string|max:43',
            'civil'              => 'required|string',
            'email'              => 'required|email|max:100',
            'telefono'           => 'required|numeric|digits:11',
            'telefonohabitacion' => 'nullable|numeric|digits_between:7,11',
            'direccion'          => 'required|string|min:7|max:100',
            'city'               => 'required|string|min:4|max:43',
            'consejo'            => 'nullable|string|min:4|max:80',
            'comuna'             => 'nullable|string|min:4|max:80',
            'discapacidad'       => 'nullable|string|min:4|max:80',
            'disciplina'         => 'nullable|string|min:4|max:80',
            'titulo'             => 'nullable|numeric|exists:title_student_temporal,id',
            'mencion'            => 'nullable|string|min:3|max:30',
            'institucion'        => 'nullable|string|min:4|max:80',
            'fecha_grado'        => 'nullable',
            'promedio'           => 'nullable|integer|min:1|max:20',
            'nivel_social'       => 'nullable|numeric|exists:students_socio_economico,id',
            'trabaja'            => 'nullable|string|min:4|max:43',
            'cityinstitucion'    => 'nullable|string|min:4|max:43',
            'seccion_id.*'       => 'required|integer|min:1|exists:secciones,id',
            'estudiante_encrypt' => 'required|string',
            'periodo_encrypt'    => 'required|string',
            'discapacidadChe'    => 'nullable|string|max:3',
            'deportista'         => 'nullable|string|max:3',
            'trabajaCheck'       => 'nullable|string|max:3',
        ];

        $messages = [
            'required'    => 'El campo :attribute es obligatorio.',
            'numeric'     => 'El campo :attribute debe ser un número.',
            'exists'      => 'El valor seleccionado para :attribute no es válido.',
            'email'       => 'El formato del :attribute es inválido.',
            'max'         => 'El campo :attribute no debe superar los :max caracteres.',
            'min'         => 'El campo :attribute debe tener al menos :min caracteres.',
            'min_digits'  => 'El campo :attribute debe tener al menos :min dígitos.',
            'digits'      => 'El campo :attribute debe tener exactamente :digits dígitos.',
            'string'      => 'El campo :attribute debe ser una cadena de texto.',
        ];

        $fieldNames = [
            'primer_name'        => 'Primer Nombre',
            'segundo_name'       => 'Segundo Nombre',
            'primer_apellido'    => 'Primer Apellido',
            'segundo_apellido'   => 'Segundo Apellido',
            'nacionalidad'       => 'Nacionalidad',
            'cedula'             => 'Cédula de Identidad',
            'genero'             => 'Género',
            'fecha_nacimiento'   => 'Fecha de Nacimiento',
            'nacimiento_city'    => 'Ciudad de Nacimiento',
            'civil'              => 'Estado Civil',
            'email'              => 'Correo Electrónico',
            'telefono'           => 'Teléfono Móvil',
            'telefonohabitacion' => 'Teléfono de Habitación',
            'direccion'          => 'Dirección',
            'city'               => 'Ciudad',
            'consejo'            => 'Consejo Comunal',
            'comuna'             => 'Comuna',
            'discapacidad'       => 'Discapacidad',
            'disciplina'         => 'Disciplina',
            'titulo'             => 'Título',
            'mencion'            => 'Mención',
            'institucion'        => 'Institución Educativa',
            'fecha_grado'        => 'Fecha de Grado',
            'promedio'           => 'Promedio',
            'nivel_social'       => 'Nivel Social',
            'trabaja'            => 'Lugar de Trabajo',
            'cityinstitucion'    => 'Ciudad de la Institución',
            'seccion_id'         => 'Inscripcion del o de la estudiante',
            'estudiante_encrypt' => 'Estudiante',
            'periodo_encrypt'    => 'Periodo',
            'discapacidadChe'    => 'CheckBox de Discapacidad',
            'deportista'         => 'CheckBox de Disciplina',
            'trabajaCheck'       => 'CheckBox de trabajo',
        ];

        $request->validate($rules, $messages, $fieldNames);
        try {
            $nacionalidad = decrypt($request->nacionalidad);
            $genero = decrypt($request->genero);
            $civil = decrypt($request->civil);
            $estudianteDecr = decrypt($request->estudiante_encrypt);
            $periodoDe = decrypt($request->periodo_encrypt);
            if (!$nacionalidad === "VE" or !$nacionalidad === "EX") {
                return redirect()->back()->withErrors(['error'=>'Los valores de nacionalidad estan erroneos']);
            }
            if (!$genero === "femenino" or !$genero === "masculino") {
                return redirect()->back()->withErrors(['error'=>'Los valores de genero estan erroneos']);
            }
            if (!$civil === "s" or !$civil === "c" or !$civil === "d" or !$civil === "v") {
                return redirect()->back()->withErrors(['error'=>'No existe ningún registro del aspirante con esa información']);
            }
        } catch (DecryptException ) {
            return redirect()->back()->withErrors(['error'=>'Falló la lectura de la información para poder proceder con la actualizacion de los datos']);
        }

        $usuario = Auth::user();

        $periodo = Periodos::where('activo', true)->first();
        if (!$periodo) {
            return redirect()->back()->withInput()->withErrors(['error' => 'El periodo que está tratando de usar está cerrado.']);
        }

        $student = Students::find($estudianteDecr);
        if (!$student) {
            return redirect()->back()->withErrors(['error' => 'El identificador del estudiante no es válido']);
        }

        $discapacidad = $request->discapacidad;
        $disciplina   = $request->disciplina;
        $trabaja      = $request->trabaja;
        if($request->discapacidadChe !== "on"){
            $discapacidad = null;
        }
        if($request->deportista !== "on"){
            $disciplina = null;
        }
        if($request->trabajaCheck !== "on"){
            $trabaja = null;
        }

        $student->updateOrFail([
            'primer_name'                   => $request->primer_name,
            'segundo_name'                  => $request->segundo_name,
            'primer_apellido'               => $request->primer_apellido,
            'segundo_apellido'              => $request->segundo_apellido,
            'nacionalidad'                  => $nacionalidad,
            'cedula'                        => $request->cedula,
            'genero'                        => $genero,
            'fecha_nacimiento'              => $request->fecha_nacimiento,
            'nacimiento_city'               => $request->nacimiento_city,
            'civil'                         => $civil,
            'email'                         => $request->email,
            'telefono'                      => $request->telefono,
            'telefono2'                     => $request->telefonohabitacion,
            'direccion'                     => $request->direccion,
            'city'                          => $request->city,
            'consejo'                       => $request->concejo,
            'comuna'                        => $request->comuna,
            'discapacidad'                  => $discapacidad,
            'disciplina'                    => $disciplina,
            'title_student_temporal_id'     => $request->titulo,
            'mencion'                       => $request->mencion,
            'institucion'                   => $request->institucion,
            'cityinstitucion'               => $request->cityinstitucion,
            'fecha_grado'                   => $request->fecha_grado,
            'promedio'                      => $request->promedio,
            'students_socio_economico_id'   => $request->nivel_social,
            'trabaja'                       => $trabaja,
        ]);

        if (!$periodo->id === $periodoDe) {
            return redirect()->back()->withErrors(['error'=>'Se guardaron los datos del estudiante pero no las correcciones de la seccion puesto que el periodo del estudiante es diferente con el periodo actual']);
        }
        $selecIdInscripStudent = array_keys($request->seccion_id);
        $validar = StudentsInscripciones::whereHas('studentcodigonucleo', function ($b) use ($student, $usuario) {
            $b->where('students_data_id', $student->id)->where('nucleo_id', $usuario->nucleo_id);
        })->where('periodo_id', $periodo->id)->whereIn('id', $selecIdInscripStudent)->get();
        if ($validar->count() !== count($selecIdInscripStudent)) {
            return redirect()->back()->withErrors([
                'seccion_id' => 'Se detectó una manipulación de datos. Una o más inscripciones no corresponden a este estudiante.'
            ]);
        }
        foreach ($validar as $inscripcion) {
            $nuevaSeccionId = $request->seccion_id[$inscripcion->id];
            $inscripcion->update([
                'seccion_id' => $nuevaSeccionId
            ]);
        }
        return redirect()->back()->with('alert', 'El estudiante fue actualizado correctamente.');
    }

    public function abrirInscripciones(Request $request) {
        $request->validate([
            'estado'=>'required|string',
        ],[
            'estado.required'=>'Fantan datos para proceder con la apertura de inscripciones',
            'estado.string'=>'Valores no válidos para la apertura de inscripciones',
        ]);
        $usuario = Auth::user();
        $datos = User::where('id', $usuario->id)->firstOrFail();
        $estado = decrypt($request->estado);
        if ($estado === 'abrir') {
            Apertura::updateOrCreate([
                'nucleo_id'=>$datos->nucleo_id,
            ],[
                'estado'=>true,
                'nucleo_id'=>$datos->nucleo_id,
            ]);
        } elseif ($estado === 'cerrar') {
            Apertura::updateOrCreate([
                'nucleo_id'=>$datos->nucleo_id,
            ],[
                'estado'=>false,
                'nucleo_id'=>$datos->nucleo_id,
            ]);
        } else {
            abort('403', 'Datos manipulados');
        }

        return redirect()->back()->with('alert', 'Se aperturó correctamente');
    }

    public function preInscripcion() {
        return view('auth.preinscripcion');
    }

    public function preInscripcionSearch(Request $cedula) {
        $usuario = Auth::user();
        $datos = User::where('id', $usuario->id)->firstOrFail();
        $nucleo_id = $datos->nucleo_id;
        $busqueda = StudentTemporalInscripcion::where('cedula', $cedula->cedula)->where('nucleo_id', $nucleo_id)->first();
        if (!$busqueda) {
            return redirect()->back()->withInput()->withErrors(['error' => 'No Se Encontró Ningún Estudiante Con La Cédula Que Ingresaste']);
        }
        $titulo = TitleStudentTemporal::where('id', $busqueda->title_student_temporal_id)->first();
        $nivel = StudentSocioEconomico::where('id', $busqueda->students_socio_economico_id)->first();
        $carrera = Carreras::where('id', $busqueda->carrera_id)->first();
        $fechana = Carbon::createFromFormat('Y-m-d', $busqueda->fecha_nacimiento)->format('d / m / Y');
        $fechagra = Carbon::createFromFormat('Y-m-d', $busqueda->fecha_grado)->format('d / m / Y');
        $periodo = Periodos::where('nucleo_id', $busqueda->nucleo_id)->where('activo', true)->first();
        $seccion = Secciones::withCount(['inscripcion as conteo' => function ($a) use ($busqueda, $periodo) {
            $a->where('carrera_id', $busqueda->carrera_id)->where('periodo_id', $periodo->id)->where('tramo_trayecto_id', 1)
              ->whereHas('studentcodigonucleo', function ($b) use ($busqueda) {
                  $b->where('nucleo_id', $busqueda->nucleo_id);
              });
        }])->get();
        $seccionCount = $seccion->sum('conteo');
        return view('auth.preInscripcionResults', compact('busqueda', 'titulo', 'nivel', 'carrera', 'fechana', 'fechagra', 'seccionCount', 'seccion'));
    }

    public function preInscripcionRegister(Request $r) {
        $r->validate([
            'informacion'=>'required|string',
            'seccion'=>'required|exists:secciones,id',
        ],[
            'informacion.required'=>'Faltan datos para poder proceder con el registro del aspirante',
            'informacion.string'=>'Los datos que se van a enviar para registrar los aspirantes se detecto que fueron manipulados',
            'seccion.required'=>'Faltan las secciones en los datos para poder proceder con el registro del aspirante',
            'seccion.exists'=>'No existe ninguna sección en el sistema que coincida con el que seleccionaste',
        ]);
        try {
            $informacion = decrypt($r->informacion);
            $confirmacion = StudentTemporalInscripcion::where('cedula', $informacion)->first();
            if (!$confirmacion) {
                return redirect()->back()->withErrors(['error'=>'No existe ningún registro del aspirante con esa información']);
            }
        } catch (DecryptException ) {
            return redirect()->back()->withErrors(['error'=>'Falló la lectura de la información para poder proceder con el registro del aspirante']);
        }
        $tramo = TramoTrayecto::min('id');
        $usuario = Auth::user();
        $datos = User::where('id', $usuario->id)->firstOrFail();
        $periodo = Periodos::where('activo', true)->where('nucleo_id', $confirmacion->nucleo_id)->first();
        $nucleo_id = $datos->nucleo_id;
        $materiasPensum = Pensum::where('carrera_id', $confirmacion->carrera_id)
            ->where('tramo_trayecto_id', $tramo)
            ->get();
        $codigoSea = StudentsCodigoNucleo::where('nucleo_id', $nucleo_id)->max('codigo');
        if (empty($codigoSea)) {
            return redirect()->back()->withErrors(['error'=>"Por favor registre el primer estudiante manualmente. Si ya existen estudiantes regulares registre primero el estudiante con el código más alto de su núcleo"]);
        }
        try {
            DB::transaction(function () use ($codigoSea, $confirmacion, $materiasPensum, $periodo, $r, $tramo){
                $codigo = (int) $codigoSea + 1;
                $estudiante = [
                    'primer_name'=> Str::title(ucwords($confirmacion->primer_name)),
                    'segundo_name'=> Str::title(ucwords($confirmacion->segundo_name)),
                    'primer_apellido'=> Str::title(ucwords($confirmacion->primer_apellido)),
                    'segundo_apellido'=> Str::title(ucwords($confirmacion->segundo_apellido)),
                    'nacionalidad'=>$confirmacion->nacionalidad,
                    'cedula'=>$confirmacion->cedula,
                    'genero'=>$confirmacion->genero,
                    'fecha_nacimiento'=>$confirmacion->fecha_nacimiento,
                    'nacimiento_city'=> Str::title(ucwords($confirmacion->nacimiento_city)),
                    'civil'=>$confirmacion->civil,
                    'email'=>$confirmacion->email,
                    'telefono'=>$confirmacion->telefono,
                    'telefono2'=>$confirmacion->telefono2,
                    'direccion'=> Str::title(ucwords($confirmacion->direccion)),
                    'city'=> Str::title(ucwords($confirmacion->city)),
                    'consejo'=> Str::title(ucwords($confirmacion->consejo)),
                    'comuna'=> Str::title(ucwords($confirmacion->comuna)),
                    'discapacidad'=> Str::title(ucwords($confirmacion->discapacidad)),
                    'disciplina'=> Str::title(ucwords($confirmacion->disciplina)),
                    'title_student_temporal_id'=>$confirmacion->title_student_temporal_id,
                    'mencion'=> Str::title(ucwords($confirmacion->mencion)),
                    'institucion'=> Str::title(ucwords($confirmacion->institucion)),
                    'cityinstitucion'=> Str::title(ucwords($confirmacion->cityinstitucion)),
                    'fecha_grado'=>$confirmacion->fecha_grado,
                    'promedio'=>$confirmacion->promedio,
                    'students_socio_economico_id'=>$confirmacion->students_socio_economico_id,
                    'trabaja'=> Str::title(ucwords($confirmacion->trabaja)),
                ];

                $studentId = Students::create($estudiante);

                $codigoNu = [
                    'students_data_id' => $studentId->id,
                    'nucleo_id'=>$confirmacion->nucleo_id,
                    'codigo'=>$codigo,
                ];

                $codigoNuId = StudentsCodigoNucleo::create($codigoNu);

                $inscrip = StudentsInscripciones::create([
                    'students_codigo_nucleo_id'=>$codigoNuId->id,
                    'carrera_id'=>$confirmacion->carrera_id,
                    'seccion_id'=>$r->seccion,
                    'tramo_trayecto_id'=>$tramo,
                    'periodo_id'=>$periodo->id,
                ]);
                foreach ($materiasPensum as $materia) {
                    Notas::create([
                        'pensum_id' => $materia->id,
                        'students_inscripcion_id' => $inscrip->id,
                        'periodo_id' => $periodo->id,
                        'nota' => null
                    ]);
                }

                $confirmacion->delete();
                Mail::to($studentId->email)->send(new ConfirmInscripcion($studentId));
            });
            return redirect()->route('students.aspirante')->with('alert', 'Se registró correctamente al aspirante dentro de la institución');
        } catch (\Exception $th) {
            return redirect()->back()->withErrors(['error'=>'Error al procesar la solicitud' . $th]);
        }
    }


}
