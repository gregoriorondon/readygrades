<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\ConstanciaEstudios;
use App\Models\Notas;
use App\Models\Pensum;
use App\Models\Periodos;
use App\Models\StudentPublic;
use App\Models\Students;
use App\Models\TituloAcademico;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        $studentNucleo = StudentPublic::where('cedula', $request->cedula)
            ->first();
        $usuario = User::where('nucleo_id', $studentNucleo->nucleo_id)->first();
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
        return view('detalles-estudiante-publico', compact('estudiante', 'notasAgrupadas', 'tramosActuales', 'registrosAcademicos', 'usuario'));
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
        $existe = StudentPublic::where('cedula', $datosgenerar['cedula'])->first();
        if (!$existe) {
            return redirect()->back()->withErrors(['cedula' => 'No se encuentra registrado el estudiante con ése número de cédula']);
        }
        $studentNucleo = StudentPublic::where('cedula', $request->cedula)
            ->first();
        $usuario = User::with(['cargos' => function($q){
            $q->where('encargado', true);
        }])
            ->where('nucleo_id', $studentNucleo->nucleo_id)->first();

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
        $estudiante = StudentPublic::where('cedula', $request->cedula)
            ->where('carrera_id', $request->carrera_id)
            ->where('periodo_id', $activo->id)
            ->first();
        $estudiantes = StudentPublic::where('cedula', $datosgenerar)
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
                'diaPeriodoFin'
            ])
        )->setOption($opciones);
        $filename = 'Constancia_de_estudios_' . $estudiante['primer_name'] . '_' . $estudiante['primer_apellido'] . '_' . $estudiante['cedula'] . '.pdf';
        return $pdf->download($filename);
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
