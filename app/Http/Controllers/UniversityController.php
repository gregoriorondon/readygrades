<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\ConstanciaEstudios;
use App\Models\Notas;
use App\Models\Nucleos;
use App\Models\Pensum;
use App\Models\Periodos;
use App\Models\StudentDatoInscripciones;
use App\Models\StudentPublic;
use App\Models\Students;
use App\Models\StudentsCodigoNucleo;
use App\Models\StudentsInscripciones;
use App\Models\TituloAcademico;
use App\Models\TramoTrayecto;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    public function index()
    {
        return view('home-original');
    }

    public function autoridades() {
        return view('autoridades');
    }

    public function nucleos()
    {
        return view('nucleos');
    }

    public function organigrama()
    {
        return view('organigrama');
    }

    public function students()
    {
        $nucleos = Nucleos::all();
        return view('estudiantes', compact('nucleos'));
    }

    public function studentspublicdetails(Request $request)
    {
        $request->validate([
            'cedula' => 'required|numeric|exists:students_data,cedula',
            'nucleo_id' => 'required|numeric|exists:nucleos,id',
        ], [
            'cedula.required' => 'El campo cédula es obligatorio.',
            'nucleo_id.required' => 'Es obligatorio seleccionar el núcleo académico.',
            'cedula.exists' => 'La cédula ingresada no se encuentra registrada.',
            'nucleo_id.exists' => 'El núcleo académico que seleccionó no se encuentra registrada.',
            'cedula.numeric' => 'El campo cédula debe contener solo números.',
            'nucleo_id.numeric' => 'El valor del núcleo debe contener solo números.',
        ]);
        // ***********************************************************
        // *************Datos Basicos Del Estudiante******************
        // ***********************************************************
        $estudiante = StudentPublic::where('cedula', $request->cedula)->first();
        $estudianteData = StudentsCodigoNucleo::with([
            'inscripciones', 'nucleo'
        ])->where('students_data_id', $estudiante->id)->orderBy('created_at', 'desc')->first();

        // ******* Validar Si El Estudiante Existe *******
        if (!$estudiante) {
            return redirect()->back()->withInput()->withErrors(['cedula' => 'No se encuentra registrado en nuestra institución como un estudiante.']);
        }
        $estudianteDataVa = StudentsCodigoNucleo::with(['nucleo'])->where('students_data_id', $estudiante->id)
            ->where('nucleo_id', $request->nucleo_id)
            ->orderBy('created_at', 'desc')
            ->first();
        if (!$estudianteDataVa) {
            return redirect()->back()->withInput()->withErrors(['nucleo_id' => 'El núcleo seleccionado no coincide con el del estudiante.']);
        }
        $carreraParaLaConstancia = StudentsInscripciones::with('carreras', 'secciones')
            ->where('students_codigo_nucleo_id', $estudianteDataVa->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $seccion = StudentsInscripciones::with('secciones')
            ->where('students_codigo_nucleo_id', $estudianteDataVa->id)
            ->orderBy('created_at', 'desc')
            ->first();


        $estudianteIns = $estudianteData->studentsInscripcion;
        $estudianteNu = $estudianteDataVa->nucleo;
        $registrosAcademicos = $carreraParaLaConstancia
            ->map(function ($inscripcion) {
                return $inscripcion->carreras;
            })
            ->filter()
            ->unique('id');
        $estudianteSec = $seccion->secciones;

        $usuario = User::where('nucleo_id', $estudianteDataVa->nucleo->id)->first();

        $carrerasIds = $carreraParaLaConstancia->pluck('carrera_id')->unique()->toArray();
        $tramoTrayectoIds = $carreraParaLaConstancia->pluck('tramo_trayecto_id')->unique()->toArray();
        $fechaPeriodo = Periodos::where('activo', true)->where('nucleo_id', $request->nucleo_id)->first();
        $inscripcion = StudentsInscripciones::where('students_codigo_nucleo_id', $estudianteDataVa->id)->first();
        $inscripciones = StudentsInscripciones::where('students_codigo_nucleo_id', $estudianteDataVa->id)->latest()->get()->unique('carrera_id');
        $notas = Notas::with([
            'pensums.materias',
            'pensums.carreras',
            'pensums.tramoTrayecto.tramos',
            'pensums.tramoTrayecto.trayectos',
            'periodos'
        ])
        ->where('students_inscripcion_id', $inscripcion->id)
        ->whereHas('pensums', function($q) use ($carrerasIds, $tramoTrayectoIds) {
            $q->whereIn('carrera_id', $carrerasIds)
                  ->whereIn('tramo_trayecto_id', $tramoTrayectoIds);
        })->get();

        if ($fechaPeriodo !== null) {
            $fechaInscripcion = Carbon::parse($fechaPeriodo->fin_inscripcion);
        } else {
            $fechaInscripcion = null;
        }


        $notasAgrupadas = [];
        $tramosActuales = [];

        foreach ($notas as $nota) {
            $carreraId = $nota->pensums->carreras->id;
            $tramoId = $nota->pensums->tramoTrayecto->id;

            // Inicializar estructura de carrera si no existe
            if (!isset($notasAgrupadas[$carreraId])) {
                $notasAgrupadas[$carreraId] = [
                    'carrera' => $nota->pensums->carreras,
                    'tramos' => []
                ];
            }

            // Inicializar estructura de tramo si no existe
            if (!isset($notasAgrupadas[$carreraId]['tramos'][$tramoId])) {
                $notasAgrupadas[$carreraId]['tramos'][$tramoId] = [
                    'tramo' => $nota->pensums->tramoTrayecto,
                    'materias' => []
                ];

                // También llenar tramosActuales para la sección de datos personales
                $tramosActuales[$carreraId] = [
                    'tramo_nombre' => $nota->pensums->tramoTrayecto->tramos->tramos ?? 'Tramo no especificado',
                    'trayecto_nombre' => $nota->pensums->tramoTrayecto->trayectos->trayectos ?? 'Trayecto no especificado',
                    'carrera' => $nota->pensums->carreras
                ];
            }

            // Agregar la materia con su nota
            $notasAgrupadas[$carreraId]['tramos'][$tramoId]['materias'][$nota->pensums->materias->id] = [
                'materia' => $nota->pensums->materias,
                'nota' => $nota
            ];
        }
        return view('detalles-estudiante-publico', compact(
            'estudiante',
            'inscripciones',
            'notasAgrupadas',
            'tramosActuales',
            'registrosAcademicos',
            'usuario',
            'estudianteIns',
            'estudianteNu',
            'estudianteSec',
            'estudianteData',
            'estudianteDataVa',
            'fechaPeriodo',
            'fechaInscripcion',
        ));
    }

    public function generarprocess(Request $request)
    {
        if ($request->cedula === null) {
            abort(403, 'Datos eliminados o manipulados');
        }
        $datosgenerar = $request->validate([
            'cedula' => 'required|string',
            'carrera_id' => 'required|numeric|exists:carreras,id',
        ], [
            'cedula.required' => 'Es necesario que mantenga el contenido original.',
            'cedula.string' => 'La no debe alterar el valor del estudiante.',
            'carrera_id.required' => 'Es necesario que coloque la ccarrera del estudiante.',
            'carrera_id.numeric' => 'La carrera no debe contener carácteres no númericos.',
            'carrera_id.exists' => 'La ccarrera no coincide con las carreras del sistema.',
        ]);
        try {
            $encriptado = decrypt($request->cedula);
        } catch (DecryptException) {
            abort(403, 'Datos inválidos o manipulados');
        }
        $existe = StudentPublic::where('cedula', $encriptado['cedula'])->first();
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

        $fechaPeriodo = Periodos::where('activo', true)->first();
        if ($fechaPeriodo === null) {
            return redirect()->back()->withErrors(['error', 'No hay un periodo a académico activo en su núcleo universitario']);
        }
        $fechaPeriodoInicio = Carbon::parse($fechaPeriodo->inicio);
        $fechaPeriodoFin = Carbon::parse($fechaPeriodo->fin);
        $anioPeriodoInicio = $fechaPeriodoInicio->year;
        $mesPeriodoInicio = $fechaPeriodoInicio->isoFormat('MMMM');
        $diaPeriodoInicio = $fechaPeriodoInicio->day;
        $anioPeriodoFin = $fechaPeriodoFin->year;
        $mesPeriodoFin = $fechaPeriodoFin->isoFormat('MMMM');
        $diaPeriodoFin = $fechaPeriodoFin->day;
        $opciones = [
            'fontDir' => resource_path('fonts/Courierpdf/'),
        ];
        $informacion = ConstanciaEstudios::first();
        $activo = Periodos::where('activo', true)->first();
        $estudiante = StudentPublic::where('cedula', $encriptado['cedula'])->first();
        $estudianteData = StudentsCodigoNucleo::with([
            'inscripciones', 'nucleo'
        ])->where('students_data_id', $estudiante->id)->orderBy('created_at', 'desc')->first();
        $estudianteNu = $estudianteData->nucleo;
        $estudianteInscr = StudentsInscripciones::with('secciones', 'carreras')
            ->where('students_codigo_nucleo_id', $estudianteData->id)
            ->first();
        $estudiantes = StudentsInscripciones::where('students_codigo_nucleo_id', $estudianteData->students_codigo_nucleo_id)
            ->where('periodo_id', $activo->id)
            ->get();
        $carreras = Carreras::with('titulos')->find($request->carrera_id);
        $titulosacademicos = TituloAcademico::where('carrera_id', $estudianteInscr->carrera_id)
            ->where('tramo_trayecto_id', '<=', $estudianteInscr->tramo_trayecto_id)
            ->orderBy('tramo_trayecto_id', 'desc')
            ->first();
        $usuario = User::with(['cargos' => function($q){
            $q->where('encargado', true);
        }, 'estudios'])
            ->where('nucleo_id', $estudianteData->nucleo_id)
            ->first();
        $pdf = Pdf::loadView(
            'pdf.constanciaestudios',
            compact([
                'informacion',
                'usuario',
                'estudiante',
                'estudiantes',
                'diaTexto',
                'dia',
                'mes',
                'anio',
                'titulosacademicos',
                'carreras',
                'anioPeriodoInicio',
                'mesPeriodoInicio',
                'diaPeriodoInicio',
                'anioPeriodoFin',
                'mesPeriodoFin',
                'diaPeriodoFin',
                'fechaPeriodo',
                'estudianteInscr',
                'estudianteData',
                'estudianteNu',
            ])
        )->setOption($opciones);
        $filename = 'Constancia_de_estudios_' . $estudiante['primer_name'] . '_' . $estudiante['primer_apellido'] . '_' . $estudiante['cedula'] . '.pdf';
        return $pdf->download($filename);
    }

    public function studentinscripcion(Request $request) {
        if ($request->student === null || $request->cursar === null || $request->nucleo === null) {
            abort(403, 'Datos eliminados o manipulados');
        }
        $request->validate([
            'student' => 'required|string',
            'nucleo' => 'required|string',
            'carrera' => 'required|string',
            'cursar' => 'required|string'
        ],[
            'student.required' => 'No deben de ser manipulados los datos que son necesario para ser enviados',
            'student.string' => 'Los datos del estudiante fueron afectados, por lo que no se hará ningun registro, intentelo mas tarde',
            'nucleo.required' => 'No deben de ser manipulados los datos que son necesario para ser enviados',
            'nucleo.string' => 'Los datos del estudiante fueron afectados, por lo que no se hará ningun registro, intentelo mas tarde',
            'carrera.required' => 'No deben de ser manipulados los datos que son necesario para ser enviados',
            'carrera.string' => 'Los datos del estudiante fueron afectados, por lo que no se hará ningun registro, intentelo mas tarde',
            'cursar.required' => 'No deben de ser manipulados los datos que son necesario para ser enviados',
            'cursar.string' => 'Los datos de la carrera fueron afectados, por lo que no se hará ningun registro, intentelo mas tarde',
        ]);
        $cedula = decrypt($request->student);
        $nucleo = decrypt($request->nucleo);
        $carrera = decrypt($request->carrera);
        $valor = decrypt($request->cursar);
        if($valor !== 'true'){
            return redirect()->back()->withErrors(['error' => 'No se pudo registrar el nuevo periodo académico']);
        }
        $codigo = StudentsInscripciones::where('carrera_id', (int)$carrera)->whereHas('studentcodigonucleo', function ($a) use ($nucleo, $cedula){
            $a->where('nucleo_id', $nucleo)->whereHas('student', function ($b) use ($cedula){
                $b->where('cedula', $cedula);
            });
        })->first();
        $fechaPeriodo = Periodos::where('activo', true)->where('nucleo_id', $nucleo)->first();
        if ($fechaPeriodo !== null) {
            $fechaInscripcion = Carbon::parse($fechaPeriodo->fin_inscripcion);
            if ($fechaInscripcion->isPast()) {
                abort(404, 'Fecha De Inscripción Vencida');
            } else {
                $tramo = TramoTrayecto::where('id', '>', $codigo->tramo_trayecto_id)->first();
                if ($tramo->id !== null) {
                    $materiasPensum = Pensum::where('carrera_id', $carrera)
                        ->where('tramo_trayecto_id', $tramo->id)
                        ->get();
                    if ($materiasPensum->isEmpty()) {
                        return redirect('/student')->withErrors(['error' => 'No se puede inscribir al estudiante, no existe un pensum definido para esta carrera y tramo.']);
                    }
                    try {
                        DB::transaction(function () use ($codigo, $carrera, $tramo, $fechaPeriodo, $materiasPensum) {
                            $inscrip = StudentsInscripciones::create([
                                'students_codigo_nucleo_id' => $codigo->studentcodigonucleo->id,
                                'carrera_id' => $carrera,
                                'tramo_trayecto_id' => $tramo->id,
                                'seccion_id' => $codigo->seccion_id,
                                'periodo_id' => $fechaPeriodo->id,
                            ]);
                            foreach ($materiasPensum as $materia) {
                                Notas::create([
                                    'pensum_id' => $materia->id,
                                    'students_inscripcion_id' => $inscrip->id,
                                    'periodo_id' => $fechaPeriodo->id,
                                    'nota' => null
                                ]);
                            }
                        });
                        return redirect('/student')->with('alert', "Felicidades, inscripción completada con éxito.\nExitos en este nuevo periodo académico.");
                    } catch (\Exception $e) {
                        return redirect('/student')->withErrors(['error' => 'Error en el proceso: ' . $e->getMessage()]);
                    }
                } else {
                    abort(404, 'no hay mas tramos registrados');
                }
            }
        } else {
            $fechaInscripcion = null;
        }
    }
}
