<x-dashboard>
    <x-slot:titulo>Trayectos Y Tramos</x-slot:titulo>
    <ul class="rounded-lg border border-gray-200 divide-y divide-gray-200 max-w-lg m-auto">
        @foreach($trayectos as $trayecto)
            <li class="px-6 py-4">
                <div class="flex justify-between">
                    <span class="font-bold font-inter text-lg">{{ $trayecto->trayectos }}</span>
                    <span class="font-inter text-gray-500 text-xs">Fecha de creación: {{ $trayecto->created_at}}</span>
                </div>
                @foreach($trayecto->tramos as $tramo)
                    <p class="font-inter text-gray-700">{{ $tramo->tramos }}</p>
                @endforeach
            </li>
        @endforeach
    </ul>
    <div class="flex">
        <x-button type="button" class="m-auto mt-3" id="abrirmodal">Agregar un Nuevo Trayecto con Nuevos Tramos <i class="fa-solid fa-arrow-right ml-3 text-lg"></i> </x-button>
    </div>
    <dialog id="modal">
        <form action="/crear-trayecto-y-tramos" method="post">
            @csrf
            <i id="cerrarmodal" class="fa-solid fa-xmark-large m-0 text-md bg-[#f00] hover:bg-[#b00] p-1 rounded-sm cursor-pointer float-right"></i>
            <x-label>Ingrese Cuantos Trayectos Nuevos Quieres Agregar</x-label>
            <x-span class="font-inter pr-1 pl-1 text-red-700 bg-yellow-300 rounded-sm">(Tener en cuenta que cada nuevo trayecto se crean 3 tramos nuevos) </x-span>
            <x-input class="bg-transparent" type="number" name="trayectos" min="1" placeholder="Ingrese La Cantidad De Trayectos Que Desea Crear (Sólo Números)" required />
                <div class="mt-3 flex justify-between font-inter">
                    <x-button type="button" class="bg-[#f00] hover:bg-[#b00]" id="cerrarmodal">Cancelar</x-button>
                    <x-button type="submit">Crear Nuevo Trayecto Y Tramos</x-button>
                </div>
        </form>
    </dialog>
    @vite(['resources/js/modales.js'])
</x-dashboard>
