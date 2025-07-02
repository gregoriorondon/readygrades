<?php

namespace App\Http\Controllers;

use App\Models\Asignar;
use App\Models\Carreras;
use App\Models\Notas;
use App\Models\Nucleos;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    //
    public function board(){
        $user = Auth::guard('teachers')->user();
        // $user = Auth::user();
        $carreras = Carreras::count();
        $estudiantes = Students::count();
        $nucleos = Nucleos::count();

        return view('auth.dashSection', compact('user', 'carreras', 'estudiantes', 'nucleos'));
    }
    public function asignaciones() {
        $user = Auth::guard('teachers')->user();
        $userId = $user->id;
        $profesorAsignacion = Asignar::with(['pensums.tramoTrayecto.tramos', 'pensums.carreras', 'secciones'])->where('profesor_id', $userId)->get();
        foreach ($profesorAsignacion as $asignacion) {
            if ($asignacion->pensums()) {
                $asignacion->students = Students::where('carrera_id', $asignacion->pensums->carrera_id)->where('tramo_trayecto_id', $asignacion->pensums->tramo_trayecto_id)->where('seccion_id', $asignacion->seccion_id)->get();
            } else {
                $asignacion->students = collect();
            }
        }
        return view('auth.docente.asignado', compact('profesorAsignacion'));
    }
}
