<x-dashboard>
    <x-slot:titulo>Asignar Docente</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('asignar materias y carreras a un docente') }}</x-title-section-admin>

    <div class="container py-4 flex justify-center">
        <form method="GET" action="{{ route('asignar.buscar') }}" class="mb-4">
            <div class="input-group flex items-end">
                <x-label>{{ ucwords('ingrese la cédula del docente que desea buscar:') }}<x-input-form type="text"
                        name="cedula" class="form-control" autocomplete="off" placeholder="Cédula del Profesor"
                        value="{{ old('cedula') }}" /></x-label>
                <div>
                    <x-button class="btn btn-primary ml-2" type="submit">Buscar</x-button>
                </div>
            </div>
        </form>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
