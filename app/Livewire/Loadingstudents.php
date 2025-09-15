<?php

namespace App\Livewire;

use App\Models\Carreras;
use App\Models\Students;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Loadingstudents extends Component
{
    use WithPagination;

    public $search = '';
    public $carrera = 0;

    protected $updatesQueryString = ['search', 'carrera'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function buscar()
    {
        $this->validate([
            'search'=>'required|min:4',
        ], [
            'search.required'=> ucwords('Por favor, ingresa un término de búsqueda'),
            'search.min'=>'Introduzca Minimo 4 Dígitos En La Busqueda'
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
        $esRoot = $user && $user->cargos()->whereHas('tipos', fn($q) =>
            $q->where('tipo', 'superadmin'))->exists();

        $query = Students::query();

        if (!$esRoot) {
            $query->where('nucleo_id', $nucleo->nucleo_id);
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
        }

        $estudiantes = $query->orderBy('created_at', 'desc')->paginate(20);
        $carreras = Carreras::all();

        return view('livewire.loadingstudents', compact('estudiantes', 'carreras'));
    }
}
