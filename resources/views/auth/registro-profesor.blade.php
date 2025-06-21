<x-dashboard>
    <x-slot:titulo>Registrar Nuevo Profesor</x-slot:titulo>
    <x-button-a class="btn-new-student" href="/agregar-cargo"><i class="fa-solid fa-plus-large"></i>Agregar Un Nuevo Cargo</x-button-a>
    <x-title-section-admin>Registro de Nuevo Profesor</x-title-section-admin>
    <x-form-teacher-register :cargo="$cargo" :estudio="$estudio" :nucleo="$nucleo" />
    <x-error-and-correct-dialog />
</x-dashboard>
