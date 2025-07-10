<?php

namespace App\Http\Controllers;

use App\Models\Asignar;
use App\Models\Carreras;
use App\Models\Materias;
use App\Models\Notas;
use App\Models\Nucleos;
use App\Models\Periodos;
use App\Models\Students;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesorController extends Controller
{
    //
    public function board()
    {
        $user = Auth::guard('teachers')->user();
        // $user = Auth::user();
        $carreras = Carreras::count();
        $estudiantes = Students::count();
        $nucleos = Nucleos::count();

        return view('auth.dashSection', compact('user', 'carreras', 'estudiantes', 'nucleos'));
    }

    // ==================================================================================
    // ============== VER ASIGNACIONES DE CARREREAS TRAMOS Y MATERIA ====================
    // ==================================================================================
    public function asignaciones()
    {
        $user = Auth::guard('teachers')->user();
        $asignaciones = Asignar::with([
            'pensums.carreras',
            'pensums.tramoTrayecto.tramos',
            'pensums.materias',
            'secciones'
        ])
            ->where('profesor_id', $user->id)
            ->get();

        // Agrupar por carrera y tramo
        $agrupadas = [];
        foreach ($asignaciones as $asignacion) {
            $carreraId = $asignacion->pensums->carrera_id;
            $tramoId = $asignacion->pensums->tramoTrayecto->tramos->id;
            $carreraNombre = $asignacion->pensums->carreras->carrera;
            $tramoNombre = $asignacion->pensums->tramoTrayecto->tramos->tramos;
            if (!isset($agrupadas[$carreraId])) {
                $agrupadas[$carreraId] = [
                    'carrera' => $carreraNombre,
                    'tramos' => []
                ];
            }
            if (!isset($agrupadas[$carreraId]['tramos'][$tramoId])) {
                $agrupadas[$carreraId]['tramos'][$tramoId] = [
                    'nombre' => $tramoNombre,
                    'asignaciones' => []
                ];
            }
            $asignacion->students = Students::where('carrera_id', $carreraId)
                ->where('tramo_trayecto_id', $asignacion->pensums->tramo_trayecto_id)
                ->where('seccion_id', $asignacion->seccion_id)
                ->get();

            $agrupadas[$carreraId]['tramos'][$tramoId]['asignaciones'][] = $asignacion;
        }
        return view('auth.docente.asignado', compact('agrupadas'));
    }

    // ==================================================================================
    // ============== CALIFICAR ESTUDIANTES SELECCIONADOS ====================
    // ==================================================================================
    public function calificaciones($asignacion_id, $estudiante_id)
    {
        $asignacion = Asignar::with('pensums.materias')->findOrFail($asignacion_id);
        $estudiante = Students::findOrFail($estudiante_id);
        $lapso = Periodos::all()->first();
        $pensumId = $asignacion->pensum_id;  // O usa pluck() si hay múltiples

        $notas = Notas::where('pensum_id', $pensumId)
            ->where('periodo_id', $lapso->id)
            ->where('student_id', $estudiante_id)  // Filtra por estudiante
            ->first();

        if (!$notas) {
            return redirect()->back()->withErrors(['error'=>'El o la estudiante que fue asígnado a usted, su inscripción tuvo un error, porfavor informe este hecho para resolver el error']);
        }
        return view('auth.docente.calificar', compact('asignacion', 'estudiante', 'notas'));
    }

    public function guardarcalificacion(Request $request)
    {
        $request->validate([
            'asignacion_id' => 'required|exists:profesor_asignar,id',
            'estudiante_id' => 'required|exists:students,id',
            'pensum_id' => 'required|exists:pensum,id',
            'nota_uno' => 'nullable|numeric|min:0|max:20',
            'nota_dos' => 'nullable|numeric|min:0|max:20',
            'nota_tres' => 'nullable|numeric|min:0|max:20',
            'nota_cuatro' => 'nullable|numeric|min:0|max:20',
            'notaExtra' => 'nullable|numeric|min:0|max:20',
            // 'nota_definitiva' => 'required|numeric|min:0|max:20',
        ], [
            'asignacion_id.required' => 'Debe usar el identificador de la asignación.',
            'asignacion_id.exists' => 'La asignación que está tratando de usar no existe.',
            'estudiante_id.required' => 'Debe usar el identificador de la asignación.',
            'estudiante_id.exists' => 'La asignación que está tratando de usar no existe.',
            'pensum_id.required' => 'Debe usar el identificador de la asignación.',
            'pensum_id.exists' => 'La asignación que está tratando de usar no existe.',
            'nota_uno' => 'nullable|numeric|min:0|max:20',
            'nota_dos' => 'nullable|numeric|min:0|max:20',
            'nota_tres' => 'nullable|numeric|min:0|max:20',
            'nota_cuatro' => 'nullable|numeric|min:0|max:20',
            'notaExtra' => 'nullable|numeric|min:0|max:20',
            // 'nota_definitiva.required' => 'Es necesario que ingrese la nota definitiva',
            // 'nota_definitiva.numeric' => 'La definitiva debe ser un valor numérico',
        ]);
        $periodo = Periodos::where('activo', true)->first();

        $notas = Notas::where([
            'pensum_id' => $request->pensum_id,
            'student_id' => $request->estudiante_id,
            'periodo_id' => $periodo->id,
        ])->first();

        if (!$notas) {
            Notas::create([
                'pensum_id' => $request->pensum_id,
                'student_id' => $request->estudiante_id,
                'periodo_id' => $periodo->id,
                'nota_uno' => $request->nota_uno,
                'nota_dos' => $request->nota_dos,
                'nota_tres' => $request->nota_tres,
                'nota_cuatro' => $request->nota_cuatro,
                // 'nota_recuperacion' => $request->notaExtra,
                // 'nota_definitiva' => $request->nota_definitiva,
            ]);
        } else {
            if (is_null($notas->nota_uno) && !is_null($request->nota_uno)) {
                $notas->nota_uno = $request->nota_uno;
            }
            if (is_null($notas->nota_dos) && !is_null($request->nota_dos)) {
                $notas->nota_dos = $request->nota_dos;
            }
            if (is_null($notas->nota_tres) && !is_null($request->nota_tres)) {
                $notas->nota_tres = $request->nota_tres;
            }
            if (is_null($notas->nota_cuatro) && !is_null($request->nota_cuatro)) {
                $notas->nota_cuatro = $request->nota_cuatro;
            }
            if (is_null($notas->nota_recuperacion) && !is_null($request->notaExtra)) {
                $notas->nota_recuperacion = $request->notaExtra;
            }

            $notas->save();
        }

        return redirect()->back()->with('alert', 'Notas guardadas correctamente');
    }

    // ==================================================================================
    // ============== DESCARGAR CALIFICACIONES DE ESTUDIANTES EN PDF ====================
    // ==================================================================================
    public function descargarcalificacion(Request $request)
    {
        $request->validate([
            'aula' => 'nullable|string|max:26',
            'carrera' => 'required|string',
            'codigoasig' => 'required|string',
            'tramo' => 'required|string',
            'asignatura' => 'required|string',
            'primernombre' => 'required|array',
            'primernombre.*' => 'required|string',
            'segundonombre' => 'nullable|array',
            'segundonombre.*' => 'nullable|string',
            'primerapellido' => 'required|array',
            'primerapellido.*' => 'required|string',
            'segundoapellido' => 'nullable|array',
            'segundoapellido.*' => 'nullable|string',
            'cedula' => 'required|array',
            'cedula.*' => 'required|string',
            'pensum_id' => 'required|exists:pensum,id',
        ], [
            'aula.required' => 'El campo de aula debe ser texto.',
            'aula.max' => 'El aula ingresado excede el límite de carácteres.',
            'carrera.required' => 'El campo carrera es obligatorio.',
            'codigoasig.required' => 'El campo codigo es obligatorio.',
            'tramo.required' => 'El campo tramo es obligatorio.',
            'asignatura.required' => 'El campo asignatura es obligatorio.',
            'primernombre.required' => 'Debe haber al menos un primer nombre.',
            'primernombre.*.required' => 'Todos los nombres deben estar completos.',
            'primernombre.*.string' => 'Cada primer nombre debe ser un texto.',
            'primerapellido.required' => 'Debe haber al menos un primer apellido.',
            'primerapellido.*.required' => 'Todos los apellidos deben estar completos.',
            'cedula.required' => 'Debe haber al menos una cédula.',
            'cedula.*.required' => 'Todas las cédulas deben estar completas.',
            'cedula.*.string' => 'Cada cédula debe ser texto.',
            'pensum_id.required' => 'Es necesario el identificador del pensum',
            'pensum_id.exists' => 'El identificador del pensum no coincide con lo identificadores dentro del sistema',
        ]);

        $user = Auth::guard('teachers')->user();
        $no_encontrados = collect($request->cedula)->filter(function ($cedula) {
            return !Students::where('cedula', $cedula)->exists();
        });

        if ($no_encontrados->isNotEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Uno o más estudiantes no están registrados en el sistema.']);
        }

        $lapso = Periodos::all()->first();
        $notas = Notas::where('pensum_id', $request->pensum_id)->where('periodo_id', $lapso->id)->get();
        $notasPorEstudiante = [];
        foreach ($notas as $nota) {
            $notasPorEstudiante[$nota->student_id] = $nota;
        }
        $estudiantesIds = [];
        foreach ($request->cedula as $cedula) {
            $estudiante = Students::where('cedula', $cedula)->first();
            if ($estudiante) {
                $estudiantesIds[$cedula] = $estudiante->id;  // [cedula => student_id]
            }
        }
        $fecha = Carbon::now();
        $dia = $fecha->day;
        $mes = $fecha->month;
        $anio = $fecha->year;
        $carrera = $request->carrera;
        $codigo = $request->codigoasig;
        $materia = $request->asignatura;
        $unidad = Materias::where('materia', $materia)->value('unidadcurricular');
        $nombres = [];
        $apellidos = [];

        foreach ($request->primernombre as $i => $nombre) {
            $nombres[] = $nombre . ' ' . ($request->segundonombre[$i] ?? '');
        }

        foreach ($request->primerapellido as $i => $apellido) {
            $apellidos[] = $apellido . ' ' . ($request->segundoapellido[$i] ?? '');
        }
        $aula = $request->aula;
        $primerEstudiante = Students::where('cedula', $request->cedula[0])->first();
        $seccion = $primerEstudiante->secciones;
        $cedulas = $request->cedula;
        $pdf = Pdf::loadView('pdf.teachers.acta-calification', compact('aula', 'notasPorEstudiante', 'estudiantesIds', 'seccion', 'carrera', 'unidad', 'materia', 'codigo', 'cedulas', 'lapso', 'dia', 'mes', 'anio', 'nombres', 'apellidos', 'user'))->setPaper('A4');
        $pdf->setOptions(['isRemoteEnabled' => true]);
        $filename = 'Constancia_de_estudios_' . $carrera . '_' . $materia . '.pdf';
        return $pdf->download($filename);
    }

    // ==================================================================================
    // ============== DESCARGAR SOLICITUD EDICION DE NOTAS ERRONEAS  ====================
    // ==================================================================================
    public function solicitudedicion(Request $request)
    {
        $request->validate([
            'asignacion_id' => 'required|exists:profesor_asignar,id',
            'nota'=>'required|numeric|min:1|max:20',
            'materia'=>'required|string|exists:materias,materia',
            'campo_editar' => 'required|in:nota_uno,nota_dos,nota_tres,nota_cuatro,nota_extra',
        ],[
            'nota.required'=>'Debes de elegir la nota que deseas editar',
            'nota.numeric'=>'La nota debe de ser de tipo numérico',
            'nota.min'=>'La nota debe de ser mínimo de 1 punto',
            'nota.max'=>'La nota no debe de superar los 20 puntos',
            'materia.required'=>'Debes de tener la materia para poder solicitar la corrección',
            'materia.string'=>'Debes de tener la materia como texto',
            'materia.exists'=>'La matería que está tratando de colocar no existe en el sistema, por favor no modifique el formulario para evitar errores en su solicitud',
            'asignacion_id.required' => 'Debe usar el identificador de la asignación.',
            'asignacion_id.exists' => 'La asignación que está tratando de usar no existe.',
        ]);
        $notas = $request->nota;
        $materias = $request->materia;
        $estudiante_id = $request->estudiante_id;
        $asignacion = Asignar::with('pensums.materias')->findOrFail($request->asignacion_id);
        $pensumId = $asignacion->pensum_id;  // O usa pluck() si hay múltiples
        $periodo = Periodos::all()->first();
        $notasEnLetras = [
            1 => 'uno', 2 => 'dos', 3 => 'tres', 4 => 'cuatro', 5 => 'cinco',
            6 => 'seis', 7 => 'siete', 8 => 'ocho', 9 => 'nueve', 10 => 'diez',
            11 => 'once', 12 => 'doce', 13 => 'trece', 14 => 'catorce', 15 => 'quince',
            16 => 'dieciséis', 17 => 'diecisiete', 18 => 'dieciocho', 19 => 'diecinueve', 20 => 'veinte'
        ];
        $campoEditar = $request->campo_editar;
        $notaTexto = $notasEnLetras[$notas] ?? $notas;
        $nota = Notas::where('pensum_id', $pensumId)
            ->where('periodo_id', $periodo->id)
            ->where('student_id', $estudiante_id)  // Filtra por estudiante
            ->first();
        $nota->nota_editar = $campoEditar;
        $nota->editado = true;
        $nota->save();
        $estudiante = Students::findOrFail($request->estudiante_id);
        $user = Auth::guard('teachers')->user();
        $fecha = Carbon::now();
        $day = $fecha->day;
        $mes = $fecha->isoFormat('MMMM');
        $anio = $fecha->year;
        $pdf = Pdf::loadView('pdf.teachers.solicitud-de-correccion', compact('user', 'estudiante', 'periodo', 'notaTexto', 'notas', 'materias', 'day', 'mes', 'anio'));
        $filename = 'Solicitud_de_correccion_de_notas_' . $estudiante->primer_name .'_' . $estudiante->primer_apellido . '_' . $estudiante->cedula . '_' . $materias . '_' . $estudiante->carreras->carrera . '.pdf';
        return $pdf->download($filename);
    }
}
