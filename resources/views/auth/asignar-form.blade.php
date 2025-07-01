<x-dashboard>
    <x-slot:titulo>Asignar Docente</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('asignar materias y carreras a un docente') }}</x-title-section-admin>

    <div class="container py-4">
        <div class="flex justify-center">
            <form method="GET" action="{{ route('asignar.buscar') }}" class="mb-4">
                <x-label class="mb-2">{{ ucwords('ingresar cédula') }}</x-label>
                <div class="input-group flex items-center">
                    <x-input-form type="text" name="cedula" class="form-control !mt-0"
                        placeholder="Cédula del Profesor" value="{{ request('cedula') }}" />
                    <div>
                        <x-button class="btn btn-primary ml-2" icon="fa-solid fa-magnifying-glass"
                            type="submit">Buscar</x-button>
                    </div>
                </div>
            </form>
        </div>

        @if (isset($profesor))
            <div class="card mb-4">
                <div class="flex justify-center">
                    <div class="card-header bg-primary text-white">
                        <p class="text-lg font-inter">Profesor: {{ $profesor->{'primer-name'} }}
                            {{ $profesor->{'primer-apellido'} }}</p>
                        <p class="text-lg font-inter">Núcleo: {{ $profesor->nucleos->nucleo }}</p>
                        <p class="text-lg font-inter">Correo: {{ $profesor->email }}</p>
                        <div class="flex justify-center">
                            <x-button class="btn btn-light btn-sm mt-4" icon="fas fa-plus" data-bs-toggle="modal"
                                id="abrirmodal" data-bs-target="#asignarModal">
                                Asignar Nuevas Materias
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <x-dialog-modal class="transition-all" form="carreraform">
        <x-slot:title>
            {{ ucwords('asignar materias al docente') }}
        </x-slot:title>
        <x-slot:content>
            <form id="asignarForm" method="POST" action="{{ route('asignar.store') }}">
                @csrf
                <input type="hidden" name="profesor_id" value="{{ $profesor->id }}">

                <div class="flex">
                    <div class="row mb-3">
                        <x-label class="form-label">Carrera</x-label>
                        <x-select-form name="carrera_id" id="carreraSelect" class="form-select" required>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
                            @endforeach
                        </x-select-form>
                    </div>
                    <div class="ml-2">
                        <x-label class="form-label">Tramo</x-label>
                        <x-select-form name="tramo_id" id="tramoSelect" class="form-select" required>
                            @foreach ($trayectos as $trayecto)
                                <optgroup label="{{ $trayecto->trayectos }}">
                                    @foreach ($trayecto->tramos as $tramos)
                                        <option value="{{ $tramos->pivot->id }}">{{ $tramos->tramos }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </x-select-form>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <x-label class="form-label">Sección</x-label>
                        <x-select-form name="seccion_id" id="seccionSelect" class="form-select" required>
                            @foreach ($secciones as $seccion)
                                <option value="{{ $seccion->id }}">{{ $seccion->seccion }}</option>
                            @endforeach
                        </x-select-form>
                    </div>
                </div>
            </form>
        </x-slot:content>
        <x-slot:botones>
            {{ ucwords('asignar') }}
        </x-slot:botones>
    </x-dialog-modal>
    @vite(['resources/js/modales.js'])
    <x-error-and-correct-dialog />
</x-dashboard>
