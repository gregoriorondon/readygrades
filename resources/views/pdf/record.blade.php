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
            line-height: 70%;
            font-size: 14px;
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
            font-family: "Courier";
            display: inline-block;
            border-bottom: 1px solid;
            padding-bottom: 3px;
            bottom: 0;
            transform: translateY(5px);
            line-height: 20px;
            position: relative;
            padding: 0px 10px;
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
            padding: 0px;
            text-indent: 0px;
        }

        .firma_derecha {
            text-align: right;
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
            width: auto;
            vertical-align: top;
        }

        .fecha {
            width: 20%;
            vertical-align: top;
            margin-top: 0;
            text-align: right;
        }

        .tabla {
            width: 100%;
            border-collapse: collapse;
        }

        .border {
            border: 1px solid #000;
            border-radius: 14px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .min-w-full {
            min-width: 100%;
        }

        .my-0 {
            margin-top: 0;
            margin-bottom: 0;
        }

        .ml-8 {
            margin-left: 32px;
        }

        .block {
            display: block;
        }

        .font-semibold {
            font-weight: 600;
        }

        .font-courier-bold {
            font-family: "CourierBold";
        }

        .w-300 {
            width: 150px;
        }

        .line-height {
            line-height: 20%;
        }

        .line-height1 {
            line-height: 0;
            margin: 0;
        }

        .text-xl {
            font-size: 21px;
        }
        .mt-2{
            margin-top: 8px;
        }
    </style>
</head>
<body>
    <table class="tabla">
        <tr>
            <td class="titulo line-height">
                <p class="line-height font-courier-bold">
                    {{ mb_strtoupper(trim('universidad politécnica territorial'), 'UTF-8') }}</p>
                <p class="line-height font-courier-bold">{{ mb_strtoupper(trim('del estado trujillo'), 'UTF-8') }}</p>
                <p class="line-height">
                    {{ mb_strtoupper(trim('área de registro, seguimiento y control de estudios'), 'UTF-8') }}</p>
                <p class="line-height">{{ mb_strtoupper(trim('núcleo' . ' ' . $estudiante->nucleos->nucleo), 'UTF-8') }}
                </p>
            </td>
            <td class="fecha">
                <p style="margin: 0;">{{ $dia . ' / ' . $mes . ' / ' . $anio }}</p>
            </td>
        </tr>
    </table>
    <center>
        <p class="font-courier-bold text-xl">{{ mb_strtoupper(trim('récord académico'), 'UTF-8') }}</p>
    </center>
    <p class="line-height1">
        {{ mb_strtoupper(trim('código:'), 'UTF-8') }}
        <span class="underline-custom">{{ $estudiante->codigo }}</span>
        cédula:
        <span class="underline-custom1">
            @if ($estudiante['nacionalidad'] === 'VE')
                V{{ $estudiante['cedula'] }}
            @else
                E{{ $estudiante['cedula'] }}
            @endif
        </span>
        {{ mb_strtoupper(trim('nombre:'), 'UTF-8') }}
        <span class="underline-custom1">
            @if ($estudiante['segundo_apellido'] === null)
                {{ mb_strtoupper(trim($estudiante['primer_apellido'] . ', ' . $estudiante['primer_name'] . ' ' . $estudiante['segundo_name']), 'UTF-8') }}
            @else
                {{ mb_strtoupper(trim($estudiante['primer_apellido'] . ' ' . $estudiante['segundo_apellido'] . ', ' . $estudiante['primer_name'] . ' ' . $estudiante['segundo_name']), 'UTF-8') }}
            @endif
        </span>
    </p>
    <p class="line-height1">
        {{ mb_strtoupper(trim('carr.:'), 'UTF-8') }}
        <span class="underline-custom">
            {{ mb_strtoupper(trim($titulosacademicos->titulo . ' En ' . $carreras->carrera), 'UTF-8') }}</span>
    </p>
    <div class="border mt-2">
        <table class="min-w-full">
            <tbody>
                <tr>
                    <td colspan="5">
                        <p class="text-center my-0 font-courier-bold">
                            {{ mb_strtoupper(trim('asignaturas cursadas'), 'UTF-8') }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="text-center my-0 font-courier-bold">{{ mb_strtoupper(trim('sección'), 'UTF-8') }}</p>
                    </td>
                    <td>
                        <p class="text-center my-0 font-courier-bold">
                            {{ mb_strtoupper(trim('nombre de la asignatura'), 'UTF-8') }}</p>
                    </td>
                    <td>
                        <p class="text-center my-0 font-courier-bold">{{ mb_strtoupper(trim('uc'), 'UTF-8') }}</p>
                    </td>
                    <td>
                        <p class="text-center my-0 font-courier-bold">{{ mb_strtoupper(trim('regimen'), 'UTF-8') }}</p>
                    </td>
                    <td>
                        <p class="text-center my-0 font-courier-bold">{{ mb_strtoupper(trim('nota'), 'UTF-8') }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <table class="min-w-full">
            <tbody>
                @foreach ($notas->groupBy('periodo_id') as $periodoId => $nota)
                    <tr>
                        <td colspan="5" class="font-courier">
                            <p class="text-left my-0 font-courier-bold">
                                {{ mb_strtoupper(trim('lapso:'), 'UTF-8') . ' ' . $nota->first()->periodos->nombre }}
                            </p>
                        </td>
                    </tr>
                    @foreach ($nota as $note)
                        <tr>
                            <td class="ml-8 block">
                                <p class="text-left my-0">{{ $note->pensums->materias->codigo }}</p>
                            </td>
                            <td>
                                <p class="text-left my-0">
                                    {{ mb_strtoupper(trim($note->pensums->materias->materia), 'UTF-8') }}</p>
                            </td>
                            <td>
                                <p class="text-left my-0">{{ $note->pensums->materias->unidadcurricular }}</p>
                            </td>
                            <td class="w-300">
                                {{-- <p class="text-left my-0">{{ ' ' }}</p> --}}
                            </td>
                            <td>
                                @php
                                    $suma = $note->nota_uno + $note->nota_dos + $note->nota_tres + $note->nota_cuatro + $note->nota_extra;
                                    $definitiva = round($suma / 4);
                                @endphp
                                <p class="text-left my-0">{{ $definitiva }}</p>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <p>{{ ucwords('emitido por:') . ' ' . mb_strtoupper(trim($admin->estudios->abrev . ' ' . $admin['primer-name'] . ' ' . $admin['primer-apellido']), 'UTF-8') }}</p>
    </div>

</body>
</html>
