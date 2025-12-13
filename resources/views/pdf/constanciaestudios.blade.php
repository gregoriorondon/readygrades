<style>
    @font-face {
        font-family: 'CourierPrime';
        src: url('/resources/fonts/CourierPrime/CourierPrime-Regular.ttf');
        font-style: normal;
    }

    @font-face {
        font-family: 'CourierBold';
        src: url('/resources/fonts/CourierPrime/CourierPrime-Bold.ttf');
        font-style: normal;
    }

    @font-face {
        font-family: 'CourierItalic';
        src: url('/resources/fonts/CourierPrime/CourierPrime-BoldItalic.ttf');
        font-style: normal;
    }

    @font-face {
        font-family: 'Courier';
        src: url('/resources/fonts/CourierPrime/CourierPrime-Italic.ttf');
        font-style: normal;
    }

    #titulo_constancia p {
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-transform: uppercase;
        font-weight: 700;
        font-size: 18px;
        line-height: 2px;
    }

    #cuerpo_constancia p,
    span {
        font-family: "CourierPrime";
        margin-top: -20px;
    }

    .departamento {
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-transform: uppercase;
        font-weight: 700;
        font-size: 16px;
        margin-top: -20px;
    }

    .titulo_constancia {
        text-align: center;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-transform: uppercase;
        font-weight: 700;
        font-size: 21px;
    }

    .cuerpo_constancia {
        font-family: "CourierBold";
        text-transform: uppercase;
        margin-top: 20px;
        text-indent: 45px;
        word-spacing: 7px;
        line-height: 25px;
    }

    .carrera {
        text-align: center;
        margin-top: -21px;
    }

    .carrera1 {
        font-family: "CourierItalic";
        font-size: 21px;
        text-transform: uppercase;
        display: inline-block;
        border-bottom: 1px solid;
        padding-bottom: 3px;
        bottom: 0;
        line-height: 20px;
        position: relative;
        padding: 0px 21px;
        text-indent: 0px;
    }

    .underline-custom {
        font-family: "CourierItalic";
        display: inline-block;
        border-bottom: 1px solid;
        padding-bottom: 3px;
        bottom: 0;
        transform: translateY(5px);
        line-height: 20px;
        position: relative;
        padding: 0px 21px;
        text-indent: 0px;
    }

    .underline-custom1 {
        font-family: "Courier";
        display: inline-block;
        border-bottom: 1px solid;
        padding-bottom: 3px;
        bottom: 0;
        transform: translateY(5px);
        line-height: 20px;
        position: relative;
        padding: 0px 15px;
        text-indent: 0px;
    }

    .firma_derecha {
        text-align: right;
        margin: 100px 22px 0px 22px;
    }

    .firma1 {
        display: inline-block;
        position: relative;
        border-color: #000;
        width: 250px;
        text-align: center;
    }

    .firma {
        display: block;
        border-top: 1px solid;
        margin-top: 40px;
        transform: translateY(-20px);
    }

    .pagina {
        page-break-after: always;
    }
</style>

<div>
    <div id="titulo_constancia">
        <p>{{ $informacion['entidad_superior'] }}</p>
        <p>{{ $informacion['ministerio'] }}</p>
        <p>{{ $informacion['nivel_educativo'] }}</p>
        <p>{{ $informacion['nombre_institucion'] }}</p>
        <p>{{ $informacion['sede_institucion'] }}</p>
    </div>
    <div class="departamento">
        <p>{{ $informacion['departamento'] }}</p>
    </div>
    <div id="cuerpo_constancia">
        <p>{{ $informacion['nucleo'] . ' ' . $estudianteNu->nucleo }}</p>
    </div>
    <div class="titulo_constancia">
        <p>{{ $informacion['titulo_documento'] }}</p>
    </div>
    <div class="cuerpo_constancia">
        <p>{{ $informacion['introduccion'] }}
            <span class="underline-custom">
                @if ($estudiante['segundo_apellido'] === null)
                    {{ $estudiante['primer_apellido'] . ', ' . $estudiante['primer_name'] . ' ' . $estudiante['segundo_name'] }}
                @else
                    {{ $estudiante['primer_apellido'] . ' ' . $estudiante['segundo_apellido'] . ', ' . $estudiante['primer_name'] . ' ' . $estudiante['segundo_name'] }}
                @endif
            </span>
            {{ $informacion['texto_pre_cedula'] }}
            <span class="underline-custom">
                @if ($estudiante['nacionalidad'] === 'VE')
                    V{{ $estudiante['cedula'] }}
                @else
                    E{{ $estudiante['cedula'] }}
                @endif
            </span>
            {{ $informacion['texto_estatus_estudiante'] }}
        </p>
    </div>
    <div class="carrera" style="">
        <div>
            <p class="carrera1"> {{ $titulosacademicos->titulo . ' En ' . $carreras->carrera }}</p>
        </div>
    </div>
    <div class="cuerpo_constancia" style="text-indent: 0;">
        <p>{{ $informacion['texto_inicio_fecha'] }}
            <span class="underline-custom1">{{ $estudianteNu->nucleo }},</span>
            {{ $informacion['texto_dia'] }}
            <span class="underline-custom1">{{ $diaTexto }}</span>
            {{ $informacion['texto_mes'] }}
            <span class="underline-custom1">{{ $mes }}</span>
            {{ $informacion['texto_anio'] }}
            <span class="underline-custom1">{{ $anio }}</span>
        </p>
    </div>
    <div class="cuerpo_constancia" style="text-indent: 0;">
        <p>Esta constancia es valida a partir del
        {{ $diaPeriodoInicio . ' ' . $mesPeriodoInicio . ' del ' . $anioPeriodoInicio }}
        hasta el
        {{ $diaPeriodoFin . ' ' . $mesPeriodoFin . ' del ' . $anioPeriodoFin }}</p>
    </div>
    <div class="firma_derecha">
        <div class="firma1" id="cuerpo_constancia" style="text-transform: uppercase;">
            <span class="firma"> </span>
            <p>{{ $usuario->estudios->abrev }}. {{ $usuario['primer-name'] . ' ' . $usuario['primer-apellido'] }}
            </p>
            <p>{{ $usuario->cargos->cargo }}</p>
        </div>
    </div>
    <div class="cuerpo_constancia" style="text-indent: 0; font-size: 12px;">
        <p style="text-transform: none;">{{ $informacion['texto_emitido_por'] }}
            <span style="text-transform: uppercase;">{{ $usuario->estudios->abrev }}.
                {{ $usuario['primer-name'] . ' ' . $usuario['primer-apellido'] }}</span>
        </p>
    </div>
    <div class="cuerpo_constancia">
        <p style="margin-top: -10px; text-indent: 0; text-align: center;">
        Valida desde el {{  $diaPeriodoInicio . ' ' . $mesPeriodoInicio . ' del ' . $anioPeriodoInicio }} hasta el {{ $diaPeriodoFin . ' ' . $mesPeriodoFin . ' del ' . $anioPeriodoFin }}.
        </p>
    </div>
</div>
