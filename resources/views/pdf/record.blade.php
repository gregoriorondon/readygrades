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
                @if($estudiante && $estudiante->studentcodigonucleo->nucleo && $estudiante->studentcodigonucleo->nucleo)
                    <p class="line-height">{{ mb_strtoupper(trim('núcleo' . ' ' . $estudiante->studentcodigonucleo->nucleo->nucleo), 'UTF-8') }}</p>
                @elseif($estudiantePreSistema && $estudiantePreSistema->nucleos && $estudiantePreSistema->nucleos->nucleo)
                    <p class="line-height">{{ mb_strtoupper(trim('núcleo' . ' ' . $estudiantePreSistema->nucleos->nucleo), 'UTF-8') }}</p>
                @endif
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
        @if($estudiante && $estudiante->studentcodigonucleo->codigo)
            <span class="underline-custom">{{ $estudiante->studentcodigonucleo->codigo }}</span>
        @elseif($estudiantePreSistema && $estudiantePreSistema->codigo)
            <span class="underline-custom">{{ $estudiantePreSistema->codigo }}</span>
        @endif
        cédula:
        <span class="underline-custom1">
        @if($estudiante && $estudiante->studentcodigonucleo->student->nacionalidad)
            @if ($estudiante->studentcodigonucleo->student->nacionalidad === 'VE')
                V{{ $estudiante->studentcodigonucleo->student->cedula }}
            @else
                E{{ $estudiante['cedula'] }}
            @endif
        @elseif($estudiantePreSistema && $estudiantePreSistema->nacionalidad)
            @if ($estudiantePreSistema['nacionalidad'] === 'VE')
                V{{ $estudiantePreSistema['cedula'] }}
            @else
                E{{ $estudiantePreSistema['cedula'] }}
            @endif
        @endif
        </span>
        {{ mb_strtoupper(trim('nombre:'), 'UTF-8') }}
        <span class="underline-custom1">
            @if($estudiante)
                @if ($estudiante->studentcodigonucleo->student->segundo_apellido === null)
                    {{ mb_strtoupper(trim($estudiante->studentcodigonucleo->student->primer_apellido . ', ' . $estudiante->studentcodigonucleo->student->primer_name . ' ' . $estudiante->studentcodigonucleo->student->segundo_name), 'UTF-8') }}
                @else
                    {{ mb_strtoupper(trim($estudiante->studentcodigonucleo->student->primer_apellido . ' ' . $estudiante->studentcodigonucleo->student->segundo_apellido . ', ' . $estudiante->studentcodigonucleo->student->primer_name . ' ' . $estudiante->studentcodigonucleo->student->segundo_name), 'UTF-8') }}
                @endif
            @elseif($estudiantePreSistema && $estudiantePreSistema->segundo_apellido && $estudiantePreSistema->primer_apellido && $estudiantePreSistema->primer_name && $estudiantePreSistema->segundo_name)
                @if ($estudiantePreSistema['segundo_apellido'] === null)
                    {{ mb_strtoupper(trim($estudiantePreSistema['primer_apellido'] . ', ' . $estudiantePreSistema['primer_name'] . ' ' . $estudiantePreSistema['segundo_name']), 'UTF-8') }}
                @else
                    {{ mb_strtoupper(trim($estudiantePreSistema['primer_apellido'] . ' ' . $estudiantePreSistema['segundo_apellido'] . ', ' . $estudiantePreSistema['primer_name'] . ' ' . $estudiantePreSistema['segundo_name']), 'UTF-8') }}
                @endif
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
                @foreach ($notasCombinadas->groupBy('periodo_nombre') as $periodo => $nota)
                    <tr>
                        <td colspan="5" class="font-courier">
                            <p class="text-left my-0 font-courier-bold">
                                {{ mb_strtoupper(trim('lapso:'), 'UTF-8') . ' ' . $periodo }}
                            </p>
                        </td>
                    </tr>
                    @foreach ($nota as $note)
                        <tr>
                            <td class="ml-8 block">
                                <p class="text-left my-0">{{ $note->codigo }}</p>
                            </td>
                            <td>
                                <p class="text-left my-0">
                                    {{ mb_strtoupper(trim($note->materia), 'UTF-8') }}</p>
                            </td>
                            <td>
                                <p class="text-left my-0">{{ $note->uc }}</p>
                            </td>
                            <td class="w-300">
                                {{-- <p class="text-left my-0">{{ ' ' }}</p> --}}
                            </td>
                            <td>
                                <p class="text-left my-0">{{ $note->definitiva }}</p>
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
