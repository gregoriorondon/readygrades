<x-dashboard>
    <x-slot:titulo>Profesores</x-slot:titulo>
    <x-button-a class="btn-new-student"  link="registro-profesor" icon="fa-solid fa-plus-large">Registrar Nuevo Profesor</x-button-a>
<div class="mt-7">
<x-title-section-admin>Listado De Todos Los Profesores Registrados</x-title-section-admin>
    <div class="">
        <div class="border-gray-200 border border-solid mt-2 rounded-lg">
            <div class="">
                <div class="flex flex-col overflow-x-auto">
                    <table class="">
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
                                    Núcleo
                                </x-table-th-students>
                                <x-table-th-students class="text-center">
                                    Detalles
                                </x-table-th-students>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($docentes as $profesor)
                            <tr class="odd:bg-gray-100/20 event:bg-transparent">
                                <x-table-td-students>
                                    {{ $profesor['cedula'] }}
                                </x-table-td-students>
                                <x-table-td-students>
                                    {{ $profesor['primer-name'] }}
                                </x-table-td-students>
                                <x-table-td-students>
                                    {{ $profesor['primer-apellido'] }}
                                </x-table-td-students>
                                <x-table-td-students>
                                    {{ $profesor->nucleos->nucleo }}
                                </x-table-td-students>
                                <x-table-td-students class="text-xl text-center">
                                    <a href="/docentes-panel-administrativo/{{ $profesor->id}}"><i class="fa-duotone fa-regular fa-circle-info m-0"></i></a>
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
    {{ $docentes->links() }}
</div>

</x-dashboard>
