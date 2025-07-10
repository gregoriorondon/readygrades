<x-dashboard>
    <x-slot:titulo>Títulos Del Personal Registrado</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('títulos obtenidos por el personal registrado') }}</x-title-section-admin>
    <div>
        <div class="flex justify-center mt-9">
            <div class="w-[400px]">
                <form action="/crear-titulo" method="post">
                    @csrf
                    <x-label>{{ ucwords('agregar título profesional obtenido:') }}<x-input-form type="text"
                            name="estudio" placeholder="Agregar título de estudio" autocomplete="off" /></x-label>
                    <x-label class="mt-5">{{ ucwords('agregar abreviatura del título obtenido:') }}<x-input-form
                            type="text" name="abrev" placeholder="Agregar abreviatura del título"
                            autocomplete="off" /></x-label>
                    <div class="flex justify-between mt-4">
                        <x-button type="button" class="bg-[#f00] hover:bg-[#b00]"
                            onclick="history.back()">Cancelar</x-button>
                        <x-button>Agregar</x-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-14">
            <div class="flex justify-center">
                @if ($estudios->isEmpty())
                    <p>{{ ucwords('aún no hay estudios registrados en el sistema') }}</p>
                @else
                    <div class="border rounded-lg">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2 px-8">Título</th>
                                    <th class="py-2 px-8">Abreviatura</th>
                                    <th class="py-2 px-8">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudios as $estudio)
                                    <tr class="odd:bg-gray-400/20 py-2 px-8">
                                        <td class="text-center py-2 px-8">
                                            {{ mb_strtoupper(trim($estudio->estudio)), 'UTF-8' }}</td>
                                        <td class="text-center py-2 px-8">
                                            {{ mb_strtoupper(trim($estudio->abrev)), 'UTF-8' }}</td>
                                        <td class="text-center py-2 px-8">
                                            <a href="/editar-titulo/{{ $estudio->id }}"
                                                class="hover:bg-gray-400/20 p-1 transition-all rounded-lg"><i
                                                    class="fa fa-edit mr-2"></i>Editar Título</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <div class="flex justify-center mt-2">
                <div class="w-[50%]">
                    {{ $estudios->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
