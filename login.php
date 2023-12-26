<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <?php include './elements/import.php'?>
</head>
<body class="cuerpo">
<?php include './elements/nav.php'?>
<div class="login">
    <input type="email" name="" id="" placeholder="Correo o usuario">
    <input type="password" name="" id="pass" placeholder="Contraseña">
    <input type="checkbox" name="" id="" onclick="mostrar();">
    <label for="checkbox">Mostrar</label>
    <button type="submit" id="submit">Entrar<i class="fa-solid fa-arrow-right"></i></button>
</div>
<script src="./js/showpassword.js"></script>
</body>
</html>
