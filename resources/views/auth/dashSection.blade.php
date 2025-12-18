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
            @cannot('profesor')
                @if (!$activo)
                    <div class="py-12 px-7 bg-footer text-white mb-4 rounded-lg font-inter">
                        <p class="text-3xl mb-3">
                            {{ ucwords('hemos visto que no hay un periodo activo en su núcleo académico') }}
                        </p>
                        <a href="/periodos" class="mr-1 hover:mr-2 underline">{{ ucwords('ir a crear un nuevo periódo') }}</a><i class="fal fa-arrow-right"></i>
                    </div>
                @endif
                <div class="overflow-hidden border border-gray-400 rounded-lg">
                    <x-list-adminis />
                </div>
                <center>
                    <x-button-a class="mt-7" link="datos-estudiantes" icon="fa-solid fa-filter-list">
                        Ver y descargar datos
                    </x-button-a>
                </center>
            @endcannot
            @can('profesor')
                <div class="overflow-hidden border border-gray-400 sm:rounded-lg">
                    <x-docente.welcome />
                </div>
            @endcan
        </div>
    </div>
</x-dashboard>
