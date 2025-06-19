<x-dashboard>
    <x-slot:titulo>Agregar Nuevo Cargo</x-slot:titulo>
    <x-title-section-admin>Agregar Nuevo Cargo</x-title-section-admin>
    <div class="mx-auto min-h-[calc(100vh-21rem)] flex flex-col justify-center items-center p-4 max-w-[35%]">
        <form action="{{ route('crearcargo') }}" method="POST" class="w-full max-w-md mx-auto mt-6">
            @csrf
            <div class="" id="cargo_agregar">
                <header class="mt-3">Agregar Nombre Del Cargo:</header>
                <x-input-form type="text" name="cargo" autocomplete="off"
                    placeholder="Ingrese El Nombre Del Nuevo Cargo" />
                <header class="mt-3">Seleccionar El Tipo De Cargo:</header>
                <x-select-form name="tipo_id">
                    @foreach ($tipo as $tipos)
                        <option value="{{ $tipos->id }}">{{ $tipos->tipo }}</option>
                    @endforeach
                </x-select-form>
            </div>
            <!-- APARECER SI VA A CREA UN TIPO NUEVO DE CARGO --->
            <div class="mb-4">
                <label class="flex mt-3 select-none">
                    <x-input type="checkbox" id="toggle_nuevo_tipo" name="check"
                        class="!w-4 !mt-0 mr-2 accent-blue-700" />
                    Crear Un Nuevo Tipo De Cargo
                </label>
            </div>
            <div id="nuevo_tipo_container" class="mb-4 hidden">
                <label for="nuevo_tipo" class="block mb-2">Escribe El Nuevo Tipo De Cargo:</label>
                <x-input-form type="text" name="tipo" id="nuevo_tipo" class="w-full p-2 border rounded"
                    autocomplete="off" placeholder="Ejemplo: Profesor o Administrador" />
            </div>
            <x-button type="submit" class="float-right mt-4" id="nombre">Crear <i
                    class="fa-solid fa-plus mr-0 ml-2"></i></x-button>
        </form>
        <script>
            document.getElementById('toggle_nuevo_tipo').addEventListener('change', function() {
                const nuevoTipoContainer = document.getElementById('nuevo_tipo_container');
                const hiddenAgregar = document.getElementById('cargo_agregar');

                if (this.checked) {
                    nuevoTipoContainer.classList.remove('hidden');
                    hiddenAgregar.classList.add('hidden');
                } else {
                    nuevoTipoContainer.classList.add('hidden');
                    hiddenAgregar.classList.remove('hidden');
                }
            });
        </script>
    </div>
    @if (!$errors->all())
        <x-dialog-modal-correct class="transition-all">
            <x-slot:botones>
                Cerrar
            </x-slot:botones>
        </x-dialog-modal-correct>
    @else
        <x-dialog-modal-errors class="transition-all">
            <x-slot:botones>
                Cerrar
            </x-slot:botones>
        </x-dialog-modal-errors>
    @endif
</x-dashboard>
