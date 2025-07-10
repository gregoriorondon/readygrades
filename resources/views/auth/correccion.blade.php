<x-dashboard>
    <x-slot:titulo>Corrección De Notas</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('ajuste de calificación solicitada') }}</x-title-section-admin>
    <div class="mt-9">
        <div class="flex justify-center">
            <div class="w-[400px]">
                <p>{{ ucwords('estudiante: ') . $estudiante->primer_name . ' ' . $estudiante->primer_apellido }}</p>
                <p>{{ ucwords('cédula: ') . $estudiante->cedula }}</p>
                <p>{{ ucwords('materia: ') . $pensum->materias->materia }}</p>
                <p>{{ ucwords('periodo de la asignatura: ') . $periodo->nombre }}</p>
                <form action="/save-correccion" method="post">
                    @csrf
                    @if ($notas->nota_editar === 'nota_uno')
                        <x-label>{{ ucwords('corregir la primera calificación 25%:') }}
                            <x-select-form name="correccion">
                                <option>{{ $notas->nota_uno }}</option>
                            </x-select-form>
                        </x-label>
                    @endif
                    @if ($notas->nota_editar === 'nota_dos')
                        <x-label>{{ ucwords('corregir la segunda calificación 25%:') }}
                            <x-select-form name="correccion">
                                <option>{{ $notas->nota_dos . ' pts (' . ucwords('calificación anterior') . ')' }}</option>
                                @for ($j = 1; $j <= 20; $j++)
                                    <option value="{{ $j }}">
                                        {{ $j . ' pts ' }}</option>
                                @endfor
                            </x-select-form>
                        </x-label>
                    @endif
                    @if ($notas->nota_editar === 'nota_tres')
                        <x-label>{{ ucwords('corregir la tercera calificación 25%:') }}
                            <x-select-form name="correccion">
                                <option>{{ $notas->nota_tres . ' pts (' . ucwords('calificación anterior') . ')' }}</option>
                                @for ($j = 1; $j <= 20; $j++)
                                    <option value="{{ $j }}">
                                        {{ $j . ' pts ' }}</option>
                                @endfor
                            </x-select-form>
                        </x-label>
                    @endif
                    @if ($notas->nota_editar === 'nota_cuatro')
                        <x-label>{{ ucwords('corregir la cuarta calificación 25%:') }}
                            <x-select-form name="correccion">
                                <option>{{ $notas->nota_cuatro . ' pts (' . ucwords('calificación anterior') . ')' }}</option>
                                @for ($j = 1; $j <= 20; $j++)
                                    <option value="{{ $j }}">
                                        {{ $j . ' pts ' }}</option>
                                @endfor
                            </x-select-form>
                        </x-label>
                    @endif
                    @if ($notas->nota_editar === 'nota_extra')
                        <x-label>{{ ucwords('corregir la calificación extra:') }}
                            <x-select-form name="correccion">
                                <option>{{ $notas->nota_extra . ' pts (' . ucwords('calificación anterior') . ')' }}</option>
                                @for ($j = 1; $j <= 20; $j++)
                                    <option value="{{ $j }}">
                                        {{ $j . ' pts ' }}</option>
                                @endfor
                            </x-select-form>
                        </x-label>
                    @endif
                    <input type="hidden" name="pensum_id" value="{{ $pensum->id }}">
                    <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">
                    <input type="hidden" name="periodo_id" value="{{ $periodo->id }}">
                    <div class="flex justify-between mt-3">
                        <x-button type="button" onclick="history.back()"
                            class="bg-[#f00] hover:bg-[#b00]">Cancelar</x-button>
                        <x-button>Guardar Corrección</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
