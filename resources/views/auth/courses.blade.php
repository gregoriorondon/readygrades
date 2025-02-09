<x-dashboard>
    <x-slot:titulo>Carreras</x-slot:titulo>
    <a class="btn-new-student"  href="/registro-profesor"><i class="fa-solid fa-plus-large"></i>Crear Nueva Carrera</a>
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
                                    Nombre de la Carrera
                                </x-table-th-students>
                                <x-table-th-students>
                                    Fecha de registro de la Carrera
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
    
</x-dashboard>
