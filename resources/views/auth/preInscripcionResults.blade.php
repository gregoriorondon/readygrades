<x-dashboard>
    <x-slot:titulo>Resultados</x-slot:titulo>
    <div class="max-w-[700px] mx-auto space-y-[10px]">
        <x-title-section-admin class="mb-7">Datos Del Aspirante En Espera:</x-title-section-admin>

        <p><strong>Nombre:</strong> {{ ucwords($busqueda->primer_name . ' ' . $busqueda->segundo_name) }}</p>
        <p><strong>Apellido:</strong> {{ ucwords($busqueda->primer_apellido . ' ' . $busqueda->segundo_apellido) }}</p>
        @if ($busqueda->nacionalidad === 'VE')
            <p><strong>Cédula de Identidad:</strong> V-{{ $busqueda->cedula }}</p>
        @else
            <p><strong>Cédula de Identidad:</strong> E-{{ $busqueda->cedula }}</p>
        @endif
        <p><strong>Fecha de Nacimiento:</strong> {{ $fechana }}</p>
        <p><strong>Genero:</strong> {{ ucwords($busqueda->genero) }}</p>
        @if ($busqueda->genero === 'masculino')
            @switch($busqueda->civil)
                @case('c')
                    <p><strong>Estado Civil:</strong> Casado</p>
                    @break
                @case('d')
                    <p><strong>Estado Civil:</strong> Divorciado</p>
                    @break
                @case('v')
                    <p><strong>Estado Civil:</strong> Viudo</p>
                    @break
                @default
                    <p><strong>Estado Civil:</strong> Soltero</p>
            @endswitch
        @else
            @switch($busqueda->civil)
                @case('c')
                    <p><strong>Estado Civil:</strong> Casada</p>
                    @break
                @case('d')
                    <p><strong>Estado Civil:</strong> Divorciada</p>
                    @break
                @case('v')
                    <p><strong>Estado Civil:</strong> Viuda</p>
                    @break
                @default
                    <p><strong>Estado Civil:</strong> Soltera</p>
            @endswitch
        @endif
        <p><strong>Dirección:</strong> {{ ucwords($busqueda->direccion) }}</p>
        <p><strong>Ciudad:</strong> {{ ucwords($busqueda->city) }}</p>
        <p><strong>Consejo Comunal:</strong> {{ ucwords($busqueda->consejo) }}</p>
        <p><strong>Comuna:</strong> {{ ucwords($busqueda->comuna) }}</p>
        <p><strong>Teléfono:</strong> {{ $busqueda->telefono }}</p>
        <p><strong>Teléfono de Habitación:</strong> {{ $busqueda->telefono2 }}</p>
        <p><strong>Correo / Email:</strong> {{ $busqueda->email }}</p>
        @if (!is_null($busqueda->discapacidad))
            <p><strong>Discapacidad:</strong> {{ ucwords($busqueda->discapacidad) }}</p>
        @else
            <p><strong>Discapacidad:</strong> {{ ucwords('ninguna') }}</p>
        @endif
        @if (!is_null($busqueda->disciplina))
            <p><strong>Disciplina:</strong> {{ ucwords($busqueda->disciplina) }}</p>
        @else
            <p><strong>Disciplina:</strong> {{ ucwords('ninguna') }}</p>
        @endif
        <p><strong>Título:</strong> {{ ucwords($titulo->titulo) }}</p>
        <p><strong>Mención:</strong> {{ ucwords($busqueda->mencion) }}</p>
        <p><strong>Institución:</strong> {{ ucwords($busqueda->institucion) }}</p>
        <p><strong>Ciudad / Estado:</strong> {{ ucwords($busqueda->cityinstitucion) }}</p>
        <p><strong>Fecha de Grado:</strong> {{ $fechagra }}</p>
        <p><strong>Promedio OPSU:</strong> {{ $busqueda->promedio }}</p>
        <p><strong>Nivel Socio Económico:</strong> {{ ucwords($nivel->socioeconomico) }}</p>
        @if (!is_null($busqueda->trabaja))
            <p><strong>Lugar De Trabajo:</strong> {{ ucwords($busqueda->trabaja) }}</p>
        @else
            <p><strong>Lugar De Trabajo:</strong> {{ ucwords('ninguna') }}</p>
        @endif
        <p><strong>Programa Nacional  de Formación (PNF):</strong> {{ ucwords($carrera->carrera) }}</p>

        <form action="/aspirante/registrar" method="post">
            @csrf
            <x-select-form name="seccion">
                @if ($busqueda->genero === 'masculino')
                    <option hidden>Selecciona La Sección Para El Aspirante</option>
                @else
                    <option hidden>Selecciona La Sección Para La Aspirante</option>
                @endif
                @foreach ($seccion as $secciones)
                    <option value="{{ $secciones->id }}" required>{{ $secciones->seccion . ' Ha sido usado por: ' . $seccionCount . ' Veces' }}</option>
                @endforeach
            </x-select-form>
            <div class="!mt-7 flex justify-between">
                <input type="hidden" name="informacion" value="{{ encrypt($busqueda->cedula) }}">
                <x-button type="button" class="bg-[#f00] hover:bg-[#b00]" onclick="history.back()" >Cancelar</x-button>
                <x-button type="submit">Registrar</x-button>
            </div>
        </form>
    </div>
</x-dashboard>
