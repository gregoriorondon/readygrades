<x-dashboard>
    <x-slot:titulo>Asignaciones</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('asignaciones a su cargo') }}</x-title-section-admin>
    @foreach ($profesorAsignacion as $asignacion)
        <div class="text-center mt-9">
            <p class="font-inter text-2xl font-medium">{{ ucwords($asignacion->pensums->materias->materia) . ' - ' . $asignacion->pensums->tramotrayecto->tramos->tramos . ':' }}</p>
            <div class="flex justify-center">
                <div class="border rounded-lg">
                    <table>
                        <thead>
                            <tr>
                                <th class="px-9 py-3">Tramos</th>
                                <th class="px-9 py-3">Materias</th>
                                <th class="px-9 py-3">Secciones</th>
                                <th class="px-9 py-3">Estudiantes</th>
                                <th class="px-9 py-3">Cédula</th>
                                <th class="px-9 py-3">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($asignacion->students as $estudiante)
                                <tr class="odd:bg-gray-400/20 border-t">
                                    <td class="px-9 py-3 text-center">
                                        {{ $asignacion->pensums->tramotrayecto->tramos->tramos }}
                                    </td>
                                    <td class="px-9 py-3 text-center">{{ $asignacion->pensums->materias->materia }}</td>
                                    <td class="px-9 py-3 text-center">{{ $asignacion->secciones->seccion }}</td>
                                    <td class="px-9 py-3 text-center">{{ $estudiante->primer_name . ' ' . $estudiante->primer_apellido }}</td>
                                    <td class="px-9 py-3 text-center">{{ $estudiante->cedula }}</td>
                                    <td class="px-9 py-3 text-center">
                                        <a href="" class="p-2 hover:bg-gray-400/20 rounded-lg"><i
                                                class="fa-solid fa-award"></i>
                                            {{ ucwords('calificación') }}</a>
                                        </tb>
                                    @empty
                                <tr class="odd:bg-gray-400/20">
                                    <td class="px-9 py-3 text-center">
                                        {{ $asignacion->pensums->tramotrayecto->tramos->tramos }}
                                    </td>
                                    <td class="px-9 py-3 text-center">{{ $asignacion->pensums->materias->materia }}</td>
                                    <td class="px-9 py-3 text-center">{{ $asignacion->secciones->seccion }}</td>
                                    <td class="px-9 py-3 text-center">Ningún Estudiante</td>
                                    <td class="px-9 py-3 text-center">Ningún Estudiante</td>
                                    <td class="px-9 py-3 text-center">
                                        <a href="" class="p-2 hover:bg-gray-400/20 rounded-lg"><i
                                                class="fa-solid fa-award"></i>
                                            {{ ucwords('calificación') }}</a>
                                        </tb>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</x-dashboard>
