<x-dashboard>
    <x-slot:titulo>Calificaciones De {{ $estudiante['primer_name'] }}</x-slot:titulo>
    <x-title-section-admin>Calificaciones Del Estudiante
        {{ implode(' ', [$estudiante['primer_name'], $estudiante['primer_apellido']]) }}</x-title-section-admin>
    <div class="mx-auto w-fit text-center">
        <div class="mt-7 border border-gray-300 rounded-md">
            <dl class="divide-y divide-gray-300 ">
                @foreach ($notas as $nota)
                    <x-details-div>
                        <x-details-dt>{{ ucwords($nota->pensums->materias->materia) }}:</x-details-dt>
                        <x-details-dd>{{ $nota->nota }} pts<a href=""
                                class="ml-7 p-1 rounded-lg hover:bg-gray-400/20 transition-all"><i
                                    class="fas fa-edit"></i>Editar</a> </x-details-dd>
                    </x-details-div>
                @endforeach
            </dl>

        </div>
        <div class="flex justify-end mt-2">
            <x-button type="button" onclick="history.back()">Regresar</x-button>
        </div>
    </div>
</x-dashboard>
