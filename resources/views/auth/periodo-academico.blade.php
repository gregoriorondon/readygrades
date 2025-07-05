<x-dashboard>
    <x-slot:titulo>Periodos Académicos</x-slot:titulo>
    <x-title-section-admin>Periodos Académicos</x-title-section-admin>
    <div class="w-fit mx-auto mt-7">
        <form action="/add-periodo" method="post">
            @csrf
            <x-label class="mt-3">Selecciona la fecha de inicio del período académico</x-label>
            <x-input-form type="date" name="inicio" />
            <x-label class="mt-3">Selecciona la fecha de final del período académico</x-label>
            <x-input-form type="date" name="fin" />
            <x-label class="mt-3">Coloca un nombre al período académico</x-label>
            <x-input-form type="text" name="nombre" placeholder="Nombre del período académico" />

            <div class="mt-7 flex justify-between">
                <x-button type="button" onclick="history.back()" class="bg-[#f00] hover:bg-[#b00]">Cancelar</x-button>
                <x-button type="submit">Guardar</x-button>
            </div>
        </form>
    </div>
    <div class="mt-14 flex">
        <div class="border rounded-lg mx-auto">
            <table class="">
                <thead>
                    <tr>
                        <th class="px-12 py-4">{{ ucwords('nombre del periódo') }}</th>
                        <th class="px-12 py-4">Inicio Periodo</th>
                        <th class="px-12 py-4">Fin Periodo</th>
                        <th class="px-12 py-4">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periodo as $periodos)
                        <tr class="odd:bg-gray-400/20">
                            <td class="px-12 p-4 border-t">{{ $periodos->nombre }}</td>
                            <td class="px-12 p-4 border-t">{{ $periodos->inicio }}</td>
                            <td class="px-12 p-4 border-t">{{ $periodos->fin }}</td>
                            @if((bool)$periodos->activo !== false)
                                <td class="px-12 p-3 border-t">
                                    <button type="button" class="bg-green-500/50 hover:bg-green-500/80 p-2 rounded-lg">Activo</button>
                                </td>
                            @else
                                <td class="px-12 p-3 border-t select-none">
                                    <p class="bg-gray-400/20 p-2 rounded-lg">Finalizado</p>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $periodo->links() }}
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
