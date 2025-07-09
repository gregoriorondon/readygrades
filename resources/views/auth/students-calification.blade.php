<x-dashboard>
    <x-slot:titulo>Calificaciones De {{ $estudiante['primer_name'] }}</x-slot:titulo>
    @if ($estudiante->genero !== 'masculino')
        <x-title-section-admin>Calificaciones De La Estudiante
            {{ implode(' ', [$estudiante['primer_name'], $estudiante['primer_apellido']]) }}</x-title-section-admin>
    @else
        <x-title-section-admin>Calificaciones Del Estudiante
            {{ implode(' ', [$estudiante['primer_name'], $estudiante['primer_apellido']]) }}</x-title-section-admin>
    @endif
    <div class="sm:mx-[20%]">
        <div class="mt-7 border border-gray-300 rounded-md">
            <div class="flex justify-center w-full">
                <table class="w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="py-3 font-inter">Nota</th>
                            <th class="py-3 font-inter">Materia</th>
                            <th class="py-3 font-inter">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($notas as $nota)
                            <tr class="odd:bg-gray-100/20">
                                @php
                                    $suma = $nota->nota_uno + $nota->nota_dos + $nota->nota_tres + $nota->nota_cuatro;
                                    $definitiva = round($suma / 4);
                                @endphp
                                <td class="py-3 font-inter text-center">{{ $definitiva }} pts</td>
                                <td class="py-3 font-inter text-center">{{ ucwords($nota->pensums->materias->materia) }}</td>
                                <td class="py-3 font-inter text-center">
                                    @if((bool)$nota->editado === true)
                                        <x-button>Editar</x-button>
                                    @else
                                        <button disabled class="bg-gray-400/20 py-2 px-4 rounded-lg">Editar</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-end mt-2">
            <x-button type="button" icon="fas fa-arrow-left" onclick="history.back()">Regresar</x-button>
        </div>
    </div>
</x-dashboard>
