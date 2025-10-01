<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récord Académico</title>
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

        * {
            font-family: "CourierPrime";
            {{-- margin-top: -20px; --}}
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

        .titulo {
            min-width: 100%;
        }

        .fecha {
            min-width: max-content;
            float: left;
        }

        .border {
            border: 1px solid #000;
            border-radius: 14px;
        }
        .text-center{
            text-align: center;
        }
        .min-w-full{
            min-width: 100%;
        }
        .my-0{
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td class="titulo">
                <p>{{ mb_strtoupper(trim('universidad politécnica territorial'), 'UTF-8') }}</p>
                <p>{{ mb_strtoupper(trim('del estado trujillo'), 'UTF-8') }}</p>
                <p>{{ mb_strtoupper(trim('área de registro, seguimiento y control de estudios'), 'UTF-8') }}</p>
                <p>{{ mb_strtoupper(trim('núcleo'), 'UTF-8') . ' ' . $estudiante->nucleos->nucleo }}</p>
            </td>
            <td class="fecha">
                <p>{{ $dia . ' / ' . $mes . ' / ' . $anio }}</p>
            </td>
        </tr>
    </table>
    <center>
        <p>{{ ucwords('récord académico') }}</p>
    </center>
    <p>
        {{ mb_strtoupper(trim('código:'), 'UTF-8') }}
        <span>{{ $estudiante->codigo }}</span>
        {{ mb_strtoupper(trim('cédula:'), 'UTF-8') }}
        <span>
            @if ($estudiante['nacionalidad'] === 'VE')
                V{{ $estudiante['cedula'] }}
            @else
                E{{ $estudiante['cedula'] }}
            @endif
        </span>
        {{ mb_strtoupper(trim('nombre:'), 'UTF-8') }}
        <span class="underline-custom">
            @if ($estudiante['segundo_apellido'] === null)
                {{ $estudiante['primer_apellido'] . ', ' . $estudiante['primer_name'] . ' ' . $estudiante['segundo_name'] }}
            @else
                {{ $estudiante['primer_apellido'] . ' ' . $estudiante['segundo_apellido'] . ', ' . $estudiante['primer_name'] . ' ' . $estudiante['segundo_name'] }}
            @endif
        </span>
        {{ mb_strtoupper(trim('carr.:'), 'UTF-8') }}
        <span class="carrera1"> {{ $titulosacademicos->titulo . ' En ' . $carreras->carrera }}</span>
    </p>
    <div class="border">
        <table class="min-w-full">
            <tbody>
                <tr>
                    <td colspan="5">
                        <p class="text-center my-0">{{ mb_strtoupper(trim('asignaturas cursadas'), 'UTF-8') }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="text-center my-0">{{ mb_strtoupper(trim('sección'), 'UTF-8') }}</p>
                    </td>
                    <td>
                        <p class="text-center my-0">{{ mb_strtoupper(trim('nombre de la asignatura'), 'UTF-8') }}</p>
                    </td>
                    <td>
                        <p class="text-center my-0">{{ mb_strtoupper(trim('uc'), 'UTF-8') }}</p>
                    </td>
                    <td>
                        <p class="text-center my-0">{{ mb_strtoupper(trim('regimen'), 'UTF-8') }}</p>
                    </td>
                    <td>
                        <p class="text-center my-0">{{ mb_strtoupper(trim('nota'), 'UTF-8') }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
