<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acta de calification final</title>
</head>
<style>
    * {
        font-family: serif;
        font-size: 10px;
        letter-spacing: 1px;
    }

    .centrado {
        text-align: left;
        padding-left: 20px;
        font-weight: 700;
    }

    .titulo {
        font-family: serif;
        font-size: 12px;
        font-weight: 700;
        line-height: 3px;
    }

    .titulotd {
        width: 75%;
    }

    .titulodos {
        text-align: right;
        font-family: serif;
        font-size: 12px;
    }

    span {
        padding-left: 12px;
        padding-right: 12px;
        font-weight: 700;
    }

    .defi {
        font-size: 10px;
        text-align: center;
    }

    .datos {
        border-collapse: collapse;
        width: 100%;
    }

    .borde,
    th {
        border: 1px solid;
    }

    .nombre {
        width: fit-content;
        padding: auto 12px;

    }

    .por {
        font-size: 8px;
    }

    .cedula {
        width: fit-content;
        padding-left: 7px;
        padding-right: 7px;
        text-align: center;
    }

    .firma {
        display: inline-block;
        position: relative;
        margin-left: 10px;
        width: 100px;
        border-bottom: 1px solid;
    }

    .titulotabla {
        width: 100%;
    }

    .tipoevacol,
    .evaluiacioncol,
    .definitivacol,
    .notas,
    .numero,
    .cedula,
    .nombre,
    .nota {
        border: 1px solid;
        text-align: center;
    }

    .notas,
    .nota {
        width: fit-content;
        text-align: center;
        padding: auto 3px;
    }

    .nota {
        font-size: 8px;
    }

    .tdfecha {
        vertical-align: bottom;
    }

    .fecha {
        text-align: right;
    }

    .bold {
        font-weight: 700;
    }


    .light {
        font-weight: normal;
    }

    .numero {
        padding: 3px;
        width: 12px;
        font-weight: 700;
    }

    .tipoevacol {
        height: 12px;
    }

    .evaluiacioncol {
        height: 7px;
    }

    .definitivacol {
        height: 12px;
    }
</style>

<body>
    <!-- TITULO - CINTILLO -->
    <table class="datos">
        <tr>
            <td>
                <p class="titulo">{{ mb_strtoupper(trim('universidad politécnica territorial'), 'UTF-8') }}</p>
                <p class="titulo">{{ mb_strtoupper(trim('del estado trujillo'), 'UTF-8') }}</p>
                <p class="titulo">
                    {{ mb_strtoupper(trim('área de registro, seguimiento y control de estudios'), 'UTF-8') }}
                </p>
            </td>
            <td class="tdfecha">
                <p class="fecha">
                    {{ mb_strtoupper(trim(' fecha '), 'UTF-8') }}
                    <span>
                        {{ $dia . ' / ' . $mes . ' / ' . $anio }}
                    </span>
                </p>
            </td>
        </tr>
    </table>

    <!-- TITULO - NOMBRE DE LAPSO -->
    <table class="titulotabla">
        <tr>
            <td class="titulotd">
                <p class="titulodos">
                    {{ mb_strtoupper(trim('control de evaluación del rendimiento estudiantil'), 'UTF-8') }}
                </p>
            </td>
            <td class="centrado">
                <p>{{ mb_strtoupper(trim($lapso->nombre), 'UTF-8') }}</p>
            </td>
        </tr>
    </table>

    <!-- ASEIGNATURA SECCIONES Y DATOS DE ASIGNATURAS -->
    <p>
        {{ mb_strtoupper(trim('nombre de la asignatura '), 'UTF-8') }}
        <span>
            {{ mb_strtoupper(trim($materia), 'UTF-8') }}
        </span>
    </p>
    <p>
        {{ mb_strtoupper(trim('código de la asignatura'), 'UTF-8') }}
        <span>
            {{ mb_strtoupper(trim($codigo), 'UTF-8') }}
        </span>
        {{ mb_strtoupper(trim('sección'), 'UTF-8') }}
        <span>
            {{ mb_strtoupper(trim($seccion->seccion), 'UTF-8') }}
        </span>
        {{ mb_strtoupper(trim('u.c'), 'UTF-8') }}
        <span>{{ $unidad }}</span>
        {{ mb_strtoupper(trim('aula'), 'UTF-8') }}
        <span>{{ mb_strtoupper(trim($aula), 'UTF-8') }}</span>
    </p>
    <!-- PROFESOR - DOCENTE -->
    @if ($user->genero == 'masculino')
        <p>{{ mb_strtoupper(trim('nombre del docente '), 'UTF-8') }}
        @else
        <p>{{ mb_strtoupper(trim('nombre de la docente '), 'UTF-8') }}
    @endif
    <span>
        {{ mb_strtoupper(trim($user['primer-name'] . ' ' . $user['primer-apellido']), 'UTF-8') }}
    </span>
    {{ mb_strtoupper(trim(' cédula '), 'UTF-8') }}
    <span>
        {{ $user->cedula }}
    </span>
    {{ mb_strtoupper(trim('firma'), 'UTF-8') }}
    <span class="firma"></span>
    </p>
    <div>
        <!-- TODOS LOS DATOS DEL ESTUDIANTE -->
        <table class="datos">
            <thead>
                <tr>
                    <td colspan="3" rowspan="2" class="tipoevacol">
                        {{ mb_strtoupper(trim('tipo de evaluación'), 'UTF-8') }}
                    </td>
                    <td colspan="5" class="evaluiacioncol">
                        {{ mb_strtoupper(trim('continua'), 'UTF-8') }}
                    </td>
                    <td colspan="2" class="definitivacol" style="border-bottom: none;">
                        {{ mb_strtoupper(trim('definitiva'), 'UTF-8') }}
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="notas bold">
                        {{ mb_strtoupper(trim('e01'), 'UTF-8') }}
                        <br>
                        <span class="por light">
                            {{ mb_strtoupper(trim('25,00'), 'UTF-8') }}
                        </span>
                    </td>
                    <td rowspan="2" class="notas bold">
                        {{ mb_strtoupper(trim('e02'), 'UTF-8') }}
                        <br>
                        <span class="por light">
                            {{ mb_strtoupper(trim('25,00'), 'UTF-8') }}
                        </span>
                    </td>
                    <td rowspan="2" class="notas bold">
                        {{ mb_strtoupper(trim('e03'), 'UTF-8') }}
                        <br>
                        <span class="por light">
                            {{ mb_strtoupper(trim('25,00'), 'UTF-8') }}
                        </span>
                    </td>
                    <td rowspan="2" class="notas bold">
                        {{ mb_strtoupper(trim('e04'), 'UTF-8') }}
                        <br>
                        <span class="por light">
                            {{ mb_strtoupper(trim('25,00'), 'UTF-8') }}
                        </span>
                    </td>
                    <td rowspan="2" class="notas bold">
                        {{ mb_strtoupper(trim('EXTRA'), 'UTF-8') }}
                        <br>
                        <span class="por light">
                            {{ mb_strtoupper(trim(''), 'UTF-8') }}
                        </span>
                    </td>
                    <td class="defi">
                        {{ mb_strtoupper(trim('acum'), 'UTF-8') }}
                    </td>
                    <td class="defi" style="border-right: 1px solid;">
                        {{ mb_strtoupper(trim('def'), 'UTF-8') }}
                    </td>
                </tr>
                <tr>
                    <td class="numero bold">
                        {{ mb_strtoupper(trim('n°'), 'UTF-8') }}
                    </td>
                    <td class="cedula bold">
                        {{ mb_strtoupper(trim('cédula'), 'UTF-8') }}
                    </td>
                    <td class="nombre bold">
                        {{ mb_strtoupper(trim('apellidos y nombres'), 'UTF-8') }}
                    </td>
                    <td class="nota">
                        {{ mb_strtoupper(trim('extra'), 'UTF-8') }}
                    </td>
                    <td class="nota">
                        {{ mb_strtoupper(trim('20'), 'UTF-8') }}
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($notasPorEstudiante as $notas)
                    <tr>
                        <td class="numero borde">{{ $loop->iteration }}</td>
                        <td class="cedula borde">{{ $notas->students->cedula }}</td>
                        <td class="nombre borde">
                            {{ $notas->students->primer_apellido .
                                ' ' .
                                $notas->students->segundo_apellido .
                                ' ' .
                                $notas->students->primer_name .
                                ' ' .
                                $notas->students->segundo_name }}
                        </td>
                        <td class="notas borde">{{ $notas->nota_uno }}</td>
                        <td class="notas borde">{{ $notas->nota_dos }}</td>
                        <td class="notas borde">{{ $notas->nota_tres }}</td>
                        <td class="notas borde">{{ $notas->nota_cuatro }}</td>
                        <td class="notas borde">{{ $notas->nota_extra }}</td>
                        @php
                            $notasuma =
                                $notas->nota_uno +
                                $notas->nota_dos +
                                $notas->nota_tres +
                                $notas->nota_cuatro +
                                $notas->nota_extra;
                            $notaDefinitiva = round($notasuma / 4);
                            $notaDefinitivaTotal = $notasuma / 4;
                        @endphp
                        <td class="nota borde">{{ $notaDefinitivaTotal }}</td>
                        <td class="nota borde">{{ $notaDefinitiva }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
