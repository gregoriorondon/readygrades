<x-dashboard>
    <x-slot:titulo>Secciones</x-slot:titulo>

<x-button class="mb-7" type="button" id="abrirmodal" icon="fa-solid fa-plus-large">Agregar Una Nueva Sección</x-button>
<x-title-section-admin>Secciones Actuales</x-title-section-admin>
<div class="flex flex-col mt-2">
    <div class="overflow-x-auto">
        <div class="py-2 inline-block min-w-full">
            <div class="overflow-hidden border-gray-200 border border-solid rounded-lg">
                <table class="min-w-full">
                    <thead class="border-b">
                        <tr class="text-center">
                            <x-table-th-students class="text-center">
                                Sección
                            </x-table-th-students>
                            <x-table-th-students class="text-center">
                                Capacidad
                            </x-table-th-students>
                            <x-table-th-students class="text-center">
                                Inscripciones
                            </x-table-th-students>
                            <x-table-th-students class="text-center">
                                Acciones
                            </x-table-th-students>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($secciones as $seccion)
                        <tr class="odd:bg-gray-100/20 event:bg-transparent border-b text-center">
                            <x-table-td-students>
                                {{ $seccion->seccion }}
                            </x-table-td-students>
                            <x-table-td-students>
                                {{ $seccion->capacidad }}
                            </x-table-td-students>
                            <x-table-td-students>
                                {{ $seccion->inscripcion_count }}
                            </x-table-td-students>
                            <x-table-td-students>
                                <a href=""><i class="fas fa-eye mr-7 text-xl"></i></a>
                                <a href="" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit text-xl m-0"></i>
                                </a>
                            </x-table-td-students>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay secciones registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    {{ $secciones->links() }}
</div>

<x-error-and-correct-dialog />

<!-- ===================================================== -->
<!-- ============ VENTANA MODAL PARA NUEVA SECCION ======= -->
<!-- ===================================================== -->

<x-dialog-modal class="transition-all" form="seccionform">
    <x-slot:title>
        Registro De La Nueva Sección
    </x-slot:title>
    <x-slot:content>
        <form action="/seccionadd" method="POST" id="seccionform">
            @csrf
            <x-span>Inserte La Letra De La Nueva Sección</x-span>
            <br>
            <x-span class="bg-yellow-300 text-red-700 pl-1 pr-1 rounded-sm">No coloque números ni mayúsculas</x-span>
            <x-label class="mt-4" for="seccion">Nombre de Sección:</x-label>
            <x-input class="bg-transparent mt-2" id="autocomplete" type="text" name="seccion" placeholder="Ingrese la nueva sección" required autocomplete="off" />

            <x-label class="mt-4" for="capacidad">Capacidad Máxima:</x-label>
            <x-input class="bg-transparent mt-2" type="number" min="1" name="capacidad" placeholder="Ingrese sólo números" value="30" required autocomplete="off" />
        </form>
    </x-slot:content>
    <x-slot:botones>
        Crear
    </x-slot:botones>
</x-dialog-modal>
@vite(['resources/js/modales.js'])
</x-dashboard>
