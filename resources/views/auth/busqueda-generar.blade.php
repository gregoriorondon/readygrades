<x-dashboard>
    <x-slot:titulo>Constancia Del Estudiante</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('generar constancia de estudios a ') . $cedula->primer_name . ' ' . $cedula->primer_apellido }}</x-title-section-admin>
    <div class="flex justify-center mt-9">
        <div class="max-w-[550px] w-full">
            <form method="post" action="{{ route('generarpdf') }}">
                @csrf
                <p>Nombre Completo: <x-span>{{ $cedula->primer_name . ' ' . $cedula->segundo_name }}</x-span> </p>
                <p>Apellido Completo: <x-span>{{ $cedula->primer_apellido . ' ' . $cedula->segundo_apellido }}</x-span>
                </p>
                <p>Cédula: <x-span>{{ $cedula->cedula }}</x-span> </p>
                <x-label class="mt-4">{{ ucwords('seleccione la carrera del estudiante:') }}</x-label>
                <x-select-form name="carrera_id">
                    <option>Seleccione La Carrera Del Estudiante</option>
                    @foreach ($estudiantes as $estudiante)
                        <option value="{{ $estudiante->carreras->id }}">{{ $estudiante->carreras->carrera }}</option>
                    @endforeach
                </x-select-form>
                <input type="hidden" name="cedula" value="{{ $cedula->cedula }}">
                <div class="mt-4 flex justify-between">
                    <x-button type="button" onclick="history.back()" class="bg-[#f00] hover:bg-[#b00]">Cancelar</x-button>
                    <x-button type="submit" icon="fa-solid fa-download">Generar Constancia</x-button>
                </div>
            </form>
        </div>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
