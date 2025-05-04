<x-dashboard>
    <x-slot:titulo>Registrar Nuevo Estudiante</x-slot:titulo>
    <x-title-section-admin>Registro de Nuevo Estudiante</x-title-section-admin>
    {{-- {{ dd($nucleos) }} --}}

    <x-form-student :courses="$courses" :trayectos="$trayectos" :nucleos="$nucleos" />
</x-dashboard>
