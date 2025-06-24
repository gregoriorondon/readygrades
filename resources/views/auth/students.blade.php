<x-dashboard>
<x-slot:titulo>Estidiantes</x-slot:titulo>
<x-button-a class="btn-new-student"  link="registro-estudiante" icon="fa-solid fa-plus-large">Registrar Nuevo Estudiante</x-button-a>
<div class="mt-7">
<x-title-section-admin>Listado De Todos Los Estudiantes</x-title-section-admin>
    <div class="flex flex-col mt-2">
        <div class="overflow-x-auto">
            <div class="py-2 inline-block min-w-full">
                <div class="overflow-hidden border-gray-200 border border-solid rounded-lg">
                    <table class="min-w-full">
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
                        <tbody>
                            @foreach($estudiantes as $estudiante)
                            <tr class="odd:bg-gray-100/20 event:bg-transparent border-b">
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
                                    <a href="/estudiantes-panel-administrativo/{{ $estudiante->id}}"><i class="fa-duotone fa-regular fa-circle-info m-0"></i></a>
                                </x-table-td-students>
                            </tr>
                            @endforeach
                        </div>
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
