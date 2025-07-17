<x-dashboard>
    <x-slot:titulo>Editar Título</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('editar el título ' . $titulo->estudio) }}</x-title-section-admin>
    <div class="flex justify-center mt-9">
        <div class="w-[400px]">
            <form action="/save-edit-titulo" method="post">
                @csrf
                <x-label>{{ ucwords('agregar título profesional obtenido:') }}<x-input-form type="text" name="estudio"
                        value="{{ mb_strtoupper(trim($titulo->estudio), 'UTF-8') }}"
                        placeholder="Agregar título de estudio" autocomplete="off" /></x-label>
                <x-label class="mt-5">{{ ucwords('agregar abreviatura del título obtenido:') }}<x-input-form
                        type="text" name="abrev" value="{{ mb_strtoupper(trim($titulo->abrev), 'UTF-8') }}"
                        placeholder="Agregar abreviatura del título" autocomplete="off" /></x-label>
                <input type="hidden" name="titulo_id" value="{{ $titulo->id }}">
                <div class="flex justify-between mt-4">
                    <x-button type="button" class="bg-[#f00] hover:bg-[#b00]"
                        onclick="history.back()">Cancelar</x-button>
                    <x-button>Guardar</x-button>
                </div>
            </form>
        </div>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
