<x-dashboard>
    <x-slot:titulo>Editar {{ $email->email }}</x-slot:titulo>
    <x-title-section-admin class="select-none mt-7">{{ ucwords('Editar') . ' ' . $email->email }}</x-title-section-admin>
    <center>
        <div class="mt-7 max-w-[400px]">
            <form action="/backupeditsave" method="POST">
                @csrf
                <x-input-form type="email" name="email" value="{{ $email->email }}" placeholder="Ingrese El Correo Electrónico" />
                <input type="hidden" name="preedit" value="{{ encrypt($email->email) }}">
                <div class="mt-6 flex items-center justify-between gap-x-6">
                    <x-button class="bg-[#f00] hover:bg-[#b00]" type="button"
                        onclick="history.back()">Cancelar</x-button>
                    <x-button type="submit">Guardar</x-button>
                </div>
            </form>
        </div>
    </center>
</x-dashboard>
