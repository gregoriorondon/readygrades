<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <?php include './elements/import.php'?>
    <script>
        console.warn("Cuidado Usuario");
        console.warn("Si eres un usuario normal POR FAVOR NO USES ESTA CONSOLA")
        console.log("%c%s","color:red;background-color:yellow;font-size:25px;border-radius:10px;padding:0px 7px 0px 7px;","Cuidado!!!");
        console.log("%c%s","font-size: 18px;","Si utilizas esta consola, otras personas podr\u00edan hacerse pasar por ti y robarte datos mediante un ataque Self-XSS.\nNo escribas ni pegues ning\u00fan c\u00f3digo que no entiendas.");
    </script>
</head>
<body class="cuerpo">
<?php include './elements/nav.php'?>
<form action="" class="crecu">
<div class="signupop">
    <center><img src="./img/logosystem.png" alt="" class="logosys"></center>
    <h1 class="tlog">Crear Cuenta</h1>
    <div class="formu">
        <input type="text" name="" id="" placeholder="Nombre">
        <input type="text" name="" id="" placeholder="Apellido">
        <input type="email" name="" id="" placeholder="Correo">
        <input type="number" name="" id="" placeholder="Teléfono">
        <input type="password" name="" id="" placeholder="Contraseña">
        <input type="password" name="" id="" placeholder="Confirmar Contraseña">
        
        <label for="checkbox1"><input type="checkbox" name="checkbox1" id="">Mostrar Contraseñas</label>
        <input type="number" name="" id="" placeholder="Cédula">
        <input type="date" name="" id="">
        <input type="reset" value="Limpiar">
        <button>Siguiente</button>
    </div>
    <div class="loggo">
        <button type="button" class="swit">
            <span>Iniciar Sesión</span>
        </button>
    </div>
</div>
</form>
<form action="" class="logop">
<div class="login">
    <center><img src="./img/logosystem.png" alt="" class="logosys"></center>
    <h1 class="tlog">Iniciar Sesión</h1>
    <div class="relleno">
        <input type="email" name="" id="" placeholder="Correo o Usuario">
        <input type="password" name="" id="pass" placeholder="Ingrese Su Contraseña">
    </div>
    <div class="viewresc">
        <div class="logpass">
            <label for="checkbox">
                <input type="checkbox" name="" id="checkbox" onclick="mostrar();">
                    Mostrar Contraseña
            </label>
        </div>
        <div class="dvspresc">
            <button class="teresc">Recuperar Cuenta</button>
        </div>
    </div>
    <div class="signsigentr">
        <div class="oplog">
            <button type="submit" id="submit">Entrar<i class="fa-solid fa-arrow-right"></i></button>
        </div>
        <div class="signup">
            <button type="button" class="busignup">
                <span class="spabusignup">Crear Cuenta</span>
            </button>
        </div>
    </div>
</div>
</form>
<div class="minifoot">
    <span>SISTEMA DESARROLLADO POR GREGORIO RONDÓN, CARLOS RAMOS Y YANITZA BARRIGA</span>
</div>
<script src="./js/showpassword.js"></script>

<script src="./js/logcre.js"></script>

</body>
</html>
