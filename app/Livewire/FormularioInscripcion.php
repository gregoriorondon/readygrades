<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Apertura;
use App\Models\NucleoCarrera;

class FormularioInscripcion extends Component
{
    public $nucleoSeleccionado = null;
    public $carreras = [];

    public function updatedNucleoSeleccionado($value)
    {
        if ($value) {
            // Ajusta aquí los nombres de tus columnas y relaciones
            $this->carreras = NucleoCarrera::where('nucleo_id', $value)
                ->with('carreras')
                ->get();
        } else {
            $this->carreras = [];
        }
    }

    public function render()
    {
        return view('livewire.formulario-inscripcion', [
            'nucleos' => Apertura::where('estado', 1)->get()
        ]);
    }
}
