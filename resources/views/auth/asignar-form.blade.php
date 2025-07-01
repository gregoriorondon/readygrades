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
                    <div class="card-header bg-primary">
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

                <div>
                    @if ($asignaciones->isEmpty())
                        <div class="alert alert-info text-gray-400/40 select-none text-center mt-4 text-3xl">
                            {{ ucwords('No tiene asignaciones registradas') }}
                        </div>
                    @else
                        <div class="flex justify-center mt-9">
                            <div class="border rounded-lg">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-9 py-3">Carrera</th>
                                        <th class="px-9 py-3">Tramo</th>
                                        <th class="px-9 py-3">Materia</th>
                                        <th class="px-9 py-3">Sección</th>
                                        <th class="px-9 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignaciones as $asig)
                                        <tr class="odd:bg-gray-400/20">
                                            <td class="px-9 py-3 text-center">{{ $asig->pensums->carreras->carrera ?? 'N/A' }}</td>
                                            <td class="px-9 py-3 text-center">{{ $asig->pensums->tramoTrayecto->tramos->tramos ?? 'N/A' }}</td>
                                            <td class="px-9 py-3 text-center">{{ mb_strtoupper(trim($asig->pensums->materias->materia), 'UTF-8') ?? 'N/A' }}</td>
                                            <td class="px-9 py-3 text-center">{{ $asig->secciones->seccion ?? 'N/A' }}</td>
                                            <td class="px-9 py-3 text-center">
                                                <form method="POST"
                                                    action="{{ route('asignar.desasignar', $asig->id) }}">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class=" hover:bg-[#b00] hover:text-white px-2 py-1 rounded-lg">
                                                        <i class="fas fa-trash"></i> Desasignar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    <x-dialog-modal class="transition-all" form="asignarForm">
        <x-slot:title>
            {{ ucwords('asignar trayecto y carrera al docente') }}
        </x-slot:title>
        <x-slot:content>
            <form id="asignarForm" method="get" action="{{ route('asignar.store') }}">
                @csrf
                <input type="hidden" name="profesor_id" value="{{ $profesor->id }}">
                <div class="">
                    <div class="row mb-3">
                        <x-label class="form-label">Carrera</x-label>
                        <x-select-form name="carrera_id" id="carreraSelect" class="form-select" required>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
                            @endforeach
                        </x-select-form>
                    </div>
                    <div class="row mb-12">
                        <x-label class="form-label">Tramo</x-label>
                        <x-select-form name="tramo_trayecto_id" id="tramoSelect" class="form-select" required>
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
            </form>
        </x-slot:content>
        <x-slot:botones>
            {{ ucwords('asignar') }}
        </x-slot:botones>
    </x-dialog-modal>
    @vite(['resources/js/modales.js'])
    <x-error-and-correct-dialog />
</x-dashboard>
