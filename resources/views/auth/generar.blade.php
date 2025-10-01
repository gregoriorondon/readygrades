<x-dashboard>
    <x-slot:titulo>Generear Constancia De Estudios</x-slot:titulo>
    <x-title-section-admin>Generar Documentos</x-title-section-admin>
    <div class="min-h-[calc(100vh-21rem)] flex flex-col justify-center items-center p-4">
        <div class="w-full max-w-md mx-auto mt-6">

            <x-label>Seleccione La Consulta Que Desea Generar</x-label>
            <x-select-form name="solicitud" id="seleccionar">
                <option value="ninguno">{{ ucwords('seleccione lo que desea generar') }}</option>
                {{-- <option value="constancia">Constancia De Estudios</option> --}}
                <option value="record">Récord Académico</option>
                <option value="acta">{{ ucwords('acta de calificación final') }}</option>
            </x-select-form>

            <form action="/submit-student-cedula" method="POST" class="hidden" id="formulario">
                @csrf
                <x-label class="mt-4">Ingrese La Cédula Del Estudiante</x-label>
                <x-input-form type="number" name="cedula" placeholder="Ingrese la cédula del estudiante"
                    autocomplete="off" required :value="old('cedula')" title="Por Favor Ingrese La Cédula" />
                <x-button type="submit" form="formulario" class="float-right mt-4" id="nombre"
                    icon="fa-solid fa-magnifying-glass">Buscar</x-button>
            </form>

            <form action="/submit-student-cedula-record" method="POST" class="hidden" id="formularioDos">
                @csrf
                <x-label class="mt-4">Ingrese La Cédula Del Estudiante</x-label>
                <x-input-form type="number" name="cedula" placeholder="Ingrese la cédula del estudiante"
                    autocomplete="off" required :value="old('cedula')" title="Por Favor Ingrese La Cédula" />
                <x-button type="submit" form="formularioDos" class="float-right mt-4" id="nombre"
                    icon="fa-solid fa-magnifying-glass">Buscar</x-button>
            </form>

            <form action="{{ route('generarpdf') }}" method="POST" class="hidden" id="formularioTres">
                @csrf
                <x-label class="mt-4">Ingrese Materia</x-label>
                <x-input-form type="text" name="materia" placeholder="Ingrese la materia"
                    autocomplete="off" required :value="old('materia')" title="Por Favor Ingrese La Materia" />
                <x-button type="submit" form="formulario" class="float-right mt-4" id="nombre"
                    icon="fa-solid fa-magnifying-glass">Buscar</x-button>
            </form>

            <script>
                let form = document.getElementById('formulario');
                let formDos = document.getElementById('formularioDos');
                let formTres = document.getElementById('formularioTres');
                let select = document.getElementById('seleccionar');
                let che = document.getElementById('check');
                let name = document.getElementById('nombre');

                select.addEventListener('change', () => {
                    let valor = select.value;
                    switch (valor) {
                        case 'constancia':
                            form.classList.remove('hidden');
                            formDos.classList.add('hidden');
                            formTres.classList.add('hidden');
                            break;
                        case 'record':
                            form.classList.add('hidden');
                            formDos.classList.remove('hidden');
                            formTres.classList.add('hidden');
                            break;
                        case 'acta':
                            form.classList.add('hidden');
                            formDos.classList.add('hidden');
                            formTres.classList.remove('hidden');
                            break;
                        case 'ninguno':
                            form.classList.add('hidden');
                            formDos.classList.add('hidden');
                            break;
                    }
                });


                {{-- che.addEventListener('change', () => { --}}
                {{--     if (che.checked) { --}}
                {{--         form.removeAttribute('target'); --}}
                {{--         name.innerHTML = 'Descargar <i class="fa-solid fa-download ml-2 mr-0"></i>'; --}}
                {{--     } else { --}}
                {{--         form.setAttribute('target', '_blank'); --}}
                {{--         name.innerHTML = 'Generar <i class="fas fa-external-link ml-2 mr-0"></i>'; --}}
                {{--     } --}}
                {{-- }); --}}
            </script>
        </div>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
