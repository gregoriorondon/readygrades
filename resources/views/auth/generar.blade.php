<x-dashboard>
    <x-slot:titulo>Generear Constancia De Estudios</x-slot:titulo>
    <form action="{{ route('generarpdf') }}">
        <h1>Generar Documentos</h1>
        <x-input-form type="number" />
    </form>
</x-dashboard>
