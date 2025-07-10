<x-dashboard>
    <x-slot:titulo>Registrar Nuevo Profesor</x-slot:titulo>
    @can('root')
        <x-button-a class="btn-new-student" link="agregar-cargo" icon="fa-solid fa-plus-large">Agregar Un Nuevo Cargo</x-button-a>
    @endcan
    <x-title-section-admin>Registro de Nuevo Profesor</x-title-section-admin>
    <x-form-teacher-register :cargo="$cargo" :estudio="$estudio" :nucleo="$nucleo" />
    <x-error-and-correct-dialog />
</x-dashboard>
