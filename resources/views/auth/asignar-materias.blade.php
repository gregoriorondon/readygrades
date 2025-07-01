<x-dashboard>
    <x-slot:titulo>Signar Materias</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('asignar materias al docente (' . $carreras->carrera . ' - ' . $tramos->tramos->tramos . ')') }}</x-title-section-admin>
    <form action="{{ route('save.asignacion') }}" method="post">
        @csrf
        <input type="hidden" name="profesor_id" value="{{ $profesor }}">
        <input type="hidden" name="carrera_id" value="{{ $carrera }}">
        <input type="hidden" name="tramo_trayecto_id" value="{{ $tramos->id }}">
        <div class=" mx-auto w-fit">
            <div class="mt-9">
                <div class="border rounded-lg">
                    <table class="text-center">
                        <thead>
                            <tr>
                                <th class="px-9 py-3">Acción</th>
                                <th class="px-9 py-3">Materias</th>
                                <th class="px-9 py-3">Código</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materias as $materia)
                                <tr class="odd:bg-gray-400/50 border-t">
                                    <td class="px-9 py-3"><x-input-check type="checkbox" class="!p-3 !bg-gray-400/20"
                                            name="materia_id[]" value="{{ $materia->materias->id }}" /></td>
                                    <td class="px-9 py-3">
                                        {{ mb_strtoupper(trim($materia->materias->materia), 'UTF-8') }}
                                    </td>
                                    <td class="px-9 py-3">{{ mb_strtoupper(trim($materia->materias->codigo), 'UTF-8') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-9">
                <x-label>{{ ucwords('asignar sección al docente:') }}</x-label>
                <div class="border rounded-lg">
                    @foreach ($secciones as $seccion)
                        <x-label class="hover:bg-gray-400/20 p-2 rounded-lg cursor-pointer"><x-input-check
                                type="checkbox" name="seccion_id[]"
                                value="{{ $seccion->id }}" />{{ ucwords('sección: ') . '"' . $seccion->seccion . '"' }}</x-label>
                    @endforeach
                </div>
                <div class="flex justify-between mt-9">
                    <x-button type="button" class="bg-[#f00] hover:bg-[#b00]"
                        onclick="history.back()">{{ ucwords('cancelar') }}</x-button>
                    <x-button type="submit">{{ ucwords('asignar materias') }}</x-button>
                </div>
            </div>
        </div>
    </form>
    <x-error-and-correct-dialog />
</x-dashboard>
