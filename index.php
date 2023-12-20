<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <?php include 'elements/import.php' ?>
</head>
<body class="index">
<nav class="menu">
    <li class="m-home"><a href="#">Inicio</a></li>
    <li class="m-student"><a href="#">Estudiante</a></li>
    <li class="m-teacher"><a href="#">Profesor</a></li>
</nav>
<div class="bienvenida">
    <center>
        <h1>UNIVERSIDAD POLITÉCNICA TERRITORIAL DEL ESTADO TRUJILLO</h1>
        <h2>"MARIO BRICEÑO IRAGORRY"</h2>
    </center>
</div>
<section class="sec-about">
    <div class="s-about">
        <h1>Sobre Nosotros</h1>
        <p>La universidad Politécnica Territorial de Estado Trujillo “Mario Briceño Iragorry”, 
es una institución enmarcada dentro de la Educación Media General y de...</p>
        <a href="./about/about.php">Leer más<i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <div class="i-about">
        <img src="" alt="">
    </div>
</section>
<?php
include './elements/footer.php'
?>
</body>
</html>
