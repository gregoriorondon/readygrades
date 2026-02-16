<?php

namespace App\Http\Controllers;

use App\Mail\PreInscripcion;
use App\Models\Apertura;
use App\Models\Carreras;
use App\Models\ConstanciaEstudios;
use App\Models\Notas;
use App\Models\NucleoCarrera;
use App\Models\Nucleos;
use App\Models\Pensum;
use App\Models\Periodos;
use App\Models\StudentDatoInscripciones;
use App\Models\StudentPublic;
use App\Models\Students;
use App\Models\StudentsCodigoNucleo;
use App\Models\StudentsInscripciones;
use App\Models\StudentSocioEconomico;
use App\Models\StudentTemporalInscripcion;
use App\Models\TitleStudentTemporal;
use App\Models\TituloAcademico;
use App\Models\TramoTrayecto;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Container\Attributes\DB as AttributesDB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

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
        $inscripcion = Apertura::where('estado', 1)->first();
        return view('estudiantes', compact('nucleos', 'inscripcion'));
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
        try {
            $cedula = decrypt($request->student);
        } catch (DecryptException) {
            abort(403, 'Cédula inválido o manipulado');
        }
        try {
            $nucleo = decrypt($request->nucleo);
        } catch (DecryptException) {
            abort(403, 'Núcleo inválido o manipulado');
        }
        try {
            $carrera = decrypt($request->carrera);
        } catch (DecryptException) {
            abort(403, 'Carrera inválida o manipulada');
        }
        try {
            $valor = decrypt($request->cursar);
        } catch (DecryptException) {
            abort(403, 'Datos inválidos o manipulados');
        }
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

    public function studentPreInscripcion() {
        $nucleos = Apertura::where('estado', 1)->get();
        $carreras = NucleoCarrera::all();
        $nivelsocial = StudentSocioEconomico::all();
        $titulo = TitleStudentTemporal::all();
        return view('/inscribirse', compact('nucleos', 'carreras', 'nivelsocial', 'titulo'));
    }
    public function studentPreInscripcionStore(Request $r) {
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
            'nacimiento_city'    => 'required|string|max:43',
            'civil'              => 'required|string',
            'email'              => 'required|email|max:100',
            'telefono'           => 'required|numeric|digits:11',
            'telefonohabitacion' => 'nullable|numeric|digits_between:7,11',
            'direccion'          => 'required|string|min:7|max:100',
            'city'               => 'required|string|min:4|max:43',
            'consejo'            => 'required|string|min:4|max:80',
            'comuna'             => 'required|string|min:4|max:80',
            'discapacidad'       => 'nullable|string|min:4|max:80',
            'disciplina'         => 'nullable|string|min:4|max:80',
            'titulo'             => 'required|numeric|exists:title_student_temporal,id',
            'mencion'            => 'required|string|min:3|max:30',
            'institucion'        => 'required|string|min:4|max:80',
            'fecha_grado'        => 'required',
            'promedio'           => 'required|numeric|max:43',
            'nivel_social'       => 'required|numeric|exists:students_socio_economico,id',
            'trabaja'            => 'nullable|string|min:4|max:43',
            'cityinstitucion'    => 'required|string|min:4|max:43',
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

        $r->validate($rules, $messages, $fieldNames);

        $titulo = TitleStudentTemporal::where('id', $r->titulo)->first();
        $nivelsocial = StudentSocioEconomico::where('id', $r->nivel_social)->first();
        $carreras = NucleoCarrera::where('nucleo_id', $r->nucleo_id)->where('carrera_id', $r->carrera_id)->first();
        if($carreras === null){
            return abort(403, 'Carrera/Núcleo Manipulados');
        }
        if($r->nacionalidad === null){
            return abort(403, 'Nacionalidad Manipulados');
        }
        if($r->genero === null){
            return abort(403, 'Genero Manipulados');
        }
        if($r->titulo === null){
            return abort(403, 'Título Manipulados');
        }
        if($r->nivel_social === null){
            return abort(403, 'Nivel Social Manipulados');
        }
        try {
            $genero = decrypt($r->genero);
        } catch (DecryptException) {
            abort(403, 'Género inválido o manipulado');
        }
        if ($genero !== 'masculino') {
            if ($genero !== 'femenino') {
                return abort(403, 'Genero Manipulado');
            }
        }
        try {
            $nacionalidad = decrypt($r->nacionalidad);
        } catch (DecryptException) {
            abort(403, 'Nacionalidad inválida o manipulada');
        }
        if ($nacionalidad !== 'VE') {
            if ($nacionalidad !== 'EX') {
                return abort(403, 'Nacionalidad Manipulado');
            }
        }
        try {
            $civil = decrypt($r->civil);
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
        $tramo = TramoTrayecto::first();
        $cedulaExist = StudentTemporalInscripcion::where('cedula', $r->cedula)->first();
        if ($cedulaExist !== null) {
            return redirect('/download-planilla-pregrado/' . $cedulaExist->cedula );
        }
        try {
            DB::transaction(function () use ($civil, $genero, $nacionalidad, $r, $carreras, $nivelsocial, $titulo) {
                StudentTemporalInscripcion::create([
                    'nucleo_id'=>$r->nucleo_id,
                    'carrera_id'=>$r->carrera_id,
                    'primer_name'=>$r->primer_name,
                    'segundo_name'=>$r->segundo_name,
                    'primer_apellido'=>$r->primer_apellido,
                    'segundo_apellido'=>$r->segundo_apellido,
                    'nacionalidad'=>$nacionalidad,
                    'cedula'=>$r->cedula,
                    'genero'=>$genero,
                    'fecha_nacimiento'=>$r->fecha_nacimiento,
                    'nacimiento_city'=>$r->nacimiento_city,
                    'civil'=>$civil,
                    'email'=>$r->email,
                    'telefono'=>$r->telefono,
                    'telefono2'=>$r->telefonohabitacion,
                    'direccion'=>$r->direccion,
                    'city'=>$r->city,
                    'consejo'=>$r->consejo,
                    'comuna'=>$r->comuna,
                    'discapacidad'=>$r->discapacidad,
                    'disciplina'=>$r->disciplina,
                    'title_student_temporal_id'=>$r->titulo,
                    'mencion'=>$r->mencion,
                    'institucion'=>$r->institucion,
                    'cityinstitucion'=>$r->cityinstitucion,
                    'fecha_grado'=>$r->fecha_grado,
                    'promedio'=>$r->promedio,
                    'students_socio_economico_id'=>$r->nivel_social,
                ]);
                $nacimiento = Carbon::parse($r->fecha_nacimiento);
                $fecha = Carbon::now();
                $edad = $fecha->diff($nacimiento);
                $dia = $fecha->day;
                $mes = $fecha->isoFormat('MMMM');
                $anio = $fecha->year;
                $pdf = Pdf::loadView('pdf.inscripcionPublica',
                    compact([
                        'r',
                        'dia',
                        'mes',
                        'anio',
                        'genero',
                        'nacionalidad',
                        'civil',
                        'edad',
                        'titulo',
                        'nivelsocial',
                        'carreras',
                    ]));
                $filename = 'Planilla_de_inscripcion_' . $r['primer_name'] . '_' . $r['primer_apellido'] . '_' . $r['cedula'] . '.pdf';
                Mail::to($r->email)->send(new PreInscripcion($pdf->output(), $filename, $r, $genero));
            });
            return redirect('/student')->with('alert', 'Sus datos se guardaron con exito, se acaba de enviar a tu correo electrónico que colocaste en el formulario un documento adjunto que debes imprimir y entregar al personal de ARSCE para que te aprueben el ingreso a nuestra institución UPTTMBI.');
        } catch (QueryException) {
            return redirect()->back()->withInput()->with('error', 'Error al guardar en la base de datos. Por favor, intente de nuevo.');
        } catch (TransportExceptionInterface) {
            return redirect()->back()->withInput()->with('error', 'No pudimos enviar el correo de confirmación, pero sus datos fueron recibidos.');
        } catch (\Exception) {
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error inesperado al procesar la solicitud.');
        }
    }

    public function studentPlanillaPreInscripcion($cedula) {
        $r = StudentTemporalInscripcion::where('cedula', $cedula)->first();
        $civil = $r->civil;
        $genero = $r->genero;
        $nacionalidad = $r->nacionalidad;
        $titulo = TitleStudentTemporal::where('id', $r->title_student_temporal_id)->first();
        $nivelsocial = StudentSocioEconomico::where('id', $r->students_socio_economico_id)->first();
        $carreras = NucleoCarrera::where('nucleo_id', $r->nucleo_id)->where('carrera_id', $r->carrera_id)->first();
        $nacimiento = Carbon::parse($r->fecha_nacimiento);
        $fechana = Carbon::createFromFormat('Y-m-d', $r->fecha_nacimiento)->format('d / m / Y');
        $fechagra = Carbon::createFromFormat('Y-m-d', $r->fecha_grado)->format('d / m / Y');
        $fecha = Carbon::now();
        $edad = $fecha->diff($nacimiento);
        $dia = $fecha->day;
        $mes = $fecha->isoFormat('MMMM');
        $anio = $fecha->year;
        $pdf = Pdf::loadView('pdf.inscripcionPublica',
            compact([
                'r',
                'dia',
                'mes',
                'anio',
                'fechana',
                'fechagra',
                'genero',
                'nacionalidad',
                'civil',
                'edad',
                'titulo',
                'nivelsocial',
                'carreras',
            ]));
        $filename = 'Planilla_de_inscripcion_' . $r['primer_name'] . '_' . $r['primer_apellido'] . '_' . $r['cedula'] . '.pdf';
        Mail::to($r->email)->send(new PreInscripcion($pdf->output(), $filename, $r, $genero));
        return view('downloadPlanilla', compact('cedula', 'r'));
    }
    public function studentPlanillaPreInscripcionDownload($cedula) {
        $r = StudentTemporalInscripcion::where('cedula', $cedula)->first();
        $civil = $r->civil;
        $genero = $r->genero;
        $nacionalidad = $r->nacionalidad;
        $titulo = TitleStudentTemporal::where('id', $r->title_student_temporal_id)->first();
        $nivelsocial = StudentSocioEconomico::where('id', $r->students_socio_economico_id)->first();
        $carreras = NucleoCarrera::where('nucleo_id', $r->nucleo_id)->where('carrera_id', $r->carrera_id)->first();
        $nacimiento = Carbon::parse($r->fecha_nacimiento);
        $fechana = Carbon::createFromFormat('Y-m-d', $r->fecha_nacimiento)->format('d / m / Y');
        $fechagra = Carbon::createFromFormat('Y-m-d', $r->fecha_grado)->format('d / m / Y');
        $fecha = Carbon::now();
        $edad = $fecha->diff($nacimiento);
        $dia = $fecha->day;
        $mes = $fecha->isoFormat('MMMM');
        $anio = $fecha->year;
        $pdf = Pdf::loadView('pdf.inscripcionPublica',
            compact([
                'r',
                'dia',
                'mes',
                'anio',
                'fechana',
                'fechagra',
                'genero',
                'nacionalidad',
                'civil',
                'edad',
                'titulo',
                'nivelsocial',
                'carreras',
            ]));
        $filename = 'Planilla_de_inscripcion_' . $r['primer_name'] . '_' . $r['primer_apellido'] . '_' . $r['cedula'] . '.pdf';
        return $pdf->download($filename);
    }
}
