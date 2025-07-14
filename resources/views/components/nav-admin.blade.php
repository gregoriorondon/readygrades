@cannot('profesor')
    <x-sidebar-section link="administracion" icon="fa-solid fa-house">Dashboard</x-sidebar-section>
    <details class="register-add-sidebar-details">
        <summary class="selection:bg-transparent cursor-pointer px-4 py-2 mt-2 font-inter"><i class="fa-solid fa-address-book"></i>Registros</summary>
        <x-sidebar-section link="registro-estudiante" icon="fa-solid fa-square-plus">Registrar Estudiantes</x-sidebar-section>
        <x-sidebar-section link="registro-profesor" icon="fa-solid fa-user-plus">Registrar Profesor</x-sidebar-section>
        <x-sidebar-section link="registro-administrador" icon="fa-solid fa-address-card">Registrar Administrador</x-sidebar-section>
        @can('root')
            <x-sidebar-section link="agregar-cargo" icon="fa-solid fa-briefcase">Agregar Un Cargo</x-sidebar-section>
            <x-sidebar-section link="agregar-titulo" icon="fa fa-diploma">Agregar Un Título</x-sidebar-section>
        @endcan
    </details>
    @can('root')
        <details class="register-add-sidebar-details">
            <summary class="selection:bg-transparent cursor-pointer px-4 py-2 mt-2 font-inter"><i class="fa-solid fa-chart-pie"></i>Gestión Académica</summary>
                <x-sidebar-section link="materias" icon="fa-solid fa-folder">Materias</x-sidebar-section>
                <x-sidebar-section link="carreras" icon="fa-solid fa-graduation-cap">Carreras</x-sidebar-section>
                <x-sidebar-section link="tramos-y-trayectos" icon="fa-solid fa-list-timeline">Trayectos y Tramos</x-sidebar-section>
                <x-sidebar-section link="pensum" icon="fa-solid fa-scroll">Pensum</x-sidebar-section>
                <x-sidebar-section link="students-academic-tittle" icon="fas fa-file-certificate">Títulos Académicos</x-sidebar-section>
        </details>
    @endcan
    <x-sidebar-section link="estudiantes-panel-administrativo" icon="fa-duotone fa-solid fa-user-graduate">Estudiantes</x-sidebar-section>
    <x-sidebar-section link="nomina-profesores" icon="fa-duotone fa-regular fa-chalkboard-user">Profesores</x-sidebar-section>
    <x-sidebar-section link="nomina-administradores" icon="fa-solid fa-user-tie">Administradores</x-sidebar-section>
    @can('root')
        <x-sidebar-section link="nucleos" icon="fa-solid fa-signs-post">Núcleos</x-sidebar-section>
    @endcan
    <x-sidebar-section link="periodos" icon="fas fa-calendar-alt">Periodos Académicos</x-sidebar-section>
    <x-sidebar-section link="cargar-notas" icon="fas fa-file-edit">Cargar Notas</x-sidebar-section>
    <x-sidebar-section link="asignar" icon="fas fa-plus">Asignar Docente</x-sidebar-section>
    <x-sidebar-section link="generar-documentos" icon="fas fa-file-plus">Generar</x-sidebar-section>
@endcannot
@can('profesor')
    <x-sidebar-section link="dashboard" icon="fa-solid fa-house">Dashboard</x-sidebar-section>
    <x-sidebar-section link="asignaciones" icon="fa fa-tasks">Asignaciones</x-sidebar-section>
@endcan
