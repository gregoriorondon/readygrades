<x-dashboard>
    <x-slot:titulo>Estidiantes</x-slot:titulo>
    <x-button-a class="btn-new-student" link="registro-estudiante" icon="fa-solid fa-plus-large">
        Registrar Nuevo Estudiante
    </x-button-a>

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
