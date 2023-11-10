<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MisMarcadores</title>
        <link rel="icon" href="./assets/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="shortcut icon" href="./assets/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    </head>
    <body>
    <container class="container">
        <h1 class="title">Mis Marcadores</h1>
        <?php
        //Conexion Base de Datos
        $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
        $usuario = "root";
        $clave = "";

        try {
            $bd = new PDO($cadena_conexion, $usuario, $clave);

            echo "Conexion Establecida";
        } catch (Exception $e) {
            echo "Error con la bd: " . $e->getMessage();
        }
        ?>
    </container>
    </body>
</html>



