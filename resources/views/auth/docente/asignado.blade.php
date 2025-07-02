<x-dashboard>
    <x-slot:titulo>Asignaciones</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('asignaciones a su cargo') }}</x-title-section-admin>

    <div class=" border rounded-lg mt-9">
        @foreach ($agrupadas as $carrera)
            <div class="">
                <div class="">
                    <div class="">
                        <details>
                            <summary
                                class="hover:bg-gray-400/40 rounded-t-lg rounded-b-lg py-4 pl-8 text-2xl font-inter font-bold cursor-pointer">
                                {{ $carrera['carrera'] }}</summary>
                            @foreach ($carrera['tramos'] as $tramo)
                                <details>
                                    <summary
                                        class="bg-gray-400/10 hover:bg-gray-400/20 text-xl pl-12 py-4 font-inter font-semibold cursor-pointer">
                                        {{ $tramo['nombre'] }}</summary>
                                    @foreach ($tramo['asignaciones'] as $asignacion)
                                        <details>
                                            <summary
                                                class="hover:bg-gray-400/20 font-inter pl-16 text-2xl font-medium py-2 cursor-pointer">
                                                {{ ucwords($asignacion->pensums->materias->materia) . ':' }}
                                            </summary>
                                            <div class="flex justify-center mx-8 mb-9">
                                                <div class="border rounded-lg w-full">
                                                    <table class="min-w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="px-9 py-3">Materia</th>
                                                                <th class="px-9 py-3">Sección</th>
                                                                <th class="px-9 py-3">Estudiante</th>
                                                                <th class="px-9 py-3">Cédula</th>
                                                                <th class="px-9 py-3">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($asignacion->students as $estudiante)
                                                                <tr class="odd:bg-gray-400/20 border-t">
                                                                    <td class="px-9 py-3 text-center">
                                                                        {{ $asignacion->pensums->materias->materia }}
                                                                    </td>
                                                                    <td class="px-9 py-3 text-center">
                                                                        {{ $asignacion->secciones->seccion }}
                                                                    </td>
                                                                    <td class="px-9 py-3 text-center">
                                                                        {{ $estudiante->primer_name . ' ' . $estudiante->primer_apellido }}
                                                                    </td>
                                                                    <td class="px-9 py-3 text-center">
                                                                        {{ $estudiante->cedula }}
                                                                    </td>
                                                                    <td
                                                                        class="px-9 py-3 text-center flex justify-center items-center">
                                                                        <x-select-form name="" id=""
                                                                            class="!w-fit !mt-0">
                                                                            @for ($j = 0; $j <= 20; $j++)
                                                                                <option value="{{ $j }}">
                                                                                    {{ $j }}</option>
                                                                            @endfor
                                                                        </x-select-form>
                                                                        <button type="submit"
                                                                            class="p-2 ml-2 hover:bg-gray-400/20 rounded-lg"
                                                                            title="Cailifcar Definitiva">
                                                                            <i class="fa-solid fa-award"></i> Calificar
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr class="odd:bg-gray-400/20">
                                                                    <td colspan="5" class="px-9 py-3 text-center">
                                                                        Ningún estudiante asignado
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="flex justify-end mb-8 mr-8">
                                                <form action="/pdfcalificacion" method="post">
                                                    @csrf
                                                    <input type="text" hidden name="carrera"
                                                        value="{{ $carrera['carrera'] }}">
                                                    <input type="text" hidden name="tramo"
                                                        value="{{ $tramo['nombre'] }}">
                                                    <input type="text" hidden name="asignatura"
                                                        value="{{ $asignacion->pensums->materias->materia }}">
                                                    <input type="text" hidden name="codigoasig"
                                                        value="{{ $asignacion->pensums->materias->codigo }}">
                                                    @foreach ($asignacion->students as $estudiante)
                                                        <input type="text" hidden name="primernombre[]"
                                                            value="{{ $estudiante->primer_name }}">
                                                        <input type="text" hidden name="segundonombre[]"
                                                            value="{{ $estudiante->segundo_name }}">
                                                        <input type="text" hidden name="primerapellido[]"
                                                            value="{{ $estudiante->primer_apellido }}">
                                                        <input type="text" hidden name="segundoapellido[]"
                                                            value="{{ $estudiante->segundo_apellido }}">
                                                        <input type="text" hidden name="cedula[]"
                                                            value="{{ $estudiante->cedula }}">
                                                    @endforeach
                                                    <x-label><x-input-check
                                                            type="checkbox" name="rellenardatos" />{{ ucwords('llenar información básica + calificaciones automáticamente') }}</x-label>
                                                    <div class="flex justify-end mt-8">
                                                        <x-button type="submit" icon="fa-solid fa-download">Descargar
                                                            Acta</x-button>
                                                    </div>
                                                </form>
                                            </div>

                                        </details>
                                    @endforeach
                                </details>
                            @endforeach
                        </details>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
