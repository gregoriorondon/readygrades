<?php

namespace App\Livewire;

use App\Models\Notas;
use App\Models\Nucleos;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Per extends Component
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
        $this->resetPage('registroNotas');
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

        $busquedaModelo = Notas::query();

        if ($esRoot) {
            $busquedaModelo->with(['studentcodigonucleo.student' => function ($subBusqueda) {
                $subBusqueda->orderBy('created_at', 'desc');
            }, 'studentcodigonucleo.nucleo', 'studentcodigonucleo.student', 'pensums.materias']);
        } else {
            $busquedaModelo->with([
                'studentcodigonucleo.nucleo',
                'studentcodigonucleo.student',
                'pensums.materias'
            ]);
        }

        $nucleo = $user->nucleo_id;
        if (!$esRoot) {
            $busquedaModelo->whereHas('studentcodigonucleo.student', function ($q) use ($nucleo) {
                $q->where('nucleo_id', $nucleo);
            });
        }

        $busquedaModelo->whereHas('studentcodigonucleo.student');
        if (!empty($this->search)) {
            $busquedaModelo->where(function($q) use ($esRoot, $user) {
                $searchTerm = "%{$this->search}%";
                $q->whereHas('studentcodigonucleo.student', function($subQuery) use ($searchTerm, $esRoot, $user) {
                    $subQuery->where('cedula', 'LIKE', $searchTerm)
                      ->orWhere('primer_name', 'LIKE', $searchTerm)
                      ->orWhere('segundo_name', 'LIKE', $searchTerm)
                      ->orWhere('primer_apellido', 'LIKE', $searchTerm)
                      ->orWhere('segundo_apellido', 'LIKE', $searchTerm);
                    $subQuery->orWhereHas('codigonucleo', function($codigoQuery) use ($searchTerm, $esRoot, $user) {
                        $codigoQuery->where('codigo', 'LIKE', $searchTerm);
                        if (!$esRoot) {
                            $codigoQuery->where('nucleo_id', $user->nucleo_id);
                        }
                    });
                });
            });
        }
        return view('livewire.per', [
            'estudiantes' => $busquedaModelo->paginate(10, ['*'], 'registroNotas')
        ]);
    }
}
