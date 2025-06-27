<x-dashboard>
    <x-slot:titulo>Materias</x-slot:titulo>
    <x-title-section-admin>Agregar Una Nueva Materia Al Sistema</x-title-section-admin>
    <div class="flex justify-center my-8">
        <div class="w-[30%]">
            <form action="/materia" method="post">
                @csrf
                <x-label>Nombre De La Materia:<x-input-form type="text" name="materia" autocomplete="off"
                    placeholder="Ingrese el Nombre de la materia a registrar" /></x-label>
                <x-label class="mt-3">Código De La Materia:<x-input-form type="text" name="codigo" autocomplete="off"
                    placeholder="Ingrese el código de la materia a registrar" /></x-label>
                <div class="flex justify-end">
                    <x-button class="mt-2" type="submit">Enviar</x-button>
                </div>
            </form>
        </div>
    </div>
    <x-error-and-correct-dialog />
    <div>
        <div class="flex justify-center">
            <div class="border rounded-lg w-[50%]">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-8">Materia</th>
                            <th class="py-2 px-8">Código</th>
                            <th class="py-2 px-8">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($materias->isEmpty())
                            <p>Aun no hay materias registradas en el sistema.</p>
                        @else
                            @foreach ($materias as $materia)
                                <tr class="odd:bg-gray-400/20 py-2 px-8">
                                    <td class="text-center py-2 px-8">
                                        {{ mb_strtoupper(trim($materia->materia)), 'UTF-8' }}</td>
                                    <td class="text-center py-2 px-8">
                                        {{ mb_strtoupper(trim($materia->codigo)), 'UTF-8' }}</td>
                                    <td class="text-center py-2 px-8">
                                        <a href="/editar-materia/{{ $materia->id }}" class="hover:bg-gray-400/20 p-1 transition-all rounded-lg"><i class="fa fa-edit mr-2"></i>Editar Materia</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center mt-2">
            <div class="w-[50%]">
                {{ $materias->links() }}
            </div>
        </div>
    </div>
</x-dashboard>
