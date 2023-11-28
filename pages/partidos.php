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
            <h2 class="h2">Selecciona una competicion</h2>
            <form action="partidos.php" method="post">
                <input type="submit" name="bundesliga" value="Bundesliga" class="input"><br>
                <input type="submit" name="premier" value="Premier League" class="input"><br>
                <input type="submit" name="laliga" value="La Liga EASPORTS" class="input">

            </form>
            <?php
            //Pagina para usuarios
            //----------------DATOS BUNDESLIGA--------------
            if (isset($_POST['bundesliga'])) {
                //Conexion Base de Datos
                $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
                $usuario = "root";
                $clave = "";

                try {
                    $bd = new PDO($cadena_conexion, $usuario, $clave);

                    $consulta = $bd->prepare("SELECT * FROM bundesliga");
                    $consulta->execute();

                    // Obtiene la información de las columnas
                    $columnas = $consulta->getColumnMeta(0);

                    // Obtiene el nombre de la tabla
                    $nombre_tabla = $columnas['table'];

                    // Vuelve a ejecutar la consulta para obtener los resultados
                    $consulta->execute();
                    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    echo "<p class='competicion'>Competicion: " . $nombre_tabla . "</p>";
                    echo "<img src='../assets/images/Bundesliga-Logo-izq.png' width='155px'>";
                    echo "<table class='table'>";
                    foreach ($resultados as $fila) {

                        echo "<tr>";
                        echo "<td>" . $fila['equipolocal'] . "</td>";
                        echo "<td>" . $fila ['resultadolocal'] . "</td>";
                        echo "<td>" . $fila['resultadovisitante'] . "</td>";
                        echo "<td>" . $fila['equipovisitante'] . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } catch (Exception $e) {
                    echo "Error con la bd: " . $e->getMessage();
                }
            }

            //---------------DATOS PREMIER LEAGUE---------------
            if (isset($_POST['premier'])) {
                //Conexion Base de Datos
                $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
                $usuario = "root";
                $clave = "";

                try {
                    $bd = new PDO($cadena_conexion, $usuario, $clave);

                    $consulta = $bd->prepare("SELECT * FROM premierleague");
                    $consulta->execute();

                    // Obtiene la información de las columnas
                    $columnas = $consulta->getColumnMeta(0);

                    // Obtiene el nombre de la tabla
                    $nombre_tabla = $columnas['table'];

                    // Vuelve a ejecutar la consulta para obtener los resultados
                    $consulta->execute();
                    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    echo "<p class='competicion'>Competicion: " . $nombre_tabla . "</p>";
                    echo "<img src='../assets/images/premierleague.png' width='155px'>";
                    echo "<table class='table'>";
                    foreach ($resultados as $fila) {

                        echo "<tr>";
                        echo "<td>" . $fila['equipolocal'] . "</td>";
                        echo "<td>" . $fila['resultadolocal'] . "</td>";
                        echo "<td>" . $fila['resultadovisitante'] . "</td>";
                        echo "<td>" . $fila['equipovisitante'] . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } catch (Exception $e) {
                    echo "Error con la bd: " . $e->getMessage();
                }
            }

            //-------------DATOS LALIGA---------------
            if (isset($_POST['laliga'])) {
                //Conexion Base de Datos
                $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
                $usuario = "root";
                $clave = "";

                try {
                    $bd = new PDO($cadena_conexion, $usuario, $clave);

                    $consulta = $bd->prepare("SELECT * FROM laligaeasports");
                    $consulta->execute();

                    // Obtiene la información de las columnas
                    $columnas = $consulta->getColumnMeta(0);

                    // Obtiene el nombre de la tabla
                    $nombre_tabla = $columnas['table'];

                    // Vuelve a ejecutar la consulta para obtener los resultados
                    $consulta->execute();
                    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    echo "<p class='competicion'>Competicion: $nombre_tabla</p>";
                    echo "<img src='../assets/images/laliga.png' width='155px'>";
                    echo "<table class='table'>";
                    foreach ($resultados as $fila) {

                        echo "<tr>";
                        echo "<td>" . $fila['equipolocal'] . "</td>";
                        echo "<td>" . $fila['resultadolocal'] . "</td>";
                        echo "<td>" . $fila['resultadovisitante'] . "</td>";
                        echo "<td>" . $fila['equipovisitante'] . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } catch (Exception $e) {
                    echo "Error con la bd: " . $e->getMessage();
                }
            }
            ?>


        </div>
    </body>
</html>



