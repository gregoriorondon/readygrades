<?php

namespace App\Livewire;

use App\Models\Carreras;
use App\Models\Datospresistema;
use App\Models\Nucleos;
use App\Models\Students;
use App\Models\StudentsCodigoNucleo;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Loadingstudents extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'tailwind';

    public $search = '';
    public $carreras = [];
    public $nucleos = [];

    protected $busquedaModeloString = ['search'];

    public function mount() {
        $this->nucleos = Nucleos::all();
    }

    public function updatingSearch()
    {
        $this->resetPage('registroEstudiante');
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
        $usuario = Auth::user();
        $user = User::with('cargos.tipos')->find($usuario->id);

        $esRoot = $user && $user->cargos()->whereHas('tipos', fn ($q) =>
            $q->where('tipo', 'superadmin'))->exists();

        $busquedaModelo = Students::query();

        if ($esRoot) {
            $busquedaModelo->with(['codigonucleo' => function ($subBusqueda) {
                $subBusqueda->orderBy('created_at', 'desc')->take(1);
            }, 'codigonucleo.nucleo']);
        } else {
            $busquedaModelo->with('codigonucleo.nucleo');
        }

        $nucleo = $user->nucleo_id;
        if (!$esRoot) {
            $busquedaModelo->with('codigonucleo', function ($q) use ($nucleo) {
                $q->where('nucleo_id', $nucleo);
            });
            $busquedaModelo->whereHas('codigonucleo', function ($q) use ($nucleo) {
                $q->where('nucleo_id', $nucleo);
            });
        }

        if (!empty($this->search)) {
            $busquedaModelo->where(function($q) use ($esRoot, $user) {
                $searchTerm = "%{$this->search}%";
                $q->where('cedula', 'LIKE', $searchTerm)
                  ->orWhere('primer_name', 'LIKE', $searchTerm)
                  ->orWhere('segundo_name', 'LIKE', $searchTerm)
                  ->orWhere('primer_apellido', 'LIKE', $searchTerm)
                  ->orWhere('segundo_apellido', 'LIKE', $searchTerm);
                $q->orWhereHas('codigonucleo', function($subBusqueda) use ($searchTerm, $esRoot, $user) {
                    $subBusqueda->where('codigo', 'LIKE', $searchTerm);
                    if (!$esRoot) {
                        $subBusqueda->where('nucleo_id', $user->nucleo_id);
                    }
                });
            });
        }

        return view('livewire.loadingstudents', [
            'estudiantes' => $busquedaModelo->paginate(10, ['*'], 'registroEstudiante')
        ]);
    }
}
