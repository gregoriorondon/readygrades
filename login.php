<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <?php include './elements/import.php'?>
    <script src="./js/showpassword.js"></script>
    <script>
        console.warn("Cuidado Usuario");
        console.warn("Si eres un usuario normal POR FAVOR NO USES ESTA CONSOLA")
        console.log("%c%s","color:red;background-color:yellow;font-size:25px;border-radius:10px;padding:0px 7px 0px 7px;","Cuidado!!!");
        console.log("%c%s","font-size: 18px;","Si utilizas esta consola, otras personas podr\u00edan hacerse pasar por ti y robarte datos mediante un ataque Self-XSS.\nNo escribas ni pegues ning\u00fan c\u00f3digo que no entiendas.");
    </script>
</head>
<body class="cuerpo">
<?php include './elements/nav.php'?>
<div class="login">
    <div class="relleno">
        <input type="email" name="" id="" placeholder="Correo o usuario">
        <input type="password" name="" id="pass" placeholder="Contraseña">
    </div>
    <div class="view">
        <input type="checkbox" name="" id="" onclick="mostrar();">
        <label for="checkbox">Mostrar Contraseña</label>
    </div>
    <div class="oplog">
        <button type="submit" id="submit">Entrar<i class="fa-solid fa-arrow-right"></i></button>
    </div>
   </div>


</body>
</html>