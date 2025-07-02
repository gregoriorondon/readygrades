<?php

namespace App\Http\Controllers;

use App\Models\Asignar;
use App\Models\Carreras;
use App\Models\Notas;
use App\Models\Nucleos;
use App\Models\Students;
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
}
