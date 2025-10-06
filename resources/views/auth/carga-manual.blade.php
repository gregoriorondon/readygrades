<x-dashboard>
    <x-slot:titulo>{{ ucwords('cargar notas manualmente') }}</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('formulario para cargar notas manualmente') }}</x-title-section-admin>
    @if ($periodo !== null)
        @if ((bool) $periodo->activo !== false)
            <x-form-manual :courses="$courses" :nucleos="$nucleos" :secciones="$secciones" :user="$user" :materias="$materias" />
        @else
            <div class="flex justify-center items-center h-[77vh]  text-center">
                <div class="max-w-[70%]">
                    <p class="select-none font-inter text-5xl text-gray-500/40">
                        {{ ucwords('Debe iniciar un nuevo periodo académico para poder registrar estudiantes') }}</p>
                </div>
            </div>
        @endif
    @else
        <div class="flex justify-center items-center h-[77vh]  text-center">
            <div class="max-w-[70%]">
                <p class="select-none font-inter text-5xl text-gray-500/40">
                    {{ ucwords('No existe algún periodo académico creado en el sistema para poder registrar estudiantes') }}
                </p>
            </div>
        </div>
    @endif
</x-dashboard>
