<x-dashboard>
    <x-slot:titulo>Agregar Nuevo Cargo</x-slot:titulo>
    <x-title-section-admin>Agregar Nuevo Cargo</x-title-section-admin>
    <div class="mx-auto mt-4 flex flex-col justify-center items-center p-4 max-w-[35%]">
        <form action="/save-cargo/{{ $cargo->id }}" method="POST" class="w-full max-w-md mx-auto mt-6">
            @csrf
            <div>
                <header class="mt-3">Agregar Nuevo Nombre Del Cargo:</header>
                <x-input-form type="text" name="cargo" value="{{ $cargo->cargo }}" autocomplete="off"
                    placeholder="Ingrese El Nombre Del Nuevo Cargo" />
                <header class="mt-3">Seleccionar El Nuevo Tipo De Cargo:</header>
                <x-select-form name="tipo_id">
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ strtoupper($tipo->tipo) }}</option>
                    @endforeach
                </x-select-form>
            </div>
            <x-button type="button" class="float-left mt-4 bg-[#f00] hover:bg-[#b00]" onclick="history.back()" >Cancelar</x-button>
            <x-button type="submit" class="float-right mt-4" id="nombre">Guardar</x-button>
        </form>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
