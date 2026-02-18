<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planilla de Inscripción UPTT - ARSCE 001</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 10px auto;
            padding: 20px;
            color: #333;
        }
        /* Tamaños de fuente solicitados */
        .f-8 { font-size: 8px; }
        .f-9 { font-size: 9px; }
        .f-12 { font-size: 12px; }

        h2 { font-size: 14px; text-align: center; margin-bottom: 5px; color: #333; }
        p, li { font-size: 10px; margin: 2px 0; }

        .instrucciones {
            border: 1px solid #d1d1d1;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        th, td {
            border: 1px solid #444;
            padding: 5px;
            vertical-align: middle;
        }

        .header-table td { border: none; font-weight: bold; text-align: center; color: #333; }

        /* Colores por sección */
        .section-personales { background-color: #e3f2fd; font-weight: bold; text-align: center; font-size: 10px; }
        .section-academicos { background-color: #e8f5e9; font-weight: bold; text-align: center; font-size: 10px; }
        .section-socio { background-color: #fff3e0; font-weight: bold; text-align: center; font-size: 10px; }
        .section-recepcion { background-color: #eceff1; font-weight: bold; text-align: center; font-size: 10px; }

        .no-border { border: none; }
        .text-center { text-align: center; }
        .signature-box { padding-top: 25px; text-align: center; }

        .corte {
            border-top: 2px dashed #999;
            margin-top: 25px;
            padding-top: 5px;
            text-align: center;
            font-size: 9px;
            color: #777;
        }
        .comprobante-box {
            border: 1px solid #888;
            border-radius: 5px;
            padding: 10px;
            margin-top: 5px;
        }
        .check{
            width: 7px;
            height: 7px;
            display: inline-block;
            border: 1px solid;
            vertical-align: middle;
        }
        .cintillo{
            max-width: 17cm;
            margin-bottom: 10px;
        }
        #watermark {
            position: fixed;
            left: 10%;
            bottom: 1%;
            z-index: 1000;
            opacity: 0.1;
        }
    </style>
</head>
<body>
    <div id="watermark">
        <img src="./logouptt.png" height="100%" width="100%" />
    </div>
    <div style="text-align: center">
        <img src="img/planilla-pregrado/cintillo.jpg" alt="cintillo" class="cintillo">
    </div>
    <div class="instrucciones">
        <h2 class="f-12">INSTRUCTIVO DE LLENADO - ARSCE 001</h2>
        <p class="f-9"><strong>IMPORTANTE:</strong> Use MAYÚSCULAS para nombres. Formato Fecha: DD/MM/AAAA. No deje espacios en la Cédula.</p>
    </div>
    <table class="header-table">
        <tr class="f-12">
            <td colspan="3">
                <p>UNIVERSIDAD POLITÉCNICA TERRITORIAL DEL ESTADO TRUJILLO "MARIO BRICEÑO IRAGORRY"</p>
            </td>
            <td colspan="1" rowspan="2" style="text-align: right;">
                <img src="data:image/svg+xml;base64,{{ $qrCode }}" width="55">
            </td>
        </tr>
        <tr class="f-9">
            <td width="30%">CÓDIGO: ARSCE-001</td>
            <td width="35%" class="f-12" style="text-decoration: underline;">PLANILLA DE PRE-INSCRIPCIÓN</td>
            <td width="30%">FECHA: ____/____/_______</td>
        </tr>
    </table>
    <table>
        <tr class="section-personales">
            <td colspan="4">DATOS PERSONALES</td>
        </tr>
        <tr class="f-9">
            <td colspan="2" style="text-transform: uppercase"><strong>APELLIDOS Y NOMBRES:</strong> {{ $r->primer_apellido . ' ' . $r->segundo_apellido . ' ' . $r->primer_name . ' ' . $r->segundo_name }}</td>
            @if ($nacionalidad === 'VE')
                <td colspan="2"><strong>Nº DE CÉDULA DE IDENTIDAD: </strong>{{ 'V-' . $r->cedula }}</td>
            @else
                <td colspan="2"><strong>Nº DE CÉDULA DE IDENTIDAD: </strong>{{ 'E-' . $r->cedula }}</td>
            @endif
        </tr>
        <tr class="f-8">
            <td width="25%"><strong>FECHA NACIMIENTO: </strong>{{ $fechana }}</td>
            <td width="25%" style="text-transform: uppercase"><strong>ESTADO CIVIL: </strong>{{ $civil }}</td>
            @if ($genero === 'masculino')
                <td width="25%"><strong>SEXO: </strong>M</td>
            @else
                <td width="25%"><strong>SEXO: </strong>F</td>
            @endif
            <td width="25%"><strong>EDAD: </strong>{{ $edad->y }}</td>
        </tr>
        <tr class="f-8">
            <td colspan="2"><strong>TELÉFONO MÓVIL: </strong>{{ $r->telefono }}</td>
            <td colspan="2"><strong>TELÉFONO HABITACIÓN: </strong>{{ $r->telefono2 }}</td>
        </tr>
        <tr class="f-8">
            <td colspan="4" style="text-transform: uppercase"><strong>DIRECCIÓN DE HABITACIÓN EXACTA: </strong> {{ $r->direccion . ' - ' . $r->city }}</td>
        </tr>
        <tr class="f-8">
            <td colspan="1" style="text-transform: uppercase"><strong>CONSEJO COMUNAL: </strong>{{ $r->consejo }}</td>
            <td colspan="1" style="text-transform: uppercase"><strong>COMUNA: </strong>{{ $r->comuna }}</td>
            <td colspan="2"><strong>CORREO ELECTRÓNICO: </strong>{{ $r->email }}</td>
        </tr>
        <tr class="f-8">
            @if ($r->discapacidad === null)
                <td colspan="4" style="text-transform: uppercase"><strong>¿POSEE ALGUNA DISCAPACIDAD?  </strong>SI  ______   NO___X___  <strong> ESPECIFIQUE CUAL: </strong></td>
            @else
                <td colspan="4" style="text-transform: uppercase"><strong>¿POSEE ALGUNA DISCAPACIDAD?  </strong>SI  ___X___   NO______  <strong> ESPECIFIQUE CUAL: </strong>{{ $r->discapacidad }}</td>
            @endif
        </tr>
        <tr class="f-8">
            @if ($r->disciplina === null)
                <td colspan="4" style="text-transform: uppercase"><strong>¿ES DEPORTISTA DE ALTO RENDIMIENTO? </strong>SI  ______   NO___X___  <strong> DISCIPLINA: </strong></td>
            @else
                <td colspan="4" style="text-transform: uppercase"><strong>¿ES DEPORTISTA DE ALTO RENDIMIENTO? </strong> SI  ___X___   NO______  <strong> DISCIPLINA: </strong>{{ $r->disciplina }}</td>
            @endif
        </tr>

        <tr class="section-academicos">
            <td colspan="4">DATOS ACADÉMICOS (PROCEDENCIA)</td>
        </tr>
        <tr class="f-8">
            <td style="text-transform: uppercase"><strong>TÍTULO: </strong>{{ $titulo->titulo }}</td>
            <td style="text-transform: uppercase"><strong>MENCIÓN: </strong>{{ $r->mencion }}</td>
            <td style="text-transform: uppercase" colspan="2"><strong>INSTITUCIÓN: </strong>{{ $r->institucion }}</td>
        </tr>
        <tr class="f-8">
            <td colspan="2" style="text-transform: uppercase"><strong>CIUDAD / ESTADO: </strong>{{ $r->cityinstitucion }}</td>
            <td><strong>FECHA DE GRADO: </strong>{{ $fechagra }}</td>
            <td><strong>PROMEDIO OPSU: </strong>{{ $r->promedio }}</td>
        </tr>

        <tr class="section-socio">
            <td colspan="4">DATOS SOCIOECONÓMICOS</td>
        </tr>
        <tr class="f-8">
            <td colspan="2" style="text-transform: uppercase"><strong>NIVEL SOCIOECONÓMICO: </strong>{{ $nivelsocial->socioeconomico }}</td>
            @if ($r->trabaja === null)
                <td colspan="2" style="text-transform: uppercase"><strong>TRABAJA ACTUALMENTE:  </strong> SI____ NO__X__ <strong>LUGAR: </strong></td>
            @else
                <td colspan="2" style="text-transform: uppercase"><strong>TRABAJA ACTUALMENTE:  </strong> SI__X__ NO___ <strong>LUGAR: </strong>{{ $r->trabaja }}</td>
            @endif
        </tr>

        <tr class="section-recepcion">
            <td colspan="4">RECEPCIÓN DE DOCUMENTOS (SOLO ARSCE)</td>
        </tr>
        <tr class="f-8">
            <td><span class="check"></span><strong> Fondo Negro Título</td></strong>
            <td><span class="check"></span><strong> Fotos Carnet</td></strong>
            <td><span class="check"></span><strong> Partida Nacimiento</td></strong>
            <td><span class="check"></span><strong> Notas Certificadas</td></strong>
        </tr>
        <tr class="f-8">
            <td colspan="2"><span class="check"></span><strong> Planilla OPSU / SNI</td></strong>
            <td colspan="2"><span class="check"></span><strong> Fotocopia C.I. Ampliada</td></strong>
        </tr>

        <tr class="section-recepcion">
            <td colspan="4">SOLICITUD DE INSCRIPCIÓN</td>
        </tr>
        <tr class="f-9">
            <td colspan="2" style="text-transform: uppercase"><strong>PROGRAMA NACIONAL DE FORMACIÓN (PNF): </strong>{{ $carreras->carreras->carrera }}</td>
            <td colspan="2"><strong>TURNO: <span class="check"></span> FIN DE SEMANA <span class="check"></span> ENTRE SEMANA</strong></td>
        </tr>
    </table>

    <table class="no-border" style="margin-top: 15px;">
        <tr class="no-border">
            <td class="no-border signature-box f-9" width="50%">
                __________________________<br>
                <strong>ESTUDIANTE</strong><br>
                @if ($nacionalidad === 'VE')
                    <strong>C.I: </strong>{{ 'V-' . $r->cedula }}
                @else
                    <strong>C.I: </strong>{{ 'E-' . $r->cedula }}
                @endif
            </td>
            <td class="no-border signature-box f-9" width="50%">
                __________________________<br>
                <strong>RECEPTOR ARSCE</strong><br>
                Firma y Sello
            </td>
        </tr>
    </table>

    <div class="corte">
        RECORTAR AQUÍ
    </div>
    <div class="comprobante-box">
        <div style="text-align: center">
            <img src="img/planilla-pregrado/cintillo.jpg" alt="cintillo" class="cintillo">
        </div>
        <p class="text-center f-12" style="margin-bottom: 25px"><strong>COMPROBANTE DE INSCRIPCIÓN (PARA EL ALUMNO)</strong></p>
        @if ($nacionalidad === 'VE')
            <p class="f-9" style="text-transform: uppercase; margin-bottom: 10px"><strong>Apellidos y Nombres: </strong>{{ $r->primer_apellido . ' ' . $r->segundo_apellido . ' ' .  $r->primer_name . ' ' . $r->segundo_name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>C.I: </strong>{{ 'V-' . $r->cedula }}</p>
        @else
            <p class="f-9" style="text-transform: uppercase; margin-bottom: 10px"><strong>Apellidos y Nombres: </strong> {{ $r->primer_apellido . ' ' . $r->segundo_apellido . ' ' .  $r->primer_name . ' ' . $r->segundo_name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>C.I: </strong> {{ 'E-' . $r->cedula }}</p>
        @endif
        <p class="f-9" style="text-transform: uppercase; margin-bottom: 10px"><strong>Programa Nacional de Formación: </strong> {{ $carreras->carreras->carrera }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <strong>TURNO: </strong> _________________</p>
        <p class="f-9" style="margin-bottom: 5px"><strong>FECHA:</strong> ____/____/_______ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Funcionario Receptor:</strong> _________________________</p>
    </div>

</body>
</html>
