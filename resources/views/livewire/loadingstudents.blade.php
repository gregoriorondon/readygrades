<div class="mt-7">
    <div class="flex items-center max-w-lg mx-auto">
        <div class="relative w-full">
            <x-input
                type="text"
                name="search"
                class="block w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50/10 pr-[35px]"
                placeholder="{{ ucwords('escribe para buscar') }}"
                autocomplete="off"
                autofocus
                wire:model.live.debounce.250ms="search"
            />
            <div class="absolute inset-y-0 flex items-center pe-[3px] end-0">
                <span class="inline-flex items-center mt-1 text-lg font-medium py-3.5 ms-2">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
    </div>
    <x-title-section-admin class="select-none mt-7">Listado De Todos Los Estudiantes</x-title-section-admin>
    <center>
        <div class="min-w-max" wire:loading>
            <center class="mt-7">
                <p>Buscando registros...</p>
                <div class="loader min-w-[200px]"></div>
            </center>
        </div>
    </center>
    <div class="" wire:loading.remove>
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
                                        Código
                                    </x-table-th-students>
                                    <x-table-th-students class="text-center">
                                        Detalles
                                    </x-table-th-students>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($estudiantes as $estudiante)
                                    <tr class="odd:bg-gray-100/20 event:bg-transparent">
                                        <x-table-td-students>
                                            {{ $estudiante->cedula }}
                                        </x-table-td-students>
                                        <x-table-td-students>
                                            {{ $estudiante['primer_name'] }}
                                        </x-table-td-students>
                                        <x-table-td-students>
                                            {{ $estudiante['primer_apellido'] }}
                                        </x-table-td-students>
                                        <x-table-td-students>
                                            @foreach ($estudiante->codigonucleo as $codigo)
                                                {{ $codigo->codigo }}
                                            @endforeach
                                        </x-table-td-students>
                                        <x-table-td-students class="text-xl text-center">
                                            <a href="/estudiantes-panel-administrativo/{{ $estudiante->id }}"><i
                                                    class="m-0 fa-duotone fa-regular fa-circle-info"></i></a>
                                        </x-table-td-students>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="flex flex-col items-center justify-center p-10">
                                                <i class="fas fa-search text-7xl text-gray-500"></i>
                                                <p class="mt-4 text-lg font-semibold text-gray-500">
                                                    No se encontraron estudiantes para "{{ $search }}"
                                                </p>
                                                <p class="text-sm text-gray-400">Intenta con otros términos de búsqueda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $estudiantes->links() }}
            <div>
            </div>
    </div>
</div>
<x-error-and-correct-dialog />
