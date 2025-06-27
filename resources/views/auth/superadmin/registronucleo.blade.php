<x-dashboard>
    <x-slot:titulo>Núcleos</x-slot:titulo>
    <x-title-section-admin>Núcleos</x-title-section-admin>
    <ul class="rounded-lg border border-gray-200 divide-y divide-gray-200 max-w-lg m-auto">
        @foreach($nucleos as $nucleo)
            <li class="px-6 py-4">
                <div class="flex justify-between">
                    <span class="font-bold font-inter text-lg">{{ $nucleo->nucleo }}</span>
                    <span class="font-inter text-gray-500 text-xs mt-auto mb-auto">Fecha de creación: {{ $nucleo->created_at}}</span>
                    <span class="text-gray-500 text-lg mt-auto mb-auto" title="Editar Nombre"><a class="p-1" href="/edit-nucleo/{{ $nucleo->id}}"><i class="fa-solid fa-pen-to-square m-0"></i></a></span>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="flex">
        <x-button type="button" class="m-auto mt-3" id="abrirmodal">Agregar Un Nuevo Núcleo Al Sistema <i class="fa-solid fa-arrow-right ml-3 text-lg"></i> </x-button>
    </div>
    <dialog id="modal" class="max-w-[500px]">
        <form action="/crear-nucleo" method="post">
            @csrf
            <i id="cerrarmodal" class="fa-solid fa-xmark-large m-0 text-md bg-[#f00] hover:bg-[#b00] p-1 rounded-sm cursor-pointer float-right"></i>
            <x-label class="text-center">Ingrese El Nombre De La Ciudad, Pueblo o Sector Del Nuevo Núcleo</x-label>
            <x-input class="bg-transparent" id="autocomplete" type="text" name="nucleo" placeholder="Ejemplo: El Dividive" autocomplete="off" required />
            <div id="suggestions" class="pl-2 mt-2"></div>
                <div class="mt-3 flex justify-between font-inter">
                    <x-button type="button" class="bg-[#f00] hover:bg-[#b00]" id="cerrarmodal">Cancelar</x-button>
                    <x-button type="submit">Crear Nuevo Núcleo</x-button>
                </div>
        </form>
    </dialog>
<x-error-and-correct-dialog />
@vite(['resources/js/autocompletado-nucleos.js'])
@vite(['resources/js/modales.js'])
</x-dashboard>

