<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MisMarcadores-Usuario</title>
        <link rel="icon" href="./assets/images/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="shortcut icon" href="./assets/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
    </head>
    <body>
        <div class="container">
            <h1 class="title">Mis Marcadores</h1>
            <a href="../index.php"><img src="../assets/images/mis-marcadores-1.ico" width="100px"/></a><br>


            <section class="section">
                <a href="./insertar.php">Insertar Partidos</a>
                <a href="./eliminar.php">Eliminar Partidos</a>
                <a href="./actualizar.php">Actualizar Partidos</a>
            </section>


            <?php
            setcookie("cookie_admin", "Cookie para el admin", time() + 3600, "/partidosadmin");
            ?>



        </div>
    </body>
</html>