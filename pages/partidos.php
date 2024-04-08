<?php

session_start();


if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

?>


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
        <img src="../assets/images/mis-marcadores-1.ico" width="100px" /><br>


        <?php


        // Conexion a la base de datos
        $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
        $usuario = "root";
        $clave = "";

        try {
            $bd = new PDO($cadena_conexion, $usuario, $clave);

            // Mostrar partidos de Bundesliga
            $consulta = $bd->prepare("SELECT * FROM partidos WHERE id_equipo_local IN (9, 10, 11, 12) OR id_equipo_visitante IN (9, 10, 11, 12)");
            mostrarPartidos($consulta, "Bundesliga");

            // Mostrar partidos de Premier League
            $consulta = $bd->prepare("SELECT * FROM partidos WHERE id_equipo_local IN (5, 6, 7, 8) OR id_equipo_visitante IN (5, 6, 7, 8)");
            mostrarPartidos($consulta, "Premier League");

            // Mostrar partidos de La Liga EASPORTS
            $consulta = $bd->prepare("SELECT * FROM partidos WHERE id_equipo_local IN (1, 2, 3, 4) OR id_equipo_visitante IN (1, 2, 3, 4)");
            mostrarPartidos($consulta, "La Liga EASPORTS");
        } catch (Exception $e) {
            echo "Error con la bd: " . $e->getMessage();
        }


        /**
         * Muestra los partidos de una competición dada en una tabla HTML.
         *
         * @param PDOStatement $consulta El objeto de consulta PDO que contiene los resultados de la búsqueda de partidos.
         * @param string $nombreCompeticion El nombre de la competición a la que pertenecen los partidos.
         * @return void
         */
        function mostrarPartidos($consulta, $nombreCompeticion)
        {
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2 class='competicion'>" . $nombreCompeticion . "</h2>";
            echo "<table class='table'>";
            foreach ($resultados as $fila) {
                echo "<tr>";
                echo "<td>" . obtenerNombreEquipo($fila['id_equipo_local']) . "</td>";
                echo "<td>" . $fila['resultado_local'] . "</td>";
                echo "<td>" . $fila['resultado_visitante'] . "</td>";
                echo "<td>" . obtenerNombreEquipo($fila['id_equipo_visitante']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        /**
         * Obtiene el nombre de un equipo a partir de su ID en la base de datos.
         *
         * @param int $idEquipo El ID del equipo a buscar.
         * @param PDO $bd El objeto PDO que representa la conexión a la base de datos.
         * @return string|bool Retorna el nombre del equipo si se encuentra, o false si ocurre un error.
         */
        function obtenerNombreEquipo($idEquipo)
        {
            global $bd;
            $consulta = $bd->prepare("SELECT nombre_equipo FROM equipos WHERE id_equipo = :idEquipo");
            $consulta->bindParam(':idEquipo', $idEquipo);
            $consulta->execute();
            $equipo = $consulta->fetch(PDO::FETCH_ASSOC);
            return $equipo['nombre_equipo'];
        }
        ?>
        <a href="./sesion_logout.php">
            <button class="boton-volver">Cerrar Sesion</button>
        </a>
    </div>
</body>

</html>