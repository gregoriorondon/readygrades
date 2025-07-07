<x-dashboard>
    <x-slot:titulo>{{ ucwords('calificar') }}</x-slot:titulo>
    <x-title-section-admin>{{ ucwords(trim('calificar estudiante seleccionado')) }}</x-title-section-admin>
    <div>
        <div class="mt-7">
            @if ($estudiante->genero === 'masculino')
                <p>{{ ucwords('nombre del estudiante: ' . $estudiante->primer_name . ' ' . $estudiante->segundo_name) }}
                </p>
                <p>{{ ucwords('apellido del estudiante: ' . $estudiante->primer_apellido . ' ' . $estudiante->segundo_apellido) }}
                </p>
            @else
                <p>{{ ucwords('nombre de la estudiante: ' . $estudiante->primer_name . ' ' . $estudiante->segundo_name) }}
                </p>
                <p>{{ ucwords('apellido de la estudiante: ' . $estudiante->primer_apellido . ' ' . $estudiante->segundo_apellido) }}
                </p>
            @endif
            <p>{{ ucwords('cédula: ' . $estudiante->cedula) }}</p>
            <div class="mt-7 border rounded-lg">
                <form action="/guardar-calificacion" method="post" id="guardarcalifi">
                    @csrf
                    <input type="hidden" name="asignacion_id" value="{{ $asignacion->id }}">
                    <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">
                    <input type="hidden" name="pensum_id" value="{{ $asignacion->pensums->id }}">
                    <input type="hidden" name="nota_definitiva" id="inputNotaDefinitiva">
                    <dl class="divide-y">
                        <x-details-div class="flex items-center">
                            <x-details-dt>{{ ucwords(trim('primera nota (25%):')) }}</x-details-dt>
                            <x-details-dd>
                                @if (empty($notas->nota_uno))
                                    <x-select-form name="nota_uno" class="!mt-0 w-[120px] nota-select" id="nota1">
                                        <option value="">{{ ucwords('seleccione') }}</option>
                                        @for ($j = 1; $j <= 20; $j++)
                                            <option value="{{ $j }}">
                                                {{ $j . ' pts ' }}</option>
                                        @endfor
                                    </x-select-form>
                                @else
                                    <x-span id="nota1-display" class="mr-4">{{ $notas->nota_uno . ' pts' }}</x-span>
                                    <input type="hidden" id="nota1" value="{{ $notas->nota_uno }}">
                                    <x-button>Editar</x-button>
                                @endif
                            </x-details-dd>
                        </x-details-div>


                        <x-details-div class="flex items-center">
                            <x-details-dt>{{ ucwords(trim('segunda nota (25%):')) }}</x-details-dt>
                            <x-details-dd>
                                @if (empty($notas->nota_dos))
                                    <x-select-form name="nota_dos" class="!mt-0 w-[120px] nota-select" id="nota2">
                                        <option value="">{{ ucwords('seleccione') }}</option>
                                        @for ($j = 1; $j <= 20; $j++)
                                            <option value="{{ $j }}">
                                                {{ $j . ' pts ' }}</option>
                                        @endfor
                                    </x-select-form>
                                @else
                                    <x-span id="nota2-display" class="mr-4">{{ $notas->nota_dos . ' pts' }}</x-span>
                                    <input type="hidden" id="nota2" value="{{ $notas->nota_dos }}">
                                    <x-button>Editar</x-button>
                                @endif
                            </x-details-dd>
                        </x-details-div>


                        <x-details-div class="flex items-center">
                            <x-details-dt>{{ ucwords(trim('tercera nota (25%):')) }}</x-details-dt>
                            <x-details-dd>
                                @if (empty($notas->nota_tres))
                                    <x-select-form name="nota_tres" class="!mt-0 w-[120px] nota-select" id="nota3">
                                        <option value="">{{ ucwords('seleccione') }}</option>
                                        @for ($j = 1; $j <= 20; $j++)
                                            <option value="{{ $j }}">
                                                {{ $j . ' pts ' }}</option>
                                        @endfor
                                    </x-select-form>
                                @else
                                    <x-span id="nota3-display" class="mr-4">{{ $notas->nota_tres . ' pts' }}</x-span>
                                    <input type="hidden" id="nota3" value="{{ $notas->nota_tres }}">
                                    <x-button>Editar</x-button>
                                @endif
                            </x-details-dd>
                        </x-details-div>


                        <x-details-div class="flex items-center">
                            <x-details-dt>{{ ucwords(trim('cuarta nota (25%):')) }}</x-details-dt>
                            <x-details-dd>
                                @if (empty($notas->nota_cuatro))
                                    <x-select-form name="nota_cuatro" class="!mt-0 w-[120px] nota-select"
                                        id="nota4">
                                        <option value="">{{ ucwords('seleccione') }}</option>
                                        @for ($j = 1; $j <= 20; $j++)
                                            <option value="{{ $j }}">
                                                {{ $j . ' pts ' }}</option>
                                        @endfor
                                    </x-select-form>
                                @else
                                    <x-span id="nota4-display" class="mr-4">{{ $notas->nota_cuatro . ' pts' }}</x-span>
                                    <input type="hidden" id="nota4" value="{{ $notas->nota_cuatro }}">
                                    <x-button>Editar</x-button>
                                @endif
                            </x-details-dd>
                        </x-details-div>


                        <x-details-div class="flex items-center">
                            <x-details-dt>{{ ucwords(trim('nota extra:')) }}</x-details-dt>
                            <x-details-dd>
                                @if (empty($notas->nota_extra))
                                    <x-select-form name="nota_extra" class="!mt-0 w-[120px] nota-select" id="notaExtra">
                                        <option value="">{{ ucwords('seleccione') }}</option>
                                        @for ($j = 1; $j <= 20; $j++)
                                            <option value="{{ $j }}">
                                                {{ $j . ' pts ' }}</option>
                                        @endfor
                                    </x-select-form>
                                @else
                                    <x-span class="mr-4">{{ $notas->nota_extra . ' pts' }}</x-span>
                                    <x-button>Editar</x-button>
                                @endif
                            </x-details-dd>
                        </x-details-div>


                        <x-details-div class="flex items-center">
                            <x-details-dt>{{ ucwords(trim('nota definitiva:')) }}</x-details-dt>
                            <x-details-dd>
                                <div>
                                    <x-span class="font-normal">{{ ucwords('calculada:') }}</x-span>
                                    <x-span id="notaDefinitiva" class="font-normal">0.00</x-span>
                                </div>
                                <div>
                                    <x-span class="font-normal">{{ ucwords('redondeada:') }}</x-span>
                                    <x-span id="notaRedondeada" class="font-normal">0</x-span>
                                </div>
                            </x-details-dd>
                        </x-details-div>
                    </dl>
                </form>
            </div>
            <div class="mt-3 flex justify-between">
                <x-button class="bg-[#f00] hover:bg-[#b00]" onclick="history.back()">Cancelar</x-button>
                <x-button type="submit" form="guardarcalifi">Guardar</x-button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notaSelects = document.querySelectorAll('.nota-select');

            notaSelects.forEach(select => {
                select.addEventListener('change', calcularNotaDefinitiva);
            });

            function calcularNotaDefinitiva() {
                const nota1 = parseFloat(document.getElementById('nota1').value) || 0;
                const nota2 = parseFloat(document.getElementById('nota2').value) || 0;
                const nota3 = parseFloat(document.getElementById('nota3').value) || 0;
                const nota4 = parseFloat(document.getElementById('nota4').value) || 0;
                const notaExtra = parseFloat(document.getElementById('notaExtra').value) || 0;

                let sumaTotal = nota1 + nota2 + nota3 + nota4;

                if (notaExtra > 0) {
                    sumaTotal += notaExtra;
                }

                const notaDefinitiva = sumaTotal / 4;
                const notaFinal = Math.round(notaDefinitiva);

                document.getElementById('notaDefinitiva').textContent = notaDefinitiva.toFixed(2);
                document.getElementById('notaRedondeada').textContent = notaFinal;
                document.getElementById('inputNotaDefinitiva').value = notaFinal;
            }
        });
    </script>
    <x-error-and-correct-dialog />
</x-dashboard>
