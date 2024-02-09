<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MisMarcadores</title>
    <link rel="icon" href="./assets/images/mis-marcadores-1.ico" type="image/x-icon">
    <link rel="shortcut icon" href="./assets/mis-marcadores-1.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
</head>

<body>
    <div class="container">
        <h1 class="title">Mis Marcadores</h1>
        <img src="../assets/images/mis-marcadores-1.ico" width="100px" /><br>


        <h2>Bienvenido Admin. Selecciona una opcion:</h2>
        <section class="section">
            <a href="./insertar.php">Insertar Partidos</a>
            <a href="./eliminar.php">Eliminar Partidos</a>
            <a href="./actualizar.php">Actualizar Partidos</a>
        </section>



        <a href="../index.php">
            <button class="boton-volver">Cerrar Sesion</button>
        </a>


    </div>
</body>

</html>