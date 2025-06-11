<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cerrando...</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; text-align: center; padding-top: 50px; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; display: inline-block; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Este documento ha expirado.</h1>
        <p>Esta ventana se cerrará automáticamente.</p>
        <p>Si no se cierra, por favor, ciérrela manualmente.</p>
    </div>

    <script>
        alert('Usted acaba de recargar la página, así que se cerrará por seguridad. Si fue un error, por favor vuelva a generar el documento.');
        (function() {
            window.close();
        })();
    </script>

</body>
</html>
