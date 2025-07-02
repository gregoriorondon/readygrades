<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acta de calification final</title>
</head>
<style>
    * {
        font-family: sans-serif;
    }

    .centrado {
        text-align: center;
    }

    span {
        padding-left: 77px;
        padding-right: 77px;
        border-bottom: 1px solid;
    }

    table {
        border-collapse: collapse;
    }

    td {}

    th {
        padding-top: 12px;
        padding-bottom: 12px;
    }

    td,
    th {
        border: 1px solid;
    }

    .numero {
        width: 50px;
        text-align: center;
    }

    .nombre {
        width: 500px;
        padding: 3px 12px;

    }

    .cedula {
        width: 200px;
        text-align: center;
    }

    .notas,
    .nota {
        width: 100px;
        text-align: center;
    }
    .fecha{
        padding-left: 40px;
        padding-right: 10px;
    }
    .fechados{
        padding-left: 30;
        padding-right: 80px;
    }
</style>

<body>
    <p class="centrado">{{ mb_strtoupper(trim('acta de calificación final.'), 'UTF-8') }}</p>
    <p>{{ mb_strtoupper(trim('carrera: '), 'UTF-8') }} <span>{{ mb_strtoupper('  ') }}</span>
        {{ mb_strtoupper(trim(' asignatura: '), 'UTF-8') }} <span>{{ mb_strtoupper('  ') }}</span>
        {{ mb_strtoupper(trim('código'), 'UTF-8') }} <span>{{ mb_strtoupper('  ') }}</span> </p>
    @if ($user->genero == 'masculino')
        <p>{{ mb_strtoupper(trim('profesor: '), 'UTF-8') }}
        @else
        <p>{{ mb_strtoupper(trim('profesora: '), 'UTF-8') }}
    @endif
    <span>{{ mb_strtoupper(' ') }}</span>
    {{ mb_strtoupper(trim(' cédula: '), 'UTF-8') }} <span>{{ mb_strtoupper('  ') }}</span> </p>
    <p>{{ mb_strtoupper(trim('lapso académico: '), 'UTF-8') }}
        <span>{{ mb_strtoupper(' ') }}</span>
        {{ mb_strtoupper(trim(' fecha: '), 'UTF-8') }} <span class="fecha">{{ '     /' }}</span><span class="fechados">{{ '     /' }}</span>
    </p>
    <div>
        <table>
            <thead>
                <tr>
                    <th class="numero">{{ mb_strtoupper(trim('n'), 'UTF-8') }}</th>
                    <th class="nombre">{{ mb_strtoupper(trim('apellidos y nombres'), 'UTF-8') }}</th>
                    <th class="cedula">{{ mb_strtoupper(trim('cédula'), 'UTF-8') }}</th>
                    <th class="notas">{{ mb_strtoupper(trim('calif. numérica'), 'UTF-8') }}</th>
                    <th class="nota">{{ mb_strtoupper(trim('calif. en letra'), 'UTF-8') }}</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($nombres); $i++)
                    <tr>
                        <td class="numero">{{ $i + 1 }}</td>
                        <td class="nombre">{{ trim($apellidos[$i]) . ' ' . trim($nombres[$i]) }}</td>
                        <td class="cedula">{{ $cedulas[$i] }}</td>
                        <td class="notas">null</td>
                        <td class="nota">null</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</body>

</html>
