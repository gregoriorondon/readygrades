<x-dashboard>
    <x-slot:titulo>Núcleos</x-slot:titulo>
    <x-title-section-admin>Editar El Núcleo {{ ucfirst($nucleo->nucleo) }}</x-title-section-admin>
    <x-error-and-correct-dialog />
    <div>
        <div class="flex justify-center">
            <div class="border rounded-lg w-[50%]">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-8">Núcleo</th>
                            <th class="py-2 px-8">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="/save-nucleo/{{$nucleo->id}}" method="post">
                            @csrf
                            <tr class="odd:bg-gray-400/20 py-2 px-8">
                                <td class="text-center py-2 px-8">
                                    <x-input-form value="{{ ucfirst($nucleo->nucleo), 'UTF-8' }}"
                                        name="nucleo" autocomplete="off" placeholder="Coloque el nuevo nombre del núcleo" />
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
