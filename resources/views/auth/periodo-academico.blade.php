<x-dashboard>
    <x-slot:titulo>Periodos Académicos</x-slot:titulo>
    <x-title-section-admin>Periodos Académicos</x-title-section-admin>
    <div class="w-fit mx-auto mt-7">
    <form action="" method="post">
        @csrf
        <x-label class="mt-3">Selecciona la fecha de inicio del período académico</x-label>
        <x-input-form type="date" name="dateini" />
        <x-label class="mt-3">Selecciona la fecha de final del período académico</x-label>
        <x-input-form type="date" name="datefin" />
        <x-label class="mt-3">Coloca un nombre al período académico (opcional)</x-label>
        <x-input-form type="text" name="nombre" placeholder="Nombre del período académico (opcional)" />

        <div class="mt-7 flex justify-between">
            <x-button type="button" onclick="history.back()" class="bg-[#f00] hover:bg-[#b00]">Cancelar</x-button>
            <x-button type="submit">Guardar</x-button>
        </div>
    </form>
    </div>
</x-dashboard>
