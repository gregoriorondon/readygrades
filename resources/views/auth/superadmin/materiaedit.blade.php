<x-dashboard>
    <x-slot:titulo>Materias</x-slot:titulo>
    <x-title-section-admin>Editar La Materia {{ ucfirst($materias->materia) }}</x-title-section-admin>
    <x-error-and-correct-dialog />
    <div>
        <div class="flex justify-center">
            <div class="border rounded-lg w-[50%]">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-8">Materia</th>
                            <th class="py-2 px-8">Código</th>
                            <th class="py-2 px-8">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="/save-edit/{{$materias->id}}" method="post">
                            @csrf
                            <tr class="odd:bg-gray-400/20 py-2 px-8">
                                <td class="text-center py-2 px-8">
                                    <x-input-form value="{{ mb_strtoupper(trim($materias->materia)), 'UTF-8' }}"
                                        name="materia" autocomplete="off" placeholder="Nombre de la materia" />
                                </td>
                                <td class="text-center py-2 px-8">
                                    <x-input-form value="{{ mb_strtoupper(trim($materias->codigo)), 'UTF-8' }}"
                                        name="codigo" autocomplete="off" placeholder="Código de la materia" />
                                </td>
                                <x-table-td-students class="text-center py-2 px-8">
                                    <x-button type="button" class="bg-[#f00] hover:bg-[#b00] transition-all"
                                        onclick="history.back()">Cancelar</x-button>
                                    <x-button type="submit">Guardar Cambios</x-button>
                                </x-table-td-students>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard>
