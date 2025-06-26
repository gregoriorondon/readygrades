<x-dashboard>
    <x-slot:titulo>Registrar Nuevo Estudiante</x-slot:titulo>
    <x-title-section-admin>Registro de Nuevo Estudiante</x-title-section-admin>
    <x-button type="button" id="abrirmodal" icon="fa-solid fa-plus-large">Agregar Una Nueva Sección</x-button>

    <x-form-student :courses="$courses" :trayectos="$trayectos" :nucleos="$nucleos" :secciones="$secciones" />

<!-- ===================================================== -->
<!-- ============ VENTANA MODAL PARA NUEVA SECCION ======= -->
<!-- ===================================================== -->

<x-dialog-modal class="transition-all" form="carreraform">
    <x-slot:title>
        Registro De La Nueva Sección
    </x-slot:title>
    <x-slot:content>
        <form action="/seccionadd" method="POST">
            @csrf
            <x-span>Inserte La Letra De La Nueva Sección</x-span>
            <br>
            <x-span class="bg-yellow-300 text-red-700 pl-1 pr-1 rounded-sm">No coloque números ni mayúsculas</x-span>
            <x-input class="bg-transparent mt-2" id="autocomplete" type="text" name="seccion" placeholder="Ingrese la nueva seccion" required autocomplete="off" />
        </form>
    </x-slot:content>
    <x-slot:botones>
        Crear Nueva Sección
    </x-slot:botones>
</x-dialog-modal>
@vite(['resources/js/modales.js'])
</x-dashboard>
