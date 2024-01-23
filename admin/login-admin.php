<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="./css-admin/estilos-login.css">
    <?php include './elements-admin/import.php'?>
    <script>
        console.warn("Cuidado Usuario");
        console.warn("Si eres un usuario normal POR FAVOR NO USES ESTA CONSOLA")
        console.log("%c%s","color:red;background-color:yellow;font-size:25px;border-radius:10px;padding:0px 7px 0px 7px;","Cuidado!!!");
        console.log("%c%s","font-size: 18px;","Si utilizas esta consola, otras personas podr\u00edan hacerse pasar por ti y robarte datos mediante un ataque Self-XSS.\nNo escribas ni pegues ning\u00fan c\u00f3digo que no entiendas.");
    </script>
</head>
<body>
<?php include './elements/nav.php'?>

<form action="" class="oculto">
<div class="signupop">
    <center><img src="./img-admin/logosystem.png" alt="" class="logosys"></center>
    <h1 class="tlog">Crear Cuenta Administrador</h1>
    <div class="formu">
        <input type="text" name="" id="" placeholder="Nombre" required>
        <input type="text" name="" id="" placeholder="Apellido" required>
        <input type="email" name="" id="" placeholder="Correo" required>
        <input type="number" name="" id="" placeholder="Teléfono" required maxlength="1">
        <input type="password" name="" id="pass1" placeholder="Contraseña" required>
        <input type="password" name="" id="pass1c" placeholder="Confirmar Contraseña" required>
        
        <div class="sigpass">
            <label for="checkbox1">
                <input type="checkbox" name="checkbox" id="checkbox1">
                Mostrar Contraseñas
            </label>
        </div>

        <input type="number" name="" id="" placeholder="Cédula" required>
        <input type="date" name="" id="" required>
        <div class="option">
            <div class="clean">
                <button type="reset"><span>Limpiar</span></button>
            </div>
            <div class="push">
                <button type="submit"><span>Siguiente</span><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <div class="loggo">
        <button type="button" class="swit">
            <span>Iniciar Sesión</span>
        </button>
    </div>
</div>
</form>
<form action="" class="logoa">
<div class="login">
    <center><img src="./img-admin/logosystem.png" alt="" class="logosys"></center>
    <h1 class="tlog">Iniciar Sesión Como Administrador</h1>
    <div class="relleno">
        <input type="email" name="" id="" placeholder="Correo o Usuario">
        <input type="password" name="" id="pass" placeholder="Ingrese Su Contraseña">
    </div>
    <div class="viewresc">
        <div class="logpass">
            <label for="checkbox">
                <input type="checkbox" name="" id="checkbox" class="check">
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
<?php include './elements-admin/minifoot.php'?>

<script src="./js-admin/showpassword.js"></script>
<script src="./js-admin/cambio.js"></script>
</body>
</html>
