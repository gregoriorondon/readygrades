<title>Detalles de {{ $estudiante['primer_name'] }}</title>
<x-import />
<body class="cuerpo">
    <x-nav-student-public>
        <x-slot:usuario>{{ implode(' ', [$estudiante['primer_name'], $estudiante['primer_apellido'] ]) }}</x-slot:usuario>
    </x-nav-student-public>
    <div class="data-public-student-details items-center">
        <section class="personal-data">
            <div>
                <x-name-title-student-public>Nombre Completo</x-name-title-student-public>
                <x-date-student-public>{{ implode(' ', [$estudiante['primer_name'], $estudiante['segundo_name'] ])}}</x-date-student-public>
            </div>
            <div>
                <x-name-title-student-public>Apellido Completo</x-name-title-student-public>
                <x-date-student-public>{{ implode(' ', [$estudiante['primer_apellido'], $estudiante['segundo_apellido'] ])}}</x-date-student-public>
            </div>
            <div>
                <x-name-title-student-public>Género y Nacionalidad</x-name-title-student-public>
                <x-date-student-public>{{ ucfirst($estudiante->genero) }}
                @if($estudiante['genero'] === 'masculino')
                    @if($estudiante['nacionalidad']==='VE')
                        Venezolano
                    @else
                        Extrangero
                    @endif
                @else
                    @if($estudiante['nacionalidad']==='VE')
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
                        @foreach($estudiante->tramos->trayectos as $trayectos)
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
    <div class="m-7">
        <p class="text-center font-inter mb-4 text-black/50">Por temas de seguridad y privacidad del y de la estudiante no se muestran todos los datos personales requeridos en la inscripción</p>
    </div>
    <x-footer />
</body>
