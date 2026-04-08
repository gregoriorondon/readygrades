<?php

namespace App\Http\Controllers;

use App\Models\Periodos;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
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
        $activo = Periodos::where('activo', true)->first();
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
}
