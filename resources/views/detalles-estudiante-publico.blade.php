<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de {{ $estudiante['primer_name'] }}</title>
    <x-import />
</head>

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
                <x-name-title-student-public>Código de Estudiante</x-name-title-student-public>
                <x-date-student-public>{{ $estudiante->codigo}}</x-date-student-public>
            </div>
            @foreach ($tramosActuales as $carreraId => $tramos)
                @php
                    $carrera = $notasAgrupadas[$carreraId]['carrera'] ?? null;
                @endphp
                @if ($carrera)
                    <div>
                        <x-name-title-student-public>Carrera Cursando</x-name-title-student-public>
                        <x-date-student-public>{{ $carrera->carrera . ' - ' . $tramos['tramo']->tramos }}</x-date-student-public>
                    </div>
                @endif
            @endforeach
            <div>
                <x-name-title-student-public>Sección Actual</x-name-title-student-public>
                <x-date-student-public>
                    {{ $estudiante->secciones->seccion }}
                </x-date-student-public>
            </div>
            <div>
                <button class="calificacion-publica"><i class="fas fa-award"></i>Ver Tus Notas Académicas</button>
            </div>
        </section>
        <section class="card-logo-public">
            <x-authentication-card-logo />
        </section>
    </div>
    <div class="hidden notas-students flex justify-center items-center">
        <section class="notas w-full lg:w-[50%] mx-6">
            <h1 style="font-size: 40px; font-weight: 700; color: #4272D8;" class="font-staat">
                {{ ucwords('calificaciones académicas') }}
            </h1>
            <p class="font-inter mb-7">
                {{ ucwords('En esta sección, podrás consultar tus calificaciones correspondientes a las carreras y tramos que has cursado.') }}</p>
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
                                    <div class="materias-tabla overflow-x-auto">
                                        <div class="">
                                            <table class="w-full tabla-notas-publico">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th title="Título De La Materia">Materia</th>
                                                        <th title="Primera Nota">25%</th>
                                                        <th title="Segunda Nota">25%</th>
                                                        <th title="Trecera Nota">25%</th>
                                                        <th title="Cuarta Nota">25%</th>
                                                        <th title="Nota Extra">EXT</th>
                                                        <th title="Definitiva">DEF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tramoData['materias'] as $materiaId => $materiaData)
                                                        @php
                                                            $definitiva =
                                                                $materiaData['nota']->nota_uno +
                                                                $materiaData['nota']->nota_dos +
                                                                $materiaData['nota']->nota_tres +
                                                                $materiaData['nota']->nota_cuatro +
                                                                $materiaData['nota']->nota_extra;
                                                            $definitivaDivicion = round($definitiva / 4);
                                                        @endphp
                                                        <tr class="text-center odd:bg-gray-400/20">
                                                            <td class="min-w-[200px] font-inter">
                                                                {{ ucwords($materiaData['materia']->materia) }}
                                                            </td>
                                                            <td class="min-w-16"
                                                                title="Primera nota de la asignatura es: {{ $materiaData['nota']->nota_uno ?? 'Aún no tienes nota' }}">
                                                                {{ $materiaData['nota']->nota_uno }}</td>
                                                            <td class="min-w-16"
                                                                title="Segunda nota de la asignatura es: {{ $materiaData['nota']->nota_dos ?? 'Aún no tienes nota' }}">
                                                                {{ $materiaData['nota']->nota_dos }}</td>
                                                            <td class="min-w-16"
                                                                title="Tercera nota de la asignatura es: {{ $materiaData['nota']->nota_tres ?? 'Aún no tienes nota' }}">
                                                                {{ $materiaData['nota']->nota_tres }}</td>
                                                            <td class="min-w-16"
                                                                title="Cuarta nota de la asignatura es: {{ $materiaData['nota']->nota_cuatro ?? 'Aún no tienes nota' }}">
                                                                {{ $materiaData['nota']->nota_cuatro }}</td>
                                                            <td class="min-w-16"
                                                                title="Nota extra de la asignatura es: {{ $materiaData['nota']->nota_extra ?? 'Aún no tienes nota' }}">
                                                                {{ $materiaData['nota']->nota_extra }}</td>
                                                            <td class="min-w-16"
                                                                title="La definitiva es una suma de las calificaciones dividida entre 4">
                                                                {{ $definitivaDivicion . ' pts' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </details>
                        @endforeach
                    @endif
                </details>
            @endforeach
            <div class="flex justify-center text-xl">
                <button class="datos-publico"><i class="fas fa-user-graduate"></i>Ver Tus Datos Personales</button>
            </div>
            <div class="warni">
                <span class="war1 font-inter">Tenga en cuenta que si intenta copiar o tomar alguna foto de las notas que
                    quiere visualizar</span>
                <br>
                <span class="war2 font-inter">NO TIENEN NINGÚN VALOR ACADÉMICO LEGAL</span>
            </div>
        </section>
        <section class="card-logo-public mr-6 lg:block hidden">
            <x-authentication-card-logo />
        </section>
    </div>
    <div class="m-7">
        <p class="text-center font-inter mb-4 text-black/50">Por temas de seguridad y privacidad del y de la estudiante
            no se muestran todos los datos personales requeridos en la inscripción</p>
    </div>
    @vite(['resources/js/section-calificaciones-general-public-student.js', 'resources/js/back-cedula-public-studens.js'])
    <x-footer-original />
</body>

</html>
