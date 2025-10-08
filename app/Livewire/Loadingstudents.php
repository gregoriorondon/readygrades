<?php

namespace App\Livewire;

use App\Models\Carreras;
use App\Models\Datospresistema;
use App\Models\Nucleos;
use App\Models\Students;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Loadingstudents extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'tailwind';

    public $search = '';
    public $carrera = 0;
    public $nucleo = 0;

    protected $updatesQueryString = ['search', 'carrera'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function buscar()
    {
        $this->validate([
            'search' => 'required|min:3',
        ], [
            'search.required' => ucwords('Por favor, ingresa un término de búsqueda'),
            'search.min' => 'Introduzca Minimo 3 Dígitos En La Busqueda'
        ]);
        $this->resetPage();  // reinicia paginación
    }

    public function updatingCarrera()
    {
        $this->resetPage();
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div>
                <center class="loadcenter">
                    <p>Cargando, Por Favor Espere...</p>
                    <div class="loader"></div>
                </center>
            </div>
            HTML;
    }

    public function render()
    {
        // sleep(1);
        $usuario = Auth::user();
        $user = User::with('cargos.tipos')->find($usuario->id);
        $nucleo = $user;
        $esRoot = $user && $user->cargos()->whereHas('tipos', fn ($q) =>
        $q->where('tipo', 'superadmin'))->exists();

        $query = Students::query();
        $queryPre = Datospresistema::query();

        if (!$esRoot) {
            $query->where('nucleo_id', $nucleo->nucleo_id);
            $queryPre->where('nucleo_id', $nucleo->nucleo_id);
        } else {
            if ($this->nucleo != 0) {
                $query->where('nucleo_id', $this->nucleo);
                $queryPre->where('nucleo_id', $this->nucleo);
            };
        }

        if (strlen($this->search) >= 4) {
            $query->where(function ($q) {
                $q
                    ->where('cedula', 'LIKE', "%{$this->search}%")
                    ->orWhere('codigo', 'LIKE', "%{$this->search}%")
                    ->orWhere('primer_name', 'LIKE', "%{$this->search}%")
                    ->orWhere('primer_apellido', 'LIKE', "%{$this->search}%")
                    ->orWhere('telefono', 'LIKE', "%{$this->search}%")
                    ->orWhere('direccion', 'LIKE', "%{$this->search}%")
                    ->orWhere('city', 'LIKE', "%{$this->search}%");
            });
        }

        if ($this->carrera != 0) {
            $query->where('carrera_id', $this->carrera);
            $queryPre->where('carrera_id', $this->carrera);
        }

        $estudiantesSistema = $query->select(
            'id',
            'cedula',
            'codigo',
            'primer_name',
            'primer_apellido',
            'carrera_id',
            'tramo_trayecto_id',
            'nucleo_id'
        )->get();

        $preSistema = $queryPre->select(
            'id',
            'cedula',
            'codigo',
            'primer_name',
            'primer_apellido',
            'carrera_id',
            'nucleo_id',
            DB::raw('NULL as tramo_trayecto_id')
        )->when(strlen($this->search) >= 4, function ($q) {
            $q->where(function ($q) {
                $q->where('cedula', 'LIKE', "%{$this->search}%")
                    ->orWhere('codigo', 'LIKE', "%{$this->search}%")
                    ->orWhere('primer_name', 'LIKE', "%{$this->search}%")
                    ->orWhere('primer_apellido', 'LIKE', "%{$this->search}%");
            });
        })->get();


        $estudiantes = $estudiantesSistema->concat($preSistema)->sortByDesc('id');

        $perPage = 3;
        $page = Paginator::resolveCurrentPage('page');
        $items = $estudiantes->forPage($page, $perPage);

        $estudiantes = new LengthAwarePaginator(
            $items,
            $estudiantes->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()]
        );


        // $estudiantes = $estudiantesSistema->concat($preSistema)->sortByDesc('id')->paginate(3)->onEachSide(0);
        $carreras = Carreras::all();
        $nucleos = Nucleos::all();

        return view('livewire.loadingstudents', compact('estudiantes', 'carreras', 'nucleos'));
    }
}
