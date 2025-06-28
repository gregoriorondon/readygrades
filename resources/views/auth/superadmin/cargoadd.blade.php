<x-dashboard>
    <x-slot:titulo>Agregar Nuevo Cargo</x-slot:titulo>
    <x-title-section-admin>Agregar Nuevo Cargo</x-title-section-admin>
    <div class="mx-auto mt-4 flex flex-col justify-center items-center p-4 max-w-[35%]">
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
    <div class="flex justify-center">
    <div class="border rounded-lg w-fit">
        <table>
            <thead>
                <tr class="bg-gray-400/20">
                    <th class="p-2 px-9">Cargo</th>
                    <th class="p-2 px-9">Tipo De Cargo</th>
                    <th class="p-2 px-9">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cargo as $cargos)
                    <tr class="odd:bg-gray-400/20 border-t">
                        @if($cargos->tipos->tipo !== 'superadmin')
                            <th class="p-2 font-inter font-normal">{{ $cargos->cargo }}</th>
                            <th class="p-2 font-inter font-normal">{{ ucwords($cargos->tipos->tipo) }}</th>
                            <th class="p-2 font-inter font-normal">
                                <a href="/edit-cargo/{{ $cargos->id }}" class="p-1 hover:bg-gray-400/20 rounded-lg transition-all">
                                    <i class="fa fa-edit"></i>
                                    Editar Cargo
                                </a>
                            </th>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div></div>
    <x-error-and-correct-dialog />
</x-dashboard>
