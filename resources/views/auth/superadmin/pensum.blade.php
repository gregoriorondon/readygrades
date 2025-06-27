<x-dashboard>
    <x-slot:titulo>Pensum</x-slot:titulo>
    <x-button-a link="pensum-add" icon="fa-solid fa-plus-large">Añadir Plan De Estudios</x-button-a>
    @foreach ($carrera as $carreras)
        <x-title-section-admin>{{ $carreras->carrera }}</x-title-section-admin>
        <div class="flex justify-center mt-2 mb-7">
        <div class="border rounded-lg w-[40%]">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-400/20">
                        <th class="py-2">Tramo</th>
                        <th class="py-2">Trayecto</th>
                        <th class="py-2">Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pensum as $pensums)
                        <tr>
                            @if ($pensums->carreras->carrera === $carreras->carrera)
                                <td class="text-center py-2 border-t">{{ $pensums->tramos->tramos }}</td>
                                @foreach ($pensums->tramos->trayectos as $trayectos)
                                    <td class="text-center py-2 border-t">{{ $trayectos->trayectos }}</td>
                                @endforeach
                                <td class="text-center py-2 border-t"><i class="fa-solid fa-circle-info"></i></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</x-dashboard>
