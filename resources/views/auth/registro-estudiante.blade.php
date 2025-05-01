<x-dashboard>
    <x-slot:titulo>Registrar Nuevo Estudiante</x-slot:titulo>
    <x-title-section-admin>Registro de Nuevo Estudiante</x-title-section-admin>
    {{-- {{ dd($trayectos) }} --}}

    <x-form-student :courses="$courses" :trayectos="$trayectos" />
</x-dashboard>
