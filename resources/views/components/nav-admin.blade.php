<x-sidebar-section href="/administracion" :active="request()->is('administracion')"><i class="fa-solid fa-house"></i>Dashboard</x-sidebar-section>
<details class="register-add-sidebar-details">
    <summary class="selection:bg-transparent cursor-pointer px-4 py-2 mt-2 font-inter"><i class="fa-solid fa-address-book"></i>Registros</summary>
    <x-sidebar-section href="/registro-estudiante" :active="request()->is('registro-estudiante')"><i class="fa-solid fa-square-plus"></i>Registrar Estudiantes</x-sidebar-section>
    <x-sidebar-section href="/registro-profesor" :active="request()->is('registro-profesor')"><i class="fa-solid fa-user-plus"></i>Registrar Profesor</x-sidebar-section>
    <x-sidebar-section href="/registro-administrador" :active="request()->is('registro-administrador')"><i class="fa-solid fa-address-card"></i>Registrar Administrador</x-sidebar-section>
    @can('root')
        <x-sidebar-section href="/agregar-cargo" :active="request()->is('agregar-cargo')"><i class="fa-solid fa-briefcase"></i>Agregar Un Cargo</x-sidebar-section>
    @endcan
</details>
<x-sidebar-section href="/estudiantes-panel-administrativo" :active="request()->is('estudiantes-panel-administrativo')"><i class="fa-duotone fa-solid fa-user-graduate"></i>Estudiantes</x-sidebar-section>
<x-sidebar-section href="/nomina-profesores" :active="request()->is('nomina-profesores')"><i class="fa-duotone fa-regular fa-chalkboard-user"></i>Profesores</x-sidebar-section>
<x-sidebar-section href="/nomina-administradores" :active="request()->is('nomina-administradores')"><i class="fa-solid fa-user-tie"></i>Administradores</x-sidebar-section>
@can('root')
    <x-sidebar-section href="/carreras" :active="request()->is('carreras')"><i class="fa-solid fa-graduation-cap"></i>Carreras</x-sidebar-section>
    <x-sidebar-section href="/nucleos" :active="request()->is('nucleos')"><i class="fa-solid fa-signs-post"></i>Núcleos</x-sidebar-section>
    <x-sidebar-section href="/tramos-y-trayectos" :active="request()->is('tramos-y-trayectos')"><i class="fa-solid fa-list-timeline"></i>Trayectos y Tramos</x-sidebar-section>
@endcan
<x-sidebar-section href="/generar-documentos" :active="request()->is('generar-documentos')"><i class="fas fa-file-plus"></i>Generar</x-sidebar-section>
