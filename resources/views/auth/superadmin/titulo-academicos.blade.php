<x-dashboard>
    <x-slot:titulo>Títulos Académicos</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('agregar o gestionar títulos académicos de los estudiantes') }}</x-title-section-admin>
    <div class="flex justify-center mx-3">
        <div class="w-full max-w-[550px]">
            <form action="/save-titulo-academic" method="post">
                @csrf
                <x-label class="mt-9">
                    {{ ucwords('ingrese el título académico que el estudiante obtendrá') }}
                    <x-input-form name="titulo" type="text" :value="old('titulo')"
                        placeholder="Ejemplo: TSU, Ingeniero, Licenciado..." autocomplete="off" />
                </x-label>
                <x-label class="mt-3">
                    {{ ucwords('ingrese una descripción (obsional)') }}
                    <x-input-form name="descripcion" :value="old('descripcion')" type="text"
                        placeholder="Ejemplo: Técnico Superior Universitario..." autocomplete="off" />
                </x-label>
                <x-label class="mt-3">{{ ucwords('seleccione la carrera que utilizará el título') }}</x-label>
                <x-select-form name="carrera_id">
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
                    @endforeach
                </x-select-form>
                <x-label
                    class="mt-3">{{ ucwords('seleccione el tramo que comenzará a utilizar el título') }}</x-label>
                <x-select-form name="tramo_trayecto_id">
                    @foreach ($tramos as $trayecto)
                        <optgroup label="{{ $trayecto->trayectos }}">
                            @foreach ($trayecto->tramos as $tramo)
                                <option value="{{ $tramo->id }}">{{ $tramo->tramos }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </x-select-form>
                <div class="flex justify-between mt-4">
                    <x-button type="button" class="bg-[#f00] hover:bg-[#b00]"
                        onclick="history.back()">Cancelar</x-button>
                    <x-button type="submit">Agregar Título</x-button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex justify-center mt-16">
        @if ($titulos->isEmpty())
            <p class="text-center text-gray-500/50 select-none">
                {{ ucwords('aún no hay títulos académicos para los estudiantes en el sistema') }}</p>
        @else
            <div class="border rounded-lg w-full max-w-[550px] overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="py-3">Título</th>
                            <th class="py-3">Carrera</th>
                            <th class="py-3">Tramo</th>
                            <th class="py-3">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($titulos as $titulo)
                            <tr class="odd:bg-gray-400/20 divide-y text-center">
                                <td>{{ $titulo->titulo }}</td>
                                <td>{{ $titulo->carreras->carrera }}</td>
                                <td>{{ $titulo->tramoTrayecto->tramos->tramos }}</td>
                                <td><a href="" title="Editar Título"
                                        class="p-2 text-xl hover:bg-gray-400/20 rounded-md"><i
                                            class="fa-solid fa-edit m-0"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
