<x-dashboard>
<x-slot:titulo>Estidiantes</x-slot:titulo>
<x-button-a class="btn-new-student"  link="registro-estudiante" icon="fa-solid fa-plus-large">Registrar Nuevo Estudiante</x-button-a>
<div class="mt-7">

<form class="flex items-center max-w-lg mx-auto mb-7" method="post" action="/estudiantes-panel-administrativo/search">
    @csrf
    <div class="relative w-full">
        <div class="absolute inset-y-0 flex items-center mb-1 ps-[3px] start-0">
            <x-select-form name="carreras" class="w-28">
                <option value="all">Cualquiera</option>
                @foreach($carreras as $courses)
                    <option value="">{{ $courses->carrera }}</option>
                @endforeach
            </x-select-form>
        </div>
        <x-input type="text" name="search" class="block w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50/10 ps-32" placeholder="{{ ucwords('escribe para buscar') }}" required />
    </div>
    <x-button type="submit" class="inline-flex items-center mt-1 text-sm font-medium py-3.5 ms-2" icon="fa-solid fa-magnifying-glass">
        Buscar
    </x-button>
</form>

<x-title-section-admin class="select-none">Listado De Todos Los Estudiantes</x-title-section-admin>
    <div class="">
        <div class="mt-2 border border-gray-200 border-solid rounded-lg">
            <div class="">
                <div class="flex flex-col overflow-x-auto">
                    <table class="select-none">
                        <thead class="border-b">
                            <tr>
                                <x-table-th-students>
                                    Cedula
                                </x-table-th-students>
                                <x-table-th-students>
                                    Primer Nombre
                                </x-table-th-students>
                                <x-table-th-students>
                                    Primer Apellido
                                </x-table-th-students>
                                <x-table-th-students>
                                    Carrera
                                </x-table-th-students>
                                <x-table-th-students>
                                    Tramo
                                </x-table-th-students>
                                <x-table-th-students class="text-center">
                                    Detalles
                                </x-table-th-students>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($estudiantes as $estudiante)
                            <tr class="odd:bg-gray-100/20 event:bg-transparent">
                                <x-table-td-students>
                                    {{ $estudiante['cedula'] }}
                                </x-table-td-students>
                                <x-table-td-students>
                                    {{ $estudiante['primer_name'] }}
                                </x-table-td-students>
                                <x-table-td-students>
                                    {{ $estudiante['primer_apellido'] }}
                                </x-table-td-students>
                                <x-table-td-students>
                                    {{ $estudiante->carreras->carrera }}
                                </x-table-td-students>
                                <x-table-td-students>
                                    {{ $estudiante->tramos->tramos }}
                                </x-table-td-students>
                                <x-table-td-students class="text-xl text-center">
                                    <a href="/estudiantes-panel-administrativo/{{ $estudiante->id}}"><i class="m-0 fa-duotone fa-regular fa-circle-info"></i></a>
                                </x-table-td-students>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    {{ $estudiantes->links() }}
</div>
</x-dashboard>
