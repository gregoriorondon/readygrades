<title>Detalles de {{ $estudiante['primer_name'] }}</title>
<x-import />

<body class="cuerpo">
    <x-nav-student-public>
        <x-slot:usuario>{{ implode(' ', [$estudiante['primer_name'], $estudiante['primer_apellido']]) }}</x-slot:usuario>
    </x-nav-student-public>
    <div class="data-public-student-details items-center">
        <section class="personal-data">
            <div>
                <x-name-title-student-public>Nombre Completo</x-name-title-student-public>
                <x-date-student-public>{{ implode(' ', [$estudiante['primer_name'], $estudiante['segundo_name']]) }}</x-date-student-public>
            </div>
            <div>
                <x-name-title-student-public>Apellido Completo</x-name-title-student-public>
                <x-date-student-public>{{ implode(' ', [$estudiante['primer_apellido'], $estudiante['segundo_apellido']]) }}</x-date-student-public>
            </div>
            <div>
                <x-name-title-student-public>Género y Nacionalidad</x-name-title-student-public>
                <x-date-student-public>{{ ucfirst($estudiante->genero) }}
                    @if ($estudiante['genero'] === 'masculino')
                        @if ($estudiante['nacionalidad'] === 'VE')
                            Venezolano
                        @else
                            Extrangero
                        @endif
                    @else
                        @if ($estudiante['nacionalidad'] === 'VE')
                            Venezolana
                        @else
                            Extrangera
                        @endif
                    @endif
                </x-date-student-public>
            </div>
            <div>
                <x-name-title-student-public>Núcleo de Estudios</x-name-title-student-public>
                <x-date-student-public>{{ $estudiante->nucleos->nucleo }}</x-date-student-public>
            </div>
            <div>
                <x-name-title-student-public>Carrera Cursando</x-name-title-student-public>
                <x-date-student-public>{{ $estudiante->carreras->carrera }}</x-date-student-public>
            </div>
            <div>
                <x-name-title-student-public>Trayecto y Tramo Actual</x-name-title-student-public>
                <x-date-student-public>
                    @foreach ($estudiante->tramos->trayectos as $trayectos)
                        {{ $trayectos->trayectos }}
                    @endforeach
                    - {{ $estudiante->tramos->tramos }}
                </x-date-student-public>
            </div>
            <div>
                <x-name-title-student-public>Sección Actual</x-name-title-student-public>
                <x-date-student-public>
                    {{ $estudiante->secciones->seccion }}
                </x-date-student-public>
            </div>
            <div>
                <button class="calificacion-publica">Ver Tus Notas Académicas</button>
            </div>
        </section>
        <section class="card-logo-public">
            <x-authentication-card-logo />
        </section>
    </div>
    <div class="hidden notas-students flex justify-center items-center">
        <section class="notas w-[35%] mr-6">
            @foreach ($notasAgrupadas as $carreraId => $carreraData)
                <details class="border-2 rounded-xl text-xl divide-y-2  text-[#4272d8] my-3 detalles-carreras">
                    <summary
                        class="pl-7 py-3 divide-y-2 rounded-t-xl cursor-pointer font-semibold nombre-detalles-carreras">
                        {{ mb_strtoupper($carreraData['carrera']->carrera, 'UTF-8') }}
                    </summary>

                    @if (empty($carreraData['tramos']))
                        <p class="pl-7 py-3">No hay registros académicos disponibles</p>
                    @else
                        @foreach ($carreraData['tramos'] as $tramoId => $tramoData)
                            <details class="divide-y-2 tramos-detalles">
                                <summary class="pl-7 py-3 cursor-pointer tramos-detalles-summary">
                                    {{ $tramoData['tramo']->trayectos->trayectos }} -
                                    {{ $tramoData['tramo']->tramos->tramos }}
                                </summary>

                                @if (empty($tramoData['materias']))
                                    <p class="pl-12 py-3">No hay materias registradas</p>
                                @else
                                    @foreach ($tramoData['materias'] as $materiaId => $materiaData)
                                        @php
                                            $definitiva =
                                                $materiaData['nota']->nota_uno +
                                                $materiaData['nota']->nota_dos +
                                                $materiaData['nota']->nota_tres +
                                                $materiaData['nota']->nota_cuatro;
                                            $definitivaDivicion = round($definitiva / 4);
                                        @endphp
                                        <details class="divide-y-2 materias-publico">
                                            <summary class="pl-12 py-3 cursor-pointer">
                                                {{ $materiaData['materia']->materia }}
                                            </summary>
                                            <table class="w-full tabla-notas-publico">
                                                <thead>
                                                    <tr class="divide-x-2 divide-[#4272d8] text-center">
                                                        <th title="Primera Nota">25%</th>
                                                        <th title="Segunda Nota">25%</th>
                                                        <th title="Trecera Nota">25%</th>
                                                        <th title="Cuarta Nota">25%</th>
                                                        <th title="Nota Extra">EXT</th>
                                                        <th title="Definitiva">DEF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="divide-x-2 divide-[#4272d8] text-center">
                                                        <td
                                                            title="Primera nota de la asignatura es: {{ $materiaData['nota']->nota_uno ?? 'Aún no tienes nota' }}">
                                                            {{ $materiaData['nota']->nota_uno }}</td>
                                                        <td
                                                            title="Segunda nota de la asignatura es: {{ $materiaData['nota']->nota_dos ?? 'Aún no tienes nota' }}">
                                                            {{ $materiaData['nota']->nota_dos }}</td>
                                                        <td
                                                            title="Tercera nota de la asignatura es: {{ $materiaData['nota']->nota_tres ?? 'Aún no tienes nota' }}">
                                                            {{ $materiaData['nota']->nota_tres }}</td>
                                                        <td
                                                            title="Cuarta nota de la asignatura es: {{ $materiaData['nota']->nota_cuatro ?? 'Aún no tienes nota' }}">
                                                            {{ $materiaData['nota']->nota_cuatro }}</td>
                                                        <td
                                                            title="Nota extra de la asignatura es: {{ $materiaData['nota']->nota_extra ?? 'Aún no tienes nota' }}">
                                                            {{ $materiaData['nota']->nota_extra }}</td>
                                                        <td
                                                            title="La definitiva es una suma de las calificaciones dividida entre 4">
                                                            {{ $definitivaDivicion . ' pts' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </details>
                                    @endforeach
                                @endif
                            </details>
                        @endforeach
                    @endif
                </details>
            @endforeach
        </section>
        <section class="card-logo-public">
            <x-authentication-card-logo />
        </section>
    </div>
    <div class="m-7">
        <p class="text-center font-inter mb-4 text-black/50">Por temas de seguridad y privacidad del y de la estudiante
            no se muestran todos los datos personales requeridos en la inscripción</p>
    </div>
    @vite(['resources/js/section-calificaciones-general-public-student.js', 'resources/js/back-cedula-public-studens.js'])
    <x-footer />
</body>
