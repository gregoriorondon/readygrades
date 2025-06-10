<x-dashboard>
    <x-slot:titulo>Generear Constancia De Estudios</x-slot:titulo>
    @foreach( $informacion as $informa)
    <div class="bg-white text-black">
        <div class="text-2xl font-bold" id="titulo_constancia">
            <p>{{ $informa['entidad_superior'] }}</p>
            <p>{{ $informa['ministerio'] }}</p>
            <p>{{ $informa['nivel_educativo'] }}</p>
            <p>{{ $informa['nombre_institucion'] }}</p>
            <p>{{ $informa['sede_institucion'] }}</p>
        </div>
        <div class="text-lg font-bold mt-1" id="titulo_constancia">
            <p>{{ $informa['departamento'] }}</p>
        </div>
        <div class="text-base" id="cuerpo_constancia">
            <p>{{ $informa['nucleo'] . ' ' . $usuario->nucleos->nucleo }}</p>
        </div>
        <div class="text-3xl font-bold mt-4 text-center" id="titulo_constancia">
            <p>{{ $informa['titulo_documento'] }}</p>
        </div>
        <div class="text-lg font-bold mt-7 indent-14" id="cuerpo_constancia">
            <p>{{ $informa['introduccion'] }}
            <span class="italic font-bold underline-custom">Apellidos, Nombre Ejemplo</span>
            {{ $informa['texto_pre_cedula'] }}
            <span class="italic font-bold underline-custom">V29994791</span>
            {{ $informa['texto_estatus_estudiante'] }}
            </p>
        </div>
        <div class="text-3xl font-bold mt-4 text-center" id="titulo_constancia">
            <p>Ingeniero en Informática</p>
        </div>
        <div class="text-lg font-bold mt-7" id="cuerpo_constancia">
            <p>{{ $informa['texto_inicio_fecha'] }}
            <span class="italic font-bold underline-custom">{{ $usuario->nucleos->nucleo }},</span>
            {{ $informa['texto_dia'] }}
            <span class="italic font-bold underline-custom">veintisiete</span>
            {{ $informa['texto_mes'] }}
            <span class="italic font-bold underline-custom">junio</span>
            {{ $informa['texto_anio'] }}
            <span class="italic font-bold underline-custom">2025</span>
            </p>
        </div>
        <div  class="text-lg font-bold mt-7" id="cuerpo_constancia">
            <p>{{ $informa['nota_validez'] }}</p>
        </div>
        <div class="firma_derecha">
            <div  class="text-lg font-normal text-center mt-7 firma" id="cuerpo_constancia">
                <p>Grado. {{ $usuario['primer-name'] . ' ' .  $usuario['primer-apellido'] }}</p>
                <p>Cargo</p>
            </div>
        </div>
        <div  class="text-sm font-bold mt-7" id="cuerpo_constancia">
            <p>{{ $informa['texto_emitido_por'] }}
            <span class="font-normal">Grado. {{ $usuario['primer-name'] . ' ' .  $usuario['primer-apellido'] }}</span>
            </p>
        </div>
        <div class="text-lg text-center font-bold mt-7" id="cuerpo_constancia">
            <p>{{ $informa['nota_validez_pie'] }}</p>
        </div>
    </div>
@endforeach
</x-dashboard>
