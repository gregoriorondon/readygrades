<x-dashboard>
    <x-slot:titulo>Nuevo Plan De Estudios</x-slot:titulo>
    <x-title-section-admin>Registro De Nuevo Plan De Estudios</x-title-section-admin>
    <x-error-and-correct-dialog />
    <form action="/pensums" method="POST" id="planForm" class="carreraform">
        @csrf
        <div class="space-y-12 p-[21px]">
            <div class="border-gray-900/10 pb-12">
                <p class="mt-7 text-xl font-inter text-gray-400">Rellene todas las casillas para registrar al nuevo
                    plan de estudios</p>

                <div class="border-gray-900/10 pb-12">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <div class="mt-2">
                                <x-label>Seleccione La Materia</x-label>
                                <x-select-form class="" name="tramo_trayecto_id" id="tramoSelect">
                                    @foreach ($trayecto as $trayectos)
                                        <optgroup label="{{ $trayectos->trayectos }}">
                                            @foreach ($trayectos->tramos as $tramos)
                                                <option value="{{ $tramos->id }}">{{ $tramos->tramos }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </x-select-form>
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <div class="mt-2">
                                <x-label>Seleccione La Carrera</x-label>
                                <x-select-form name="carrera_id" id="carreraSelect">
                                    @foreach ($carrera as $carreras)
                                        <option value="{{ $carreras->id }}">{{ $carreras->carrera }}</option>
                                    @endforeach
                                </x-select-form>

                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <div class="mt-2" id="materiasContainer">
                                <x-label>Seleccione Las Materias</x-label>
                                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4" id="materiasList">
                                    <x-button class="btn-new-student" type="button" id="abrirmodal"
                                        icon="fa-solid fa-plus-large">Seleccionar Materias</x-button>
                                    <dialog class="transition-all" id="modal">
                                        <i id="cerrarmodal"
                                            class="fa-solid fa-xmark-large m-0 text-md bg-[#f00] hover:bg-[#b00] text-[#fff] p-1 rounded-sm cursor-pointer float-right"></i>
                                        <div class="text-xl text-center font-bold font-inter text-gray-700">
                                            Seleccione Las Materias Que Deseas Agregar
                                        </div>
                                        <div class="mt-4 text-sm text-gray-700 font-inter">
                                            <x-input-form type="text" name="searchmateria"
                                                placeholder="Buscar Materia" />
                                            <div class="border rounded-md mt-2" style="border-color: var(--text);">
                                                <table class="w-full">
                                                    <thead class="sticky top-0 bg-gray-100/20">
                                                        <tr>
                                                            <th class="py-3 font-inter font-normal text-left pl-4">
                                                                Nombre</th>
                                                            <th class="py-3 font-inter font-normal text-center">Código
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($materias as $materia)
                                                            <tr class="odd:bg-gray-300/10 border-t">
                                                                <td class="">
                                                                    <div class="flex items-center">
                                                                        <x-label
                                                                            class="py-3 pl-4 cursor-pointer select-none">
                                                                            <x-input-check type="checkbox"
                                                                                name="materias[]"
                                                                                value="{{ $materia->id }}"
                                                                                class="mr-3 accent-blue-700" />
                                                                            {{ $materia->materia }}
                                                                        </x-label>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center font-mono text-sm">
                                                                    {{ $materia->codigo }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="font-inter flex justify-end mt-3">
                                            <x-button id="cerrarmodal" type="button">Aceptar</x-button>
                                        </div>
                                    </dialog>
                                    {{-- @vite(['resources/js/autocompletado-carrera.js']) --}}
                                    @vite(['resources/js/modales.js'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <x-button type="submit">Guardar Plan</x-button>
                </div>
            </div>
    </form>
</x-dashboard>
