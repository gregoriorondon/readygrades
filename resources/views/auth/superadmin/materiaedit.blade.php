<x-dashboard>
    <x-slot:titulo>Materias</x-slot:titulo>
    <x-title-section-admin>Editar La Materia {{ ucfirst($materias->materia) }}</x-title-section-admin>
    <x-error-and-correct-dialog />
    <div>
        <div class="w-full">
            <div class="border rounded-lg ">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="">
                            <tr class="border-b">
                                <th class="py-2 px-8">Materia</th>
                                <th class="py-2 px-8">Código</th>
                                <th class="py-2 px-8">Unidad Curricular</th>
                                <th class="py-2 px-8">Tiene PER</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <form action="/save-edit/{{ $materias->id }}" method="post" id="guardar">
                                @csrf
                                <tr class="odd:bg-gray-400/20 py-2">
                                    <td class="text-center py-2 px-8">
                                        <x-input-form class="min-w-40" type="text"
                                            value="{{ mb_strtoupper(trim($materias->materia)), 'UTF-8' }}"
                                            name="materia" autocomplete="off" placeholder="Nombre de la materia" />
                                    </td>
                                    <td class="text-center py-2">
                                        <x-input-form class="min-w-40" type="text"
                                            value="{{ mb_strtoupper(trim($materias->codigo)), 'UTF-8' }}" name="codigo"
                                            autocomplete="off" placeholder="Código de la materia" />
                                    </td>
                                    <td class="text-center py-2 px-8">
                                        <x-input-form type="numeric"
                                            value="{{ mb_strtoupper(trim($materias->unidadcurricular)), 'UTF-8' }}"
                                            name="unidadcurricular" autocomplete="off"
                                            placeholder="Código de la materia" />
                                    </td>
                                    <td class="text-center py-2 pr-8">
                                        <x-label class="min-w-40"><x-input-check type="checkbox" value="{{ $materias->per }}"
                                                name="per" />{{ ucwords('tiene PER') }}</x-label>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-between mt-5">
                <x-button type="button" class="bg-[#f00] hover:bg-[#b00] transition-all"
                    onclick="history.back()">Cancelar</x-button>
                <x-button type="submit" form="guardar">Guardar Cambios</x-button>
            </div>
        </div>
    </div>
</x-dashboard>
