<div class="grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <x-label class="after:content-['*'] after:text-red-400">Seleccione El Núcleo Académico</x-label>
        <div class="flex items-center">
            <select wire:model.live="nucleoSeleccionado" name="nucleo_id" class="font-inter mt-2 block w-full bg-transparent rounded-md border-0 px-2 py-2.5 ring-1 ring-inset ring-gray-400 focus:ring-2 outline outline-1 outline-transparent focus:ring-outline-ready focus:ring-ready">
                <option value="none" selected hidden>{{ ucwords('seleccione un núcleo') }}</option>
                @foreach ($nucleos as $n)
                    <option value="{{ $n->nucleos->id }}">{{ $n->nucleos->nucleo }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="lg:col-span-1">
        <x-label class="after:content-['*'] after:text-red-400">Seleccione La Carrera</x-label>
        <div class="flex items-center">
            <select name="carrera_id" class="font-inter mt-2 block w-full bg-transparent rounded-md border-0 px-2 py-2.5 ring-1 ring-inset ring-gray-400 focus:ring-2 outline outline-1 outline-transparent focus:ring-outline-ready focus:ring-ready" {{ empty($carreras) ? 'disabled' : '' }}>
                @if(empty($carreras))
                    <option value="none" selected disabled hidden>{{ ucwords('Primero elija un núcleo') }}</option>
                @else
                    <option value="none" selected disabled hidden>{{ ucwords('seleccione la carrera') }}</option>
                    @foreach ($carreras as $c)
                        <option value="{{ $c->carreras->id }}">{{ $c->carreras->carrera }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
