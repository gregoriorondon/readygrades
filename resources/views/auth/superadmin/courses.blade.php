<x-dashboard>
    <x-slot:titulo>Carreras</x-slot:titulo>
    {{-- <a class="btn-new-student"  href="/nueva-carrera"><i class="fa-solid fa-plus-large"></i>Crear Nueva Carrera</a> --}}
    <x-button class="btn-new-student" type="button" id="abrirmodal"><i class="fa-solid fa-plus-large"></i>Crear Nueva Carrera</x-button>
<div class="mt-7">
<x-title-section-admin>Listado De Todas Las Carreras</x-title-section-admin>
    <div class="flex flex-col mt-2">
        <div class="overflow-x-auto">
            <div class="py-2 inline-block min-w-full">
                <div class="overflow-hidden border-gray-200 border border-solid rounded-lg">
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <x-table-th-students>
                                    Nombre de la Carrera
                                </x-table-th-students>
                                <x-table-th-students>
                                    Fecha de registro de la Carrera
                                </x-table-th-students>
                                <x-table-th-students>
                                    Editar Carrera
                                </x-table-th-students>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $carrera)
                            <tr class="odd:bg-gray-100/20 event:bg-transparent border-b">
                                <x-table-td-students>
                                    {{ $carrera->carrera }}
                                </x-table-td-students>
                                <x-table-td-students>
                                    {{ $carrera->created_at }}
                                </x-table-td-students>
                                <x-table-td-students>
                                    <a href="/edit-courses/{{ $carrera->id }}" class="hover:bg-gray-400/20 transition-all p-1 rounded-lg"><i class="fas fa-edit mr-3 text-xl"></i>Editar Carrera</a>
                                </x-table-td-students>
                            </tr>
                            @endforeach
                        </tbody>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===================================================== -->
<!-- ============ VENTANA MODAL PARA NUEVA CARRERA ======= -->
<!-- ===================================================== -->

<x-dialog-modal class="transition-all" form="carreraform">
    <x-slot:title>
        Registro de Nueva Carrera Universitaria
    </x-slot:title>
    <x-slot:content>
        <form action="/carreras-add-post" method="POST" id="carreraform" class="carreraform">
            @csrf
            <x-span>Inserte El Nombre De La Nueva Carrera</x-span>
            <br>
            <x-span class="bg-yellow-300 text-red-700 pl-1 pr-1 rounded-sm">No coloque números ni mayúsculas</x-span>
            <x-input class="bg-transparent mt-2" id="autocomplete" type="text" name="carrera" placeholder="Ingrese la nueva carrera universitaria" required autocomplete="off" />
            <div id="suggestions" class="pl-2 mt-2"></div>
        </form>
    </x-slot:content>
    <x-slot:botones>
        Crear Nueva Carrera
    </x-slot:botones>
</x-dialog-modal>
@vite(['resources/js/autocompletado-carrera.js'])
@vite(['resources/js/modales.js'])
<x-error-and-correct-dialog />
</x-dashboard>
