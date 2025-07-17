<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récord Académico</title>
</head>

<body>
    <table>
        <tr>
            <td>
                <p>{{ mb_strtoupper(trim('universidad politécnica territorial'), 'UTF-8') }}</p>
                <p>{{ mb_strtoupper(trim('del estado trujillo'), 'UTF-8') }}</p>
                <p>{{ mb_strtoupper(trim('área de registro, seguimiento y control de estudios'), 'UTF-8') }}</p>
                <p>{{ mb_strtoupper(trim('núcleo '), 'UTF-8') }}</p>
            </td>
            <td>
                <p>{{ $dia . ' / ' . $mes . ' / ' . $anio }}</p>
            </td>
        </tr>
    </table>
    <center>
        <p>{{ ucwords('récord académico') }}</p>
    </center>
    <p>
        {{ mb_strtoupper(trim('código:'), 'UTF-8') }}
        <span>230</span>
        {{ mb_strtoupper(trim('cédula:'), 'UTF-8') }}
        <span>v29994791</span>
        {{ mb_strtoupper(trim('nombre:'), 'UTF-8') }}
        <span>gregorio rondon</span>
        {{ mb_strtoupper(trim('carr.:'), 'UTF-8') }}
        <span>ingeniro en informatica</span>
    </p>
    <table></table>
</body>

</html>
