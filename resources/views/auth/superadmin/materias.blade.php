<x-dashboard>
    <x-slot:titulo>Materias</x-slot:titulo>
    <form action="/materia" method="post">
        @csrf
        <x-input-form type="text" name="materia" placeholder="Ingrese el Nombre de la materia a registrar" />
        <x-input-form type="text" name="codigo" placeholder="Ingrese el código de la materia a registrar" />
        <x-button type="submit">Enviar</x-button>
    </form>
    <x-error-and-correct-dialog />
    <div>
        @if ($materias->isEmpty())
            <p>Aun no hay materias registradas en el sistema.</p>
        @else
            @foreach ($materias as $materia)
                <p>{{ $materia->materia }} - {{ $materia->codigo }}</p>
            @endforeach
        @endif
    </div>
</x-dashboard>
