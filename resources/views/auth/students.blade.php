<x-dashboard>
    <x-slot:titulo>Estidiantes</x-slot:titulo>
    @if (!is_null($activo))
    <div class="flex justify-between">
        <x-button-a class="btn-new-student" route="students.create" icon="fa-solid fa-plus-large">
            Registrar Estudiante
        </x-button-a>
        @if($estado === null)
            <x-button class="btn-new-student" type="submit" icon="fas fa-lock-open" form="inscripcion">
                Abrir Inscripciones
            </x-button>
        @else
            @if ($estado->estado === 0)
                <x-button class="btn-new-student" type="submit" icon="fas fa-lock-open" form="inscripcion">
                    Abrir Inscripciones
                </x-button>
            @else
                <x-button class="btn-new-student" type="submit" icon="fas fa-lock-open" form="inscripcion">
                    Cerrar Inscripciones
                </x-button>
            @endif
        @endif
    </div>
        @if($estado === null)
            <form action="{{ route('students.preinscripciones') }}" method="post" id="inscripcion">
                @csrf
                <input type="hidden" name="estado" value="{{ encrypt('abrir') }}">
            </form>
        @else
            @if ($estado->estado === 0)
                <form action="{{ route('students.preinscripciones') }}" method="post" id="inscripcion">
                    @csrf
                    <input type="hidden" name="estado" value="{{ encrypt('abrir') }}">
                </form>
            @else
                <form action="{{ route('students.preinscripciones') }}" method="post" id="inscripcion">
                    @csrf
                    <input type="hidden" name="estado" value="{{ encrypt('cerrar') }}">
                </form>
            @endif
        @endif
    @else
    <div class="flex justify-between">
        <x-button class="btn-new-student" type="button" disabled icon="fa-solid fa-plus-large">
            Registrar Estudiante
        </x-button>
        @if($estado === null)
            <x-button class="btn-new-student" type="button" disabled icon="fas fa-lock-open" form="inscripcion">
                Abrir Inscripciones
            </x-button>
        @else
            @if ($estado->estado === 0)
                <x-button class="btn-new-student" type="button" disabled icon="fas fa-lock-open" form="inscripcion">
                    Abrir Inscripciones
                </x-button>
            @else
                <x-button class="btn-new-student" type="button" disabled icon="fas fa-lock-open" form="inscripcion">
                    Cerrar Inscripciones
                </x-button>
            @endif
        @endif
    </div>
    @endif


    <livewire:loadingstudents lazy />
    <style>
        .loadcenter {
            margin-top: 20vh;
        }

        .loader {
            display: block;
            width: 30%;
            height: 4px;
            border-radius: 30px;
            background-color: rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .loader::before {
            content: "";
            position: absolute;
            background: #0071e2;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            border-radius: 30px;
            animation: moving 1s ease-in-out infinite;
            ;
        }

        @keyframes moving {
            50% {
                width: 100%;
            }

            100% {
                width: 0;
                right: 0;
                left: unset;
            }
        }
    </style>

</x-dashboard>
