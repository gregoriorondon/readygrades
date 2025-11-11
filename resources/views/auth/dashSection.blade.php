<x-dashboard>
    <x-slot:titulo>Dashboard</x-slot:titulo>
    <x-title-section-admin>
        @cannot('profesor')
            @if ($user->genero === 'masculino')
                Bienvenido {{ $user['primer-name'] . ' ' . $user['primer-apellido'] }}
            @else
                Bienvenida {{ $user['primer-name'] . ' ' . $user['primer-apellido'] }}
            @endif
            al Panel Principal
        @endcannot
        @can('profesor')
            @if ($user->genero === 'masculino')
                Bienvenido Profesor {{ $user['primer-name'] . ' ' . $user['primer-apellido'] }}
            @else
                Bienvenida Profesora {{ $user['primer-name'] . ' ' . $user['primer-apellido'] }}
            @endif
        @endcan
    </x-title-section-admin>
    <div class="py-4">
        <div class="mx-auto">
        @isset($activo)
            @if ($activo->activo !== null && $activo->activo !== false)
                    @cannot('profesor')
                        <div class="overflow-hidden border border-gray-400 sm:rounded-lg">
                            <x-list-adminis :carreras="$carreras" :estudiantes="$estudiantes" :nucleos="$nucleos" />
                        </div>
                            <center>
                                <x-button-a class="mt-7" link="#" icon="fa-solid fa-filter-list">
                                    Ver mas detalles
                                </x-button-a>
                            </center>
                    @endcannot
                    @can('profesor')
                        <div class="overflow-hidden border border-gray-400 sm:rounded-lg">
                            <x-docente.welcome />
                        </div>
                    @endcan
            @else
                <h1>{{ ucwords('no existe periodo anterior o existente en el sistema') }}</h1>
            @endif
        @else
                <center>
                    <h1 class="mt-20 select-none font-inter text-5xl text-gray-500/40">{{ ucwords('No existe periodo activo dentro del sistema para generar un resumen de datos') }}</h1>
                </center>
        @endisset
        </div>
    </div>
</x-dashboard>
