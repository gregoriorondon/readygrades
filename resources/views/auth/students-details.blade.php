<x-dashboard>
    <x-slot:titulo>Detalles de {{ $estudiantes['primer_name'] }}</x-slot:titulo>
    <div class="flex justify-between mt-2">
        <x-button-a route="students.index" icon="fas fa-arrow-left">Regresar</x-button-a>
            <div class="mx-auto">
                @if ($estudiantes->genero !== 'masculino')
                    <x-title-section-admin>Información De La Estudiante
                        {{ implode(' ', [$estudiantes['primer_name'], $estudiantes['primer_apellido']]) }}</x-title-section-admin>
                @else
                    <x-title-section-admin>Información Del Estudiante
                        {{ implode(' ', [$estudiantes['primer_name'], $estudiantes['primer_apellido']]) }}</x-title-section-admin>
                @endif
            </div>
            <x-button-a route="students.edit" :parametros="$estudiantes->cedula" icon="fas fa-edit">Editar Datos</x-button-a>
    </div>
    <div class="">
        <div class="mt-7 border border-gray-300 rounded-md">
            <dl class="divide-y divide-gray-300 ">
                <x-details-div>
                    @if ($estudiantes->genero !== 'masculino')
                        <x-details-dt>Nombre Completo De La Estudiante:</x-details-dt>
                    @else
                        <x-details-dt>Nombre Completo Del Estudiante:</x-details-dt>
                    @endif
                    <x-details-dd>{{ implode(' ', [$estudiantes['primer_name'], $estudiantes['segundo_name']]) }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    @if ($estudiantes->genero !== 'masculino')
                        <x-details-dt>Apellido Completo De La Estudiante:</x-details-dt>
                    @else
                        <x-details-dt>Apellido Completo Del Estudiante:</x-details-dt>
                    @endif
                    <x-details-dd>{{ implode(' ', [$estudiantes['primer_apellido'], $estudiantes['segundo_apellido']]) }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Correo Electrónico:</x-details-dt>
                    <x-details-dd>
                        @if ($estudiantes->email === null)
                            @if ($estudiantes->genero !== 'masculino')
                                <x-span>La Estudiante No Cuenta Con Correo Electrónico:</x-span>
                            @else
                                <x-span>El Estudiante No Cuenta Con Correo Electrónico:</x-span>
                            @endif
                        @else
                            {{ $estudiantes['email'] }} <a target="_blank" href="mailto:{{ $estudiantes['email'] }}"
                                title="Abrir gestor de correo para enviarle un correo electrónico"><i
                                    class="fa-solid fa-envelope-open-text text-lg ml-3"></i></a>
                        @endif
                    </x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Cédula:</x-details-dt>
                    <x-details-dd>
                        @if ($estudiantes->nacionalidad === 'VE')
                            V -
                        @else
                            E -
                        @endif{{ $estudiantes['cedula'] }}
                    </x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Teléfono:</x-details-dt>
                    <x-details-dd>
                        @if ($estudiantes->telefono === null)
                            @if ($estudiantes->genero !== 'masculino')
                                <x-span>La Estudiante No Cuenta Con Teléfono:</x-span>
                            @else
                                <x-span>El Estudiante No Cuenta Con Teléfono:</x-span>
                            @endif
                        @else
                            {{ $estudiantes['telefono'] }}
                        @endif
                    </x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Teléfono Extra:</x-details-dt>
                    <x-details-dd>
                        @if ($estudiantes->telefono2 === null)
                            @if ($estudiantes->genero !== 'masculino')
                                <x-span>La Estudiante No Cuenta Con Teléfono De Habitación/Extra:</x-span>
                            @else
                                <x-span>El Estudiante No Cuenta Con Teléfono De Habitación/Extra:</x-span>
                            @endif
                        @else
                            {{ $estudiantes['telefono2'] }}
                        @endif
                    </x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Fecha de Nacimiento:</x-details-dt>
                    <x-details-dd>{{ $estudiantes['fecha_nacimiento'] }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Ciudad de Nacimiento:</x-details-dt>
                    @if (empty($estudiantes->nacimiento_city))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes->nacimiento_city }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Genero:</x-details-dt>
                    <x-details-dd>{{ ucfirst(strtolower($estudiantes['genero'])) }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Estado Civil:</x-details-dt>
                    @if ($estudiantes->genero === 'masculino')
                        @switch($estudiantes->civil)
                            @case('s')
                                <x-details-dd>{{ ucfirst(strtolower('soltero')) }}</x-details-dd>
                                @break
                            @case('c')
                                <x-details-dd>{{ ucfirst(strtolower('casado')) }}</x-details-dd>
                                @break
                            @case('v')
                                <x-details-dd>{{ ucfirst(strtolower('viudo')) }}</x-details-dd>
                                @break
                            @case('d')
                                <x-details-dd>{{ ucfirst(strtolower('divorsiado')) }}</x-details-dd>
                                @break
                            @default
                                <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endswitch
                    @else
                        @switch($estudiantes->civil)
                            @case('s')
                                <x-details-dd>{{ ucfirst(strtolower('soltera')) }}</x-details-dd>
                                @break
                            @case('c')
                                <x-details-dd>{{ ucfirst(strtolower('casada')) }}</x-details-dd>
                                @break
                            @case('v')
                                <x-details-dd>{{ ucfirst(strtolower('viuda')) }}</x-details-dd>
                                @break
                            @case('d')
                                <x-details-dd>{{ ucfirst(strtolower('divorsiada')) }}</x-details-dd>
                                @break
                            @default
                                <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endswitch
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Consejo:</x-details-dt>
                    @if (empty($estudiantes->consejo))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes->consejo }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Comuna:</x-details-dt>
                    @if (empty($estudiantes->comuna))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes->comuna }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Ciudad - Pueblo:</x-details-dt>
                    <x-details-dd>{{ $estudiantes['city'] }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Dirección:</x-details-dt>
                    <x-details-dd>{{ $estudiantes->direccion }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Discapacidad:</x-details-dt>
                    @if (empty($estudiantes->discapacidad))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('el estudiante no cuenta con ninguna discapacidad')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('la estudiante no cuenta con ninguna discapacidad')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes['discapacidad'] }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Disciplina:</x-details-dt>
                    @if (empty($estudiantes->disciplina))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('el estudiante no cuenta con ninguna disciplina')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('la estudiante no cuenta con ninguna disciplina')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes['disciplina'] }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Titulo De Ingreso:</x-details-dt>
                    @if (empty($titulo->titulo))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $titulo->titulo }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Mención:</x-details-dt>
                    @if (empty($estudiantes->mencion))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes->mencion }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Institución:</x-details-dt>
                    @if (empty($estudiantes->institucion))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes->institucion }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Ciudad de la Institución:</x-details-dt>
                    @if (empty($estudiantes->cityinstitucion))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes->cityinstitucion }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Fecha del Grado:</x-details-dt>
                    @if (empty($estudiantes->fecha_grado))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes->fecha_grado }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Promedio OPSU:</x-details-dt>
                    @if (empty($estudiantes->promedio))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes->promedio }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Nivel Socio Económico:</x-details-dt>
                    @if (empty($nivelSocial->socioeconomico))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (el estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('sin datos (la estudiante debe traer información)')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $nivelSocial->socioeconomico }}</x-details-dd>
                    @endif
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Lugar de Trabajo:</x-details-dt>
                    @if (empty($estudiantes->trabaja))
                        @if ($estudiantes->genero === 'masculino')
                            <x-details-dd><x-span>{{ ucfirst(strtolower('el estudiante no cuenta con ningún trabajo')) }}</x-span></x-details-dd>
                        @else
                            <x-details-dd><x-span>{{ ucfirst(strtolower('la estudiante no cuenta con ningún trabajo')) }}</x-span></x-details-dd>
                        @endif
                    @else
                        <x-details-dd>{{ $estudiantes->trabaja }}</x-details-dd>
                    @endif
                </x-details-div>
                {{-- <x-details-div> --}}
                {{--     <x-details-dt>Núcleo de Estudios:</x-details-dt> --}}
                {{--     {{-- <x-details-dd>{{ $carrera->studentcodigonucleo->nucleo->nucleo }}</x-details-dd> --}}
                {{-- </x-details-div> --}}
            </dl>
        </div>

        @foreach ($notasAgrupada as $carrera => $tramo)
            <details class="select-none border rounded-md divide-y my-3">
                <summary class="pl-7 py-3 divide-y rounded-t-md cursor-pointer font-semibold odd:bg-gray-100/20 event:bg-transparent">
                    Calificaciones De {{ $carrera }}
                </summary>
                    @foreach ($tramo as $tramos => $materias)
                    <details class="divide-y odd:bg-gray-100/20 event:bg-transparent">
                        <summary class="pl-10 py-3 cursor-pointer">
                            {{ ucwords('tramo: ') . $tramos }}
                        </summary>
                        @foreach ($materias as $notas)
                        <details class="divide-y odd:bg-gray-100/20 event:bg-transparent">
                            <summary class="pl-14 py-3 cursor-pointer">
                                {{ $notas->pensums->materias->materia }}
                            </summary>
                            <div class="overflow-x-auto">
                                <div class="">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="text-center">
                                                <th title="Primera Nota">25%</th>
                                                <th title="Segunda Nota">25%</th>
                                                <th title="Trecera Nota">25%</th>
                                                <th title="Cuarta Nota">25%</th>
                                                <th title="Nota Extra">EXT</th>
                                                <th title="Definitiva">DEF</th>
                                                <th title="Corrección">Corrección</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                @php
                                                    $suma = $notas->nota_uno + $notas->nota_dos + $notas->nota_tres + $notas->nota_cuatro + $notas->nota_extra;
                                                    $definitiva = round($suma / 4);
                                                @endphp
                                                <td class="min-w-16"
                                                    title="Primera nota de la asignatura es: {{ $notas->nota_uno ?? 'Aún no tiene nota' }}">
                                                    {{ $notas->nota_uno ?? '0' }}pts</td>
                                                <td class="min-w-16"
                                                    title="Segunda nota de la asignatura es: {{ $notas->nota_dos ?? 'Aún no tiene nota' }}">
                                                    {{ $notas->nota_dos ?? '0' }}pts</td>
                                                <td class="min-w-16"
                                                    title="Tercera nota de la asignatura es: {{ $notas->nota_tres ?? 'Aún no tiene nota' }}">
                                                    {{ $notas->nota_tres ?? '0' }}pts</td>
                                                <td class="min-w-16"
                                                    title="Cuarta nota de la asignatura es: {{ $notas->nota_cuatro ?? 'Aún no tiene nota' }}">
                                                    {{ $notas->nota_cuatro ?? '0' }}pts</td>
                                                <td class="min-w-16"
                                                    title="Nota extra de la asignatura es: {{ $notas->nota_extra ?? 'Aún no tiene nota' }}">
                                                    {{ $notas->nota_extra ?? '0' }}pts</td>
                                                <td class="min-w-16"
                                                    title="La definitiva es una suma de las calificaciones dividida entre 4">
                                                    {{ $definitiva . ' pts' }}</td>
                                                <td class=" font-inter text-center">
                                                    @if ((bool) $notas->editado === true)
                                                        <x-button-a
                                                            link="correccion/{{ $notas->id }}/estudiante/{{ $notas->studentsInscripcion->id }}/{{ $notas->periodos->id }}/{{ $notas->pensums->id }}">Corregir</x-button-a>
                                                    @else
                                                        <button disabled
                                                            class="px-4 py-2 bg-gray-400/20 rounded-md font-semibold text-xs uppercase tracking-widest cursor-not-allowed">
                                                            <i class="fa-solid fa-ban"></i>Corregir</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </details>
                        @endforeach
                    </details>
                    @endforeach
            </details>
        @endforeach
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
