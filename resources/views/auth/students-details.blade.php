<x-dashboard>
    <x-slot:titulo>Detalles de {{ $estudiantes['primer_name'] }}</x-slot:titulo>
    <div class="flex justify-between mt-2">
        <x-button-a link="estudiantes-panel-administrativo" icon="fas fa-arrow-left">Regresar</x-button-a>
            <div class="mx-auto">
                @if ($estudiantes->genero !== 'masculino')
                    <x-title-section-admin>Información De La Estudiante
                        {{ implode(' ', [$estudiantes['primer_name'], $estudiantes['primer_apellido']]) }}</x-title-section-admin>
                @else
                    <x-title-section-admin>Información Del Estudiante
                        {{ implode(' ', [$estudiantes['primer_name'], $estudiantes['primer_apellido']]) }}</x-title-section-admin>
                @endif
            </div>
            <x-button-a link="student-edit/{{ $estudiantes->id }}" icon="fas fa-edit">Editar Datos</x-button-a>
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
                    <x-details-dt>Fecha de Nacimiento:</x-details-dt>
                    <x-details-dd>{{ $estudiantes['fecha_nacimiento'] }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Genero:</x-details-dt>
                    <x-details-dd>{{ ucfirst(strtolower($estudiantes['genero'])) }}</x-details-dd>
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
                    <x-details-dt>Núcleo de Estudios:</x-details-dt>
                    <x-details-dd>{{ $estudiantes->nucleos->nucleo }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Carrera:</x-details-dt>
                    <x-details-dd>{{ $estudiantes->carreras->carrera }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Trayecto y Tramo:</x-details-dt>
                    <x-details-dd>
                        @foreach ($estudiantes->tramos->trayectos as $trayectos)
                            {{ $trayectos->trayectos }}
                        @endforeach
                        - {{ $estudiantes->tramos->tramos }}
                    </x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Sección:</x-details-dt>
                    <x-details-dd>{{ $estudiantes->secciones->seccion }}</x-details-dd>
                </x-details-div>
                <x-details-div>
                    <x-details-dt>Notas - Calificaciones:</x-details-dt>
                    <x-details-dd>
                        @if ($estudiantes->genero !== 'masculino')
                            <a href="/estudiantes-calificacion/{{ $estudiantes->id }}"
                                class="flex items-center px-1 hover:bg-gray-400/20 transition-all rounded-lg w-fit">
                                <i class="fa-solid fa-award text-xl"></i>
                                Ver o Gestionar Notas - Calificaciones De La Estudiante
                            </a>
                        @else
                            <a href="/estudiantes-calificacion/{{ $estudiantes->id }}"
                                class="flex items-center px-1 hover:bg-gray-400/20 transition-all rounded-lg w-fit">
                                <i class="fa-solid fa-award text-xl"></i>
                                Ver o Gestionar Notas - Calificaciones Del Estudiante
                            </a>
                        @endif
                    </x-details-dd>
                </x-details-div>
            </dl>
        </div>

    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
