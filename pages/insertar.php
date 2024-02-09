<?php
session_start();

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

        <h2>Insertar Datos</h2>
        <form action="insertar.php" method="post">
            <p>Competicion</p>
            <select id="competicion" name="competicion">
                <?php
                // Ejecutar la conexión a la base de datos
                $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
                $usuario = "root";
                $clave = "";

                try {
                    $pdo = new PDO($cadena_conexion, $usuario, $clave);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    echo "Error al conectar con la base de datos: " . $e->getMessage();
                }
                // Obtener las competiciones disponibles desde la base de datos
                $competiciones = obtenerCompeticiones($pdo);
                foreach ($competiciones as $competicion) {
                    echo "<option value='{$competicion['id_liga']}'>{$competicion['nombre_liga']}</option>";
                }
                ?>
            </select>
            <p>Equipo Local</p>
            <select id="equipolocal" name="equipolocal">
                <?php
                // Obtener todos los equipos disponibles desde la base de datos
                $equipos = obtenerEquipos($pdo);
                foreach ($equipos as $equipo) {
                    echo "<option value='{$equipo['id_equipo']}'>{$equipo['nombre_equipo']}</option>";
                }
                ?>
            </select>
            <p>Numero de Goles Local</p><input type="number" name="resultadolocal" required min="0">
            <p>Equipo Visitante</p>
            <select id="equipovisitante" name="equipovisitante">
                <?php
                // Volver a obtener todos los equipos disponibles desde la base de datos
                foreach ($equipos as $equipo) {
                    echo "<option value='{$equipo['id_equipo']}'>{$equipo['nombre_equipo']}</option>";
                }
                ?>
            </select>
            <p>Numero de Goles Visitante</p><input type="number" name="resultadovisitante" required min="0"><br>
            <p>Fecha del partido</p>
            <input type="date" name="fecha" required><br>
            <input type="submit" name="submit" value="Insertar">
        </form>

        <?php
        /**
         * Obtiene todas las competiciones de la base de datos.
         *
         * @param PDO $pdo El objeto PDO que representa la conexión a la base de datos.
         * @return array Retorna un array asociativo con la información de todas las competiciones, o un array vacío si no hay competiciones o hay un error.
         */
        function obtenerCompeticiones($pdo)
        {
            $sql = "SELECT * FROM ligas";
            $stmt = $pdo->query($sql);
            $competiciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $competiciones;
        }

        /**
         * Obtiene todos los equipos de la base de datos.
         *
         * @param PDO $pdo El objeto PDO que representa la conexión a la base de datos.
         * @return array Retorna un array asociativo con la información de todos los equipos, o un array vacío si no hay equipos o hay un error.
         */
        function obtenerEquipos($pdo)
        {
            $sql = "SELECT * FROM equipos";
            $stmt = $pdo->query($sql);
            $equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $equipos;
        }

        /**
         * Verifica si existe un partido entre dos equipos en la base de datos.
         *
         * @param PDO $pdo El objeto PDO que representa la conexión a la base de datos.
         * @param int $idEquipoLocal El ID del equipo local.
         * @param int $idEquipoVisitante El ID del equipo visitante.
         * @return bool Retorna true si existe un partido entre los equipos dados, false en caso contrario.
         */
        function existePartido($pdo, $idEquipoLocal, $idEquipoVisitante)
        {
            $sql = "SELECT COUNT(*) FROM partidos WHERE id_equipo_local = :idEquipoLocal AND id_equipo_visitante = :idEquipoVisitante";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idEquipoLocal', $idEquipoLocal, PDO::PARAM_INT);
            $stmt->bindParam(':idEquipoVisitante', $idEquipoVisitante, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }
        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener la liga seleccionada
            $idLigaSeleccionada = $_POST['competicion'];

            // Obtener el ID del equipo local y visitante seleccionados
            $idEquipoLocal = $_POST['equipolocal'];
            $idEquipoVisitante = $_POST['equipovisitante'];

            $fechaPartido = $_POST['fecha'];


            // Verificar si ya existe un partido con los mismos equipos local y visitante
            if (existePartido($pdo, $idEquipoLocal, $idEquipoVisitante)) {
                echo "<p>Ya existe un partido con los mismos equipos local y visitante.</p>";
            } else {
                // Verificar si los equipos seleccionados son diferentes
                if ($idEquipoLocal === $idEquipoVisitante) {
                    echo "<p>Los equipos local y visitante no pueden ser iguales.</p>";
                } else {
                    // Verificar si los equipos seleccionados pertenecen a la misma liga
                    if (!equiposEnMismaLiga($pdo, $idEquipoLocal, $idEquipoVisitante, $idLigaSeleccionada)) {
                        echo "<p>Los equipos seleccionados no pertenecen a la misma liga.</p>";
                    } else {
                        // Insertar el partido en la base de datos
                        $resultadoLocal = $_POST['resultadolocal'];
                        $resultadoVisitante = $_POST['resultadovisitante'];


                        // Preparar la consulta de inserción
                        $sql = "INSERT INTO partidos (id_equipo_local, id_equipo_visitante, resultado_local, resultado_visitante, fecha_partido) VALUES (:idEquipoLocal, :idEquipoVisitante, :resultadoLocal, :resultadoVisitante, :fechaPartido)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':idEquipoLocal', $idEquipoLocal, PDO::PARAM_INT);
                        $stmt->bindParam(':idEquipoVisitante', $idEquipoVisitante, PDO::PARAM_INT);
                        $stmt->bindParam(':resultadoLocal', $resultadoLocal, PDO::PARAM_INT);
                        $stmt->bindParam(':resultadoVisitante', $resultadoVisitante, PDO::PARAM_INT);
                        $stmt->bindParam(':fechaPartido', $fechaPartido, PDO::PARAM_STR);


                        // Ejecutar la consulta
                        if ($stmt->execute()) {
                            echo "<p>El partido se ha insertado correctamente.</p>";
                            echo "<br>";
                        } else {
                            echo "Error al insertar el partido.";
                        }
                    }
                }
            }
        }

        /**
         * Verifica si dos equipos pertenecen a la misma liga en la base de datos.
         *
         * @param PDO $pdo El objeto PDO que representa la conexión a la base de datos.
         * @param int $idEquipoLocal El ID del equipo local.
         * @param int $idEquipoVisitante El ID del equipo visitante.
         * @param int $idLigaSeleccionada El ID de la liga seleccionada.
         * @return bool Retorna true si los equipos pertenecen a la misma liga seleccionada, false en caso contrario.
         */
        function equiposEnMismaLiga($pdo, $idEquipoLocal, $idEquipoVisitante, $idLigaSeleccionada)
        {
            $sql = "SELECT id_liga FROM equipos WHERE id_equipo = :idEquipoLocal OR id_equipo = :idEquipoVisitante";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idEquipoLocal', $idEquipoLocal, PDO::PARAM_INT);
            $stmt->bindParam(':idEquipoVisitante', $idEquipoVisitante, PDO::PARAM_INT);
            $stmt->execute();
            $ligasEquipos = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Si los equipos tienen la misma liga que la seleccionada, devuelve true
            return count(array_unique($ligasEquipos)) === 1 && $ligasEquipos[0] == $idLigaSeleccionada;
        }
        ?>
        <a href="./partidosadmin.php">
            <button class="boton-volver">Volver atras</button>
        </a>
    </div>

</body>

</html>