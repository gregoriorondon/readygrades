<x-dashboard>
    <x-slot:titulo>Registrar Nuevo Estudiante</x-slot:titulo>
    <x-title-section-admin>Registro de Nuevo Estudiante</x-title-section-admin>
    @if($periodo !== null)
        @if((bool)$periodo->activo !== false)
            <x-form-student :courses="$courses" :trayectos="$trayectos" :nucleos="$nucleos" :secciones="$secciones" :user="$user" :nivelsocial="$nivelsocial" :titulo="$titulo" />
        @else
            <div class="flex justify-center items-center h-[77vh]  text-center">
                <div class="max-w-[70%]">
                    <p class="select-none font-inter text-5xl text-gray-500/40">{{ ucwords('Debe iniciar un nuevo periodo académico para poder registrar estudiantes') }}</p>
                </div>
            </div>
        @endif
        @else
            <div class="flex justify-center items-center h-[77vh]  text-center">
                <div class="max-w-[70%]">
                    <p class="select-none font-inter text-5xl text-gray-500/40">{{ ucwords('No existe algún periodo académico creado en el sistema para poder registrar estudiantes') }}</p>
                </div>
            </div>
        @endif
</x-dashboard>
