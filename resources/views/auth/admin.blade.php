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
            <div class="overflow-hidden border border-gray-400 sm:rounded-lg">
                @can('root')
                    <x-list-adminis :carreras="$carreras" :estudiantes="$estudiantes" :nucleos="$nucleos" />
                @endcan
                @can('adminis')
                    <x-list-adminis :carreras="$carreras" :estudiantes="$estudiantes" :nucleos="$nucleos" />
                @endcan
                @can('profesor')
                    <x-docente.welcome />
                @endcan
            </div>
        </div>
    </div>
</x-dashboard>
