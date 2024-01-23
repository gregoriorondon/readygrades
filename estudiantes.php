<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    <?php include './elements/import.php'?>
    <script>
        console.warn("Cuidado Usuario");
        console.warn("Si eres un usuario normal POR FAVOR NO USES ESTA CONSOLA")
        console.log("%c%s","color:red;background-color:yellow;font-size:25px;border-radius:10px;padding:0px 7px 0px 7px;","Cuidado!!!");
        console.log("%c%s","font-size: 18px;","No utilices esta consola, no escribas ni pegues ning\u00fan c\u00f3digo o script.");
    </script>
</head>
<body class="cuerpo">
<?php include './elements/nav.php'?>

<form action="">

<div class="stud">
    <center class="log1">
        <img src="./img/logosystem.png" alt="">
        <img src="./img/logouptt.png" alt="">
    </center>
    <div class="log">
        <input type="number" name="" id="" placeholder="Inserte su Cedula de Identidad">
        <button type="submit">Enviar</button>
    </div>
    <div class="warni">
        <span class="war1">Tenga en cuenta que si intenta copiar o tomar alguna foto de las notas que quiere visualizar</span>
        <span class="war2">NO TIENEN NINGÚN VALOR ACADÉMICO</span>
    </div>
</div>
</form>
<?php include './elements/minifoot.php'?>

</body>
</html>
