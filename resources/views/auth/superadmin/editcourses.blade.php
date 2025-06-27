<x-dashboard>
    <x-slot:titulo>Carreras</x-slot:titulo>
    <div class="mt-7">
        <x-title-section-admin>Editar La Carrera {{ $courses->carrera }}</x-title-section-admin>
        <div class="flex flex-col mt-2">
            <div class="overflow-x-auto">
                <div class="py-2 inline-block min-w-full">
                    <div class="overflow-hidden border-gray-200 border border-solid rounded-lg">
                        <table class="min-w-full">
                            <thead class="border-b">
                                <tr>
                                    <x-table-th-students>
                                        Nombre De La Carrera
                                    </x-table-th-students>
                                    <x-table-th-students>
                                        Nuevo Nombre De La Carrera
                                    </x-table-th-students>
                                    <x-table-th-students>
                                        Guardar Cambios
                                    </x-table-th-students>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <x-table-td-students>
                                        {{ $courses->carrera }}
                                    </x-table-td-students>
                                    <form action="/savecarrera/{{ $courses->id }}" method="post">
                                        @csrf
                                        <x-table-td-students>
                                            {{-- {{ $carrera->created_at }} --}}
                                            <x-input-form type="text" name="carrera"
                                                value="{{ old('carrera', $courses->carrera) }}" autocomplete="off" />
                                        </x-table-td-students>
                                        <x-table-td-students>
                                            {{-- <a href="/edit-courses/{{ $carrera->id }}" class="hover:bg-gray-400/20 transition-all p-1 rounded-lg"><i class="fas fa-edit mr-3 text-xl"></i>Editar Carrera</a> --}}
                                            <x-button type="submit">Guardar Cambios</x-button>
                                        </x-table-td-students>
                                    </form>
                                </tr>
                            </tbody>
                    </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
