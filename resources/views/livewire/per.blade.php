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
    <x-title-section-admin class="select-none mt-7">Listado De Los Estudiantes Para PER</x-title-section-admin>
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
                                        Carrera/Materia
                                    </x-table-th-students>
                                    <x-table-th-students class="text-center">
                                        Calificación
                                    </x-table-th-students>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($estudiantes as $estudiante)
                                    @php
                                        $definitiva =
                                            $estudiante->nota_uno +
                                            $estudiante->nota_dos +
                                            $estudiante->nota_tres +
                                            $estudiante->nota_cuatro +
                                            $estudiante->nota_extra;
                                        $definitivaDivicion = round($definitiva / 4);
                                        $materiaPer = $estudiante->pensums->materias->per;
                                    @endphp
                                    @if (($materiaPer && $definitivaDivicion < 16) || (!$materiaPer && $definitivaDivicion <= 12))
                                        <tr class="odd:bg-gray-100/20 event:bg-transparent">
                                            <x-table-td-students>
                                                {{ $estudiante->studentcodigonucleo->student->cedula }}
                                            </x-table-td-students>
                                            <x-table-td-students>
                                                {{ $estudiante->studentcodigonucleo->student['primer_name'] }}
                                            </x-table-td-students>
                                            <x-table-td-students>
                                                {{ $estudiante->studentcodigonucleo->student['primer_apellido'] }}
                                            </x-table-td-students>
                                            <x-table-td-students>
                                                {{ $estudiante->pensums->carreras->carrera . ' ' . ucwords($estudiante->pensums->materias->materia) }}
                                            </x-table-td-students>
                                            <x-table-td-students class="text-center">
                                                @if ($estudiante->pensums->materias->per ==! false)
                                                    {{ $definitivaDivicion . ' pts' }}
                                                @else
                                                    {{ ucwords('Sin Remedial') }}
                                                @endif
                                            </x-table-td-students>
                                        </tr>
                                    @endif
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
