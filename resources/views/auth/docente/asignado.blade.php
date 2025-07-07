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
                                                                        {{ ucwords($asignacion->pensums->materias->materia) }}
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
                                                                        <a href="/calificacion/{{ $asignacion->id }}/estudiante/{{ $estudiante->id }}"
                                                                            class="p-2 ml-2 hover:bg-gray-400/20 rounded-lg"
                                                                            title="Cailifcar Estudiante">
                                                                            <i class="fa-solid fa-award"></i> Calificar
                                                                        </a>
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
                                                <form action="/pdfcalificacion" method="post"
                                                    id="pdfcalificacion-{{ $asignacion->id }}">
                                                    @csrf
                                                    <input type="text" hidden name="pensum_id"
                                                        value="{{ $asignacion->pensums->id }}">
                                                    <input type="text" hidden name="carrera"
                                                        value="{{ $asignacion->pensums->carreras->carrera }}">
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
                                                    <div class="flex justify-end mt-8">
                                                        <x-button type="button" id="abrirmodal-{{ $asignacion->id }}"
                                                            icon="fa-solid fa-download">Descargar
                                                            Acta</x-button>
                                                    </div>
                                                    <!-- ===================================================== -->
                                                    <!-- ============ VENTANA MODAL PARA AULA ======= -->
                                                    <!-- ===================================================== -->

                                                    <x-dialog-modal-multiple class="transition-all"
                                                        form="pdfcalificacion-{{ $asignacion->id }}"
                                                        id="modal-{{ $asignacion->id }}">
                                                        <x-slot:title>
                                                            {{ ucwords(trim('ingresar el aula donde se impartieron las clases')) }}
                                                        </x-slot:title>
                                                        <x-slot:content>
                                                            <x-span>{{ ucwords(trim('ingrese el nombre del aula en el que inpartió las actividades.')) }}</x-span>
                                                            <br>
                                                            <x-span
                                                                class="text-gray-400/50">{{ ucwords(trim('en el caso de no tener un aula específica puede dejar en blanco y proseguir con la descarga.')) }}</x-span>
                                                            <x-input-form class="bg-transparent mt-2" type="text"
                                                                name="aula"
                                                                placeholder="{{ ucwords(trim('ingrese el aula')) }}"
                                                                autocomplete="off" />
                                                        </x-slot:content>
                                                        <x-slot:botones>
                                                            Generar PDF
                                                        </x-slot:botones>
                                                    </x-dialog-modal-multiple>
                                                    @vite(['resources/js/modalesmultiples.js'])
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
