<x-dashboard>
    <x-slot:titulo>Registrar Nuevo Administrador</x-slot:titulo>
    <x-button-a class="btn-new-student"  href="/agregar-cargo"><i class="fa-solid fa-plus-large"></i>Agregar Un Nuevo Cargo</x-button-a>
    <x-title-section-admin>Registro de Nuevo Administrador</x-title-section-admin>
    <x-form-admin-register :cargo="$cargo" :estudio="$estudio" :nucleo="$nucleo"  />
</x-dashboard>
