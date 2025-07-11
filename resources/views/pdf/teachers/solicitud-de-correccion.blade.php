<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Documento para solicitar corrección de notas</title>
</head>
<style>
    * {
        font-family: sans-serif;
        font-size: 15px;
    }

    .centrado {
        text-align: center;
    }

    .bold {
        font-weight: bold;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    td {
        border: 1px solid;
    }

    .uno {
        width: 150px;
    }

    .padding-7 {
        padding-left: 7px;
    }

    .mb-1 {
        padding-bottom: 150px;
    }

    .firma-linea {
        display: inline-block;
        position: relative;
        width: 300px;
        border-bottom: 1px solid;
        margin-top: 70px;
    }

    .leading-1 {
        line-height: 2px;
    }

    .leading-2 {
        line-height: 140%;
    }

    .subrayado {
        display: inline-block;
        position: relative;
        padding: 0 14px;
        margin-bottom: -3px;
        border-bottom: 1px solid;
        line-height: 8px;
    }

    .font-justify {
        text-align: justify;
    }

    .titulo-grande {
        font-size: 17px;
    }

    .w-50 {
        width: 50%;
    }

    .pagenum:before {
        content: counter(page);
    }

    .derecha {
        float: right;
    }

    .border-none {
        border: none;
    }
</style>

<body>
    <p class="centrado bold titulo-grande">{{ mb_strtoupper(trim('solicitud de corrección de notas'), 'UTF-8') }}</p>
    <table>
        <tr>
            <td class="uno padding-7">A:</td>
            <td class="dos bold padding-7 ">
                {{ ucwords(trim('jefe del departamento de registro, seguimiento y control de estudios')) }}</td>
        </tr>
        <tr>
            <td class="uno padding-7">{{ strtoupper('de:') }}</td>
            <td class="dos bold padding-7">{{ ucwords(trim($user['primer-name'] . ' ' . $user['primer-apellido'])) }}
            </td>
        </tr>
        <tr>
            <td class="uno padding-7">{{ strtoupper('fecha:') }}</td>
            <td class="dos bold padding-7">{{ ucwords(trim($day . ' de ' . $mes . ' ' . $anio)) }}</td>
        </tr>
    </table>
    <div>
        <div class="font-justify">
            <p class="leading-2">Yo,
                <span class="subrayado bold">
                    {{ ucwords(
                        $user['primer-name'] .
                            ' ' .
                            $user['segundo-name'] .
                            ' ' .
                            $user['primer-apellido'] .
                            ' ' .
                            $user['segundo-apellido'],
                    ) }}
                </span>
                @if ($user->nacionalidad === 'VE')
                    @if ($user->genero === 'masculino')
                        , Venezolano, Titular de la cédula de identidad N°.
                    @else
                        , Venezolana, Titular de la cédula de identidad N°.
                    @endif
                @else
                    @if ($user->genero === 'masculino')
                        , Extranjero, Titular de la cédula de identidad N°.
                    @else
                        , Extranjera, Titular de la cédula de identidad N°.
                    @endif
                @endif
                <span class="subrayado bold">
                    @if ($user->nacionalidad === 'VE')
                        {{ 'V-' . $user->cedula }}
                    @else
                        {{ 'E-' . $user->cedula }}
                    @endif
                </span>, Docente de ésta Universidad en la Unidad Curricular:
                <span class="subrayado bold">{{ ucwords($materias) }}</span> Sección:
                <span class="subrayado bold">{{ ucwords($estudiante->secciones->seccion) }}</span> en el Trayecto:
                @foreach ($estudiante->tramos->trayectos as $tramos)
                    <span
                        class="subrayado bold">{{ ucwords(preg_replace('/[^0-9]/', '', $tramos->trayectos)) }}</span>,
                    Tramo
                @endforeach
                <span
                    class="subrayado bold">{{ ucwords(preg_replace('/[^0-9]/', '', $estudiante->tramos->tramos)) }}</span>
                @if ($estudiante->genero === 'masculino')
                    hago constar que el estudiante:
                @else
                    hago constar que la estudiante:
                @endif
                <span
                    class="subrayado bold">{{ ucwords($estudiante->primer_name . ' ' . $estudiante->segundo_name . ' ' . $estudiante->primer_apellido . ' ' . $estudiante->segundo_apellido) }}</span>
                Cédula de identidad N°:
                <span class="subrayado bold">
                    @if ($estudiante->nacionalidad === 'VE')
                        {{ 'V-' . $estudiante->cedula }}
                    @else
                        {{ 'E-' . $estudiante->cedula }}
                    @endif
                </span> cursante de la carrera de:
                <span class="subrayado bold">{{ ucwords($estudiante->carreras->carrera) }}</span> quien reprobará o
                aprobará la Unidad Curricular en el periodo
                <span class="subrayado bold">{{ ucwords($periodo->nombre) }}</span>, con una calificación de
                <span class="subrayado bold">{{ ucwords($notaTexto) }}</span>
                <span class="subrayado bold">{{ '(' . $notas . ')' }}</span> puntos. Motivado a:
                <span class="subrayado bold">{{ ucwords($motivo) }}</span>
            </p>
        </div>
        <p>Agradezco efectuar la corrección en el sistema de control de notas de DRSCE.</p>
        <p>Sin más a que hacer referencia, me despido. Atentamente.</p>
        <div>
            <center>
                <span class="firma-linea"></span>
            </center>
            <p class="bold centrado leading-1">
                {{ ucwords(trim('firma docente: ' . $user['primer-name'] . ' ' . $user['primer-apellido'])) }}</p>
            <p class="bold centrado leading-1">
                @if ($user->nacionalidad === 'VE')
                    {{ mb_strtoupper(trim('c.i.n°: V-' . $user->cedula), 'UTF-8') }}
                @else
                    {{ mb_strtoupper(trim('c.i.n°: E-' . $user->cedula), 'UTF-8') }}
                @endif
            </p>
        </div>
    </div>
    <table>
        <tr>
            <td colspan="2" class="bold centrado">{{ mb_strtoupper(trim('autorizado por')) }}</td>
        </tr>
        <tr>
            <td class="bold centrado w-50">{{ mb_strtoupper(trim('coordinador del pnf')) }}</td>
            <td class="bold centrado w-50">{{ mb_strtoupper(trim('coordinador drsce / jefes de áreas'), 'UTF-8') }}
            </td>
        </tr>
        <tr>
            <td class="padding-7">{{ mb_strtoupper(trim('nombre:')) }}</td>
            <td class="padding-7">{{ mb_strtoupper(trim('nombre:')) }}</td>
        </tr>
        <tr>
            <td class="padding-7">{{ mb_strtoupper(trim('c.i:')) }}</td>
            <td class="padding-7">{{ mb_strtoupper(trim('c.i:')) }}</td>
        </tr>
        <tr>
            <td class="padding-7">{{ mb_strtoupper(trim('firma:')) }}</td>
            <td class="padding-7">{{ mb_strtoupper(trim('firma:')) }}</td>
        </tr>
        <tr>
            <td class="padding-7 mb-1">{{ mb_strtoupper(trim('sello')) }}</td>
            <td class="padding-7 mb-1">{{ mb_strtoupper(trim('sello')) }}</td>
        </tr>
    </table>
    <div>
        <p class="leading-1">Observación</p>
        <ul>
            <li>
                Ésta solicitud debe ir acompañada con la copia del acta de evaluación oficial del semestre que fue
                cursado por el estudiante.
            </li>
            <li>
                La corrección de notas deberá ser realizada por el docente de la asignatura en el trimestre inmediato
                posterior.
            </li>
        </ul>
        <hr>
        <p class="centrado border-none">{{ mb_strtoupper(trim('corrección válida sin enmiendas.'), 'UTF-8') }} <span
                class="derecha">Página <span class="pagenum"></span></span> </p>
    </div>

</body>

</html>
