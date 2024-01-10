<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección Administrativo</title>
    <?php include './elements-admin/import.php'; include './elements-admin/warning.php'?>
</head>
<body class="warning">
<script>
    alert('Esta Es Una Sección Solo Para Personal Autorizado');
</script>

<center>
    <h1 class="warni-icon"><i class="fa-solid fa-circle-radiation"></i></h1>
    <h1 class="warni-text">ADVERTENCIA</h1>
    <h1>Estas Entrando En La Sección De Administradores</h1>
    <h2>ÉSTA ES SOLO UNA SECCIÓN PARA PERSONAL AUTORIZADO <br><span class="advert-d"> Si Usted No Está Autorizado </span><span class="advert">Salga De Inmediato</span> </h2>
    <button class="exi" onclick="history.back()"><i class="fa-solid fa-person-walking-arrow-right"></i>Regresar</button>
    <button class="sub">Soy Administrador</button>

</center>

<script src="./js-admin/redireccion-to-admin.js"></script>
</body>
</html>
