<x-dashboard>
    <x-slot:titulo>Editar Título Académico</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('editar el título académico de ' . $buscar->carreras->carrera) }}</x-title-section-admin>
    <div class="flex justify-center mx-3">
        <div class="w-full max-w-[550px]">
            <form action="/save-edit-titulo-academic" method="post">
                @csrf
                <x-label class="mt-9">
                    {{ ucwords('ingrese el título académico que el estudiante obtendrá') }}
                    <x-input-form name="titulo" type="text" value="{{ $buscar->titulo }}"
                        placeholder="Ejemplo: TSU, Ingeniero, Licenciado..." autocomplete="off" />
                </x-label>
                <x-label class="mt-3">
                    {{ ucwords('ingrese una descripción (obsional)') }}
                    <x-input-form name="descripcion" value="{{ $buscar->descripcion }}" type="text"
                        placeholder="Ejemplo: Técnico Superior Universitario..." autocomplete="off" />
                </x-label>
                <x-label class="mt-3">{{ ucwords('seleccione la carrera que utilizará el título') }}</x-label>
                <x-select-form name="carrera_id">
                    <option value="{{ $buscar->carrera_id }}">{{ $buscar->carreras->carrera }} (Registrado)</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
                    @endforeach
                </x-select-form>
                <x-label
                    class="mt-3">{{ ucwords('seleccione el tramo que comenzará a utilizar el título') }}</x-label>
                <x-select-form name="tramo_trayecto_id">
                    <option value="{{ $buscar->tramo_trayecto_id }}">{{ $buscar->tramoTrayecto->tramos->tramos }} (Registrado)</option>
                    @foreach ($tramos as $trayecto)
                        <optgroup label="{{ $trayecto->trayectos }}">
                            @foreach ($trayecto->tramos as $tramo)
                                <option value="{{ $tramo->id }}">{{ $tramo->tramos }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </x-select-form>
                <input name="titulo_id" type="hidden" value="{{ $buscar->id }}" >
                <div class="flex justify-between mt-4">
                    <x-button type="button" class="bg-[#f00] hover:bg-[#b00]"
                        onclick="history.back()">Cancelar</x-button>
                    <x-button type="submit">Guardar Cambios</x-button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard>
