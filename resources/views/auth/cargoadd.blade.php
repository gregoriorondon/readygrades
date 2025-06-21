<x-dashboard>
    <x-slot:titulo>Agregar Nuevo Cargo</x-slot:titulo>
    <x-title-section-admin>Agregar Nuevo Cargo</x-title-section-admin>
    <div class="mx-auto min-h-[calc(100vh-21rem)] flex flex-col justify-center items-center p-4 max-w-[35%]">
        <form action="{{ route('crearcargo') }}" method="POST" class="w-full max-w-md mx-auto mt-6">
            @csrf
            <div>
                <header class="mt-3">Agregar Nombre Del Cargo:</header>
                <x-input-form type="text" name="cargo" :value="old('cargo')" autocomplete="off"
                    placeholder="Ingrese El Nombre Del Nuevo Cargo" />
                <header class="mt-3">Seleccionar El Tipo De Cargo:</header>
                <x-select-form name="tipo_id">
                    @foreach ($tipo as $tipos)
                        <option value="{{ $tipos->id }}">{{ strtoupper($tipos->tipo) }}</option>
                    @endforeach
                </x-select-form>
            </div>
            <x-button type="submit" class="float-right mt-4" id="nombre">Crear <i
                    class="fa-solid fa-plus mr-0 ml-2"></i></x-button>
        </form>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
