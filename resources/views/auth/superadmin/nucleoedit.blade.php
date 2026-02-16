<x-dashboard>
    <x-slot:titulo>Núcleos</x-slot:titulo>
    <x-title-section-admin>Editar El Núcleo {{ ucfirst($nucleo->nucleo) }}</x-title-section-admin>
    <x-error-and-correct-dialog />
    <div>
        <div class="flex justify-center">
            <div class="px-8 border rounded-lg w-[50%]">
                <form action="/save-nucleo/{{$nucleo->id}}" method="post">
                    @csrf
                    <x-label class="select-none mt-7" for="nucleo">Nombre Del Núcleo:</x-label>
                    <x-input-form value="{{ ucfirst($nucleo->nucleo), 'UTF-8' }}" id="nucleo" name="nucleo" autocomplete="off" placeholder="Coloque el nuevo nombre del núcleo" />
                    @foreach ($carreras as $carrera)
                        <div class="flex items-center my-4">
                            <x-input-check type="checkbox" name="carrera[]" value="{{ $carrera->id }}" id="carrera_{{ $carrera->id }}" />
                            <x-label class="select-none" for="carrera_{{ $carrera->id }}">{{ $carrera->carrera }}</x-label>
                        </div>
                    @endforeach
                    <div class="text-center py-2 flex justify-between mb-7">
                        <x-button type="button" class="bg-[#f00] hover:bg-[#b00] transition-all" onclick="history.back()">Cancelar</x-button>
                        <x-button type="submit">Guardar Cambios</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard>
