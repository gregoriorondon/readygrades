<title>Detalles de {{ $estudiante['primer-name'] }}</title>
<x-import />
<body class="cuerpo">
    <x-nav-student-public>
        <x-slot:usuario>{{ implode(' ', [$estudiante['primer-name'], $estudiante['primer-apellido'] ]) }}</x-slot:usuario>
    </x-nav-student-public>
    <div>
        <div>
            <x-name-title-student-public>Nombre Completo</x-name-title-student-public>
            <x-date-student-public>{{ implode(' ', [$estudiante['primer-name'], $estudiante['segundo-name'] ])}}</x-date-student-public>
        </div>
        <div>
            <x-name-title-student-public>Apellido Completo</x-name-title-student-public>
            <x-date-student-public>{{ implode(' ', [$estudiante['primer-apellido'], $estudiante['segundo-apellido'] ])}}</x-date-student-public>
        </div>
        <div>
            <x-name-title-student-public>Genero y Nacionalidad</x-name-title-student-public>
            <x-date-student-public>
            @if($estudiante['genero'] === 'masculino')
                Masculino
                @if($estudiante['nacionalidad']==='VE')
                    Venezolano
                @else
                    Extrangero
                @endif
            @else
                Femenino
                @if($estudiante['nacionalidad']==='VE')
                    Venezolana
                @else
                    Extrangera
                @endif
            @endif
            </x-date-student-public>
        </div>
        <div>
            <x-name-title-student-public>Carrera Cursando</x-name-title-student-public>
            <x-date-student-public>{{ $estudiante['carrera'] }}</x-date-student-public>
        </div>
        <div>
            <x-name-title-student-public>Trayecto y Tramo Actual</x-name-title-student-public>
            <x-date-student-public>{{ $estudiante['trayecto'] }}</x-date-student-public>
        </div>
    </div>
    <x-footer />
</body>
