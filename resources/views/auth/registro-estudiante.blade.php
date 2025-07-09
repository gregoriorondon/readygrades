<x-dashboard>
    <x-slot:titulo>Registrar Nuevo Estudiante</x-slot:titulo>
    <x-button type="button" id="abrirmodal" icon="fa-solid fa-plus-large">Agregar Una Nueva Sección</x-button>
    <x-title-section-admin>Registro de Nuevo Estudiante</x-title-section-admin>
    @if($periodo !== null)
        @if((bool)$periodo->activo !== false)
            <x-form-student :courses="$courses" :trayectos="$trayectos" :nucleos="$nucleos" :secciones="$secciones" />
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
