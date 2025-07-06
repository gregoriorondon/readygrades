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
        ]);

        $user = Auth::guard('teachers')->user();
        $no_encontrados = collect($request->cedula)->filter(function ($cedula) {
            return !Students::where('cedula', $cedula)->exists();
        });

        if ($no_encontrados->isNotEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Uno o más estudiantes no están registrados en el sistema.']);
        }

        $lapso = Periodos::all()->first();
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
        $pdf = Pdf::loadView('pdf.teachers.acta-calification', compact('aula', 'seccion', 'carrera', 'unidad', 'materia', 'codigo', 'cedulas', 'lapso', 'dia', 'mes', 'anio', 'nombres', 'apellidos', 'user'))->setPaper('A4');
        $pdf->setOptions(['isRemoteEnabled' => true]);
        $filename = 'Constancia_de_estudios_' . $carrera . '_' . $materia . '.pdf';
        return $pdf->download($filename);
    }
}
