<style>

@font-face{
    font-family: 'CourierPrime';
    src: url('/resources/fonts/CourierPrime/CourierPrime-Regular.ttf');
    font-style: normal;
}
@font-face{
    font-family: 'CourierBold';
    src: url('/resources/fonts/CourierPrime/CourierPrime-Bold.ttf');
    font-style: normal;
}
@font-face{
    font-family: 'CourierItalic';
    src: url('/resources/fonts/CourierPrime/CourierPrime-BoldItalic.ttf');
    font-style: normal;
}
@font-face{
    font-family: 'Courier';
    src: url('/resources/fonts/CourierPrime/CourierPrime-Italic.ttf');
    font-style: normal;
}
#titulo_constancia p{
    font-family: Georgia, 'Times New Roman', Times, serif;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 18px;
    line-height: 2px;
}
#cuerpo_constancia p,span{
    font-family: "CourierPrime";
    margin-top: -20px;
}
.departamento{
    font-family: Georgia, 'Times New Roman', Times, serif;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 16px;
    margin-top: -20px;
}
.titulo_constancia{
    text-align: center;
    font-family: Georgia, 'Times New Roman', Times, serif;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 21px;
}
.cuerpo_constancia{
    font-family: "CourierBold";
    text-transform: uppercase;
    margin-top: 20px;
    text-indent: 45px;
    word-spacing: 7px;
    line-height: 25px;
}
.carrera{
    text-align: center;
    margin-top: -21px;
}
.carrera1{
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
.firma_derecha{
    text-align: right;
    margin: 100px 22px 0px 22px;
}
.firma1{
    display: inline-block;
    position: relative;
    border-color: #000;
    width: 250px;
    text-align: center;
}
.firma{
    display: block;
    border-top: 1px solid;
    margin-top: 40px;
    transform: translateY(-20px);
}

</style>

@foreach( $informacion as $informa)
    <div>
        <div id="titulo_constancia">
            <p>{{ $informa['entidad_superior'] }}</p>
            <p>{{ $informa['ministerio'] }}</p>
            <p>{{ $informa['nivel_educativo'] }}</p>
            <p>{{ $informa['nombre_institucion'] }}</p>
            <p>{{ $informa['sede_institucion'] }}</p>
        </div>
        <div class="departamento">
            <p>{{ $informa['departamento'] }}</p>
        </div>
        <div id="cuerpo_constancia">
            <p>{{ $informa['nucleo'] . ' ' . $usuario->nucleos->nucleo }}</p>
        </div>
        <div class="titulo_constancia">
            <p>{{ $informa['titulo_documento'] }}</p>
        </div>
        <div class="cuerpo_constancia">
            <p>{{ $informa['introduccion'] }}
            <span class="underline-custom">Gregorio Alexander, Rondon Carrasquero</span>
            {{ $informa['texto_pre_cedula'] }}
            <span class="underline-custom">V29994791</span>
            {{ $informa['texto_estatus_estudiante'] }}
            </p>
        </div>
        <div class="carrera" style="">
            <div>
                <p class="carrera1">Ingeniero en Informática</p>
            </div>
        </div>
        <div class="cuerpo_constancia" style="text-indent: 0;">
            <p>{{ $informa['texto_inicio_fecha'] }}
            <span class="underline-custom1">{{ $usuario->nucleos->nucleo }},</span>
            {{ $informa['texto_dia'] }}
            <span class="underline-custom1">veintisiete</span>
            {{ $informa['texto_mes'] }}
            <span class="underline-custom1">junio</span>
            {{ $informa['texto_anio'] }}
            <span class="underline-custom1">2025</span>
            </p>
        </div>
        <div  class="cuerpo_constancia" style="text-indent: 0;">
            <p>{{ $informa['nota_validez'] }}</p>
        </div>
        <div class="firma_derecha">
            <div class="firma1" id="cuerpo_constancia" style="text-transform: uppercase;">
                <span class="firma"> </span>
                <p>Grado. {{ $usuario['primer-name'] . ' ' .  $usuario['primer-apellido'] }}</p>
                <p>Cargo</p>
            </div>
        </div>
        <div  class="cuerpo_constancia" style="text-indent: 0; font-size: 12px;">
            <p style="text-transform: none;">{{ $informa['texto_emitido_por'] }}
            <span>Grado. {{ $usuario['primer-name'] . ' ' .  $usuario['primer-apellido'] }}</span>
            </p>
        </div>
        <div class="cuerpo_constancia">
            <p style="margin-top: -10px; text-indent: 0; text-align: center;">{{ $informa['nota_validez_pie'] }}</p>
        </div>
    </div>
@endforeach
