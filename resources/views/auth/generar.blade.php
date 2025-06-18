<x-dashboard>
    <x-slot:titulo>Generear Constancia De Estudios</x-slot:titulo>
    <x-title-section-admin>Generar Documentos</x-title-section-admin>
    <div class="min-h-[calc(100vh-21rem)] flex flex-col justify-center items-center p-4">
    <form action="{{ route('generarpdf') }}" method="POST" class="w-full max-w-md mx-auto mt-6" id="formulario" target="_blank">
        @csrf
        <div class="">
        <x-label>Ingrece La Cédula Del Estudiante</x-label>
        <x-input-form type="number" name="cedula" placeholder="Ingrese la cédula del estudiante" autocomplete="off" required :value="old('cedula')" />
        <x-input-error name="cedula" />
        <x-label class="mt-4">Seleccione La Consulta Que Desea Generar</x-label>
        <x-select-form name="solicitud">
            <option value="record">Record de Notas</option>
            <option value="constancia">Constancia de Estudios</option>
        </x-select-form>
        <label class="flex mt-3 select-none"><x-input type="checkbox" id="check" name="descargar" class="!w-4 !mt-0 mr-1 accent-blue-700" />Descargar Automáticamente</label>
        <x-button type="submit" class="float-right mt-4" id="nombre">Generar <i class="fas fa-external-link ml-2 mr-0"></i></x-button>
        </div>
        @if(session('alert'))
            <script>
                alert("{{ session('alert') }}");
            </script>
        @endif
    </form>
    <script>
        let form = document.getElementById('formulario');
        let che = document.getElementById('check');
        let name = document.getElementById('nombre');
        che.addEventListener('change', () => {
            if (che.checked) {
                form.removeAttribute('target');
                name.innerHTML = 'Descargar <i class="fa-solid fa-download ml-2 mr-0"></i>';
            } else {
                form.setAttribute('target', '_blank');
                name.innerHTML = 'Generar <i class="fas fa-external-link ml-2 mr-0"></i>';
            }
        });
    </script>
    </div>
</x-dashboard>
