<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Notas;
use App\Models\Pensum;
use App\Models\StudentPublic;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityController extends Controller
{
    public function index()
    {
        return view('home-original');
    }

    public function autoridades() {
        return view('autoridades');
    }

    public function organigrama()
    {
        return view('organigrama');
    }

    public function students()
    {
        return view('estudiantes');
    }

    public function studentspublicdetails(Request $request)
    {
        $request->validate([
            'cedula' => 'required|numeric|exists:students,cedula',
        ], [
            'cedula.exists' => 'La cédula ingresada no se encuentra registrada.',
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.numeric' => 'El campo cédula debe contener solo números.',
        ]);
        $estudiante = StudentPublic::with(['tramos.trayectos', 'carreras', 'secciones'])
            ->where('cedula', $request->cedula)
            ->orderBy('created_at', 'desc')
            ->first();
        if (!$estudiante) {
            return redirect()->back()->withErros(['cedula' => 'No se encuentra registrado en nuestra institución como un estudiante.']);
        }
        $registrosAcademicos = StudentPublic::with('carreras')
            ->where('cedula', $request->cedula)
            ->get();

        $idsEstudiante = $registrosAcademicos->pluck('id');

        $notas = Notas::with([
            'pensums.materias',
            'pensums.carreras',
            'pensums.tramoTrayecto.tramos',
            'pensums.tramoTrayecto.trayectos'
        ])
            ->whereIn('student_id', $idsEstudiante)
            ->get();

        $notasAgrupadas = [];

        foreach ($registrosAcademicos as $registro) {
            $carreraId = $registro->carrera_id;

            if (!isset($notasAgrupadas[$carreraId])) {
                $notasAgrupadas[$carreraId] = [
                    'carrera' => $registro->carreras,
                    'tramos' => []
                ];
            }
        }

        foreach ($notas as $nota) {
            if (!$nota->pensums || !$nota->pensums->carreras) {
                continue;
            }

            $carreraId = $nota->pensums->carreras->id;
            $tramoId = $nota->pensums->tramoTrayecto->id;
            $materiaId = $nota->pensums->materias->id;

            if (!isset($notasAgrupadas[$carreraId])) {
                $notasAgrupadas[$carreraId] = [
                    'carrera' => $nota->pensums->carreras,
                    'tramos' => []
                ];
            }

            if (!isset($notasAgrupadas[$carreraId]['tramos'][$tramoId])) {
                $notasAgrupadas[$carreraId]['tramos'][$tramoId] = [
                    'tramo' => $nota->pensums->tramoTrayecto,
                    'materias' => []
                ];
            }

            $notasAgrupadas[$carreraId]['tramos'][$tramoId]['materias'][$materiaId] = [
                'materia' => $nota->pensums->materias,
                'nota' => $nota
            ];
        }

        $tramosActuales = [];
        foreach ($registrosAcademicos as $registro) {
            $carreraId = $registro->carrera_id;

            if (!isset($tramosActuales[$carreraId]) ||
                    $registro->created_at > $tramosActuales[$carreraId]['fecha']) {
                $tramosActuales[$carreraId] = [
                    'tramo' => $registro->tramos,
                    'fecha' => $registro->created_at
                ];
            }
        }
        return view('detalles-estudiante-publico', compact('estudiante', 'notasAgrupadas', 'tramosActuales'));
    }

    public function admin()
    {
        return view('auth.login');
    }

    public function courses()
    {
        $carrera = Carreras::all();
        return view('auth.courses', ['courses' => $carrera]);
    }

    public function studentsadmin()
    {
        $students = Students::paginate(20);
        return view('auth.students', ['estudiantes' => $students]);
    }

    public function studentsadmindetails(Students $student)
    {
        return view('auth.students-details', ['estudiantes' => $student]);
    }

    public function adminadd()
    {
        return view('auth.registro-admin');
    }

    public function profesornomina()
    {
        return view('auth.profesores-nomina');
    }
}
