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


        <h2>Actualizar Datos</h2>

        <?php
        $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
        $usuario = "root";
        $clave = "";

        try {
            $pdo = new PDO($cadena_conexion, $usuario, $clave);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Procesar el formulario de actualización
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && $_POST['submit'] == 'Guardar cambios') {
                // Obtener las ligas de los equipos seleccionados
                $equipo_local = $_POST['equipo_local'];
                $equipo_visitante = $_POST['equipo_visitante'];

                $stmt_liga_local = $pdo->prepare("SELECT id_liga FROM equipos WHERE id_equipo = :equipo_local");
                $stmt_liga_local->bindParam(':equipo_local', $equipo_local);
                $stmt_liga_local->execute();
                $liga_local = $stmt_liga_local->fetch(PDO::FETCH_COLUMN);

                $stmt_liga_visitante = $pdo->prepare("SELECT id_liga FROM equipos WHERE id_equipo = :equipo_visitante");
                $stmt_liga_visitante->bindParam(':equipo_visitante', $equipo_visitante);
                $stmt_liga_visitante->execute();
                $liga_visitante = $stmt_liga_visitante->fetch(PDO::FETCH_COLUMN);

                // Verificar si los equipos pertenecen a la misma liga
                if ($liga_local != $liga_visitante) {
                    echo "Los equipos seleccionados no pertenecen a la misma liga. No se pueden modificar.";
                } else {
                    // Continuar con el proceso de actualización
                    $id_partido = $_POST['id_partido'];
                    $resultado_local = $_POST['resultado_local'];
                    $resultado_visitante = $_POST['resultado_visitante'];
                    $fecha = $_POST['fecha'];

                    // Obtener los IDs de los equipos seleccionados
                    $equipo_local_id = $_POST['equipo_local'];
                    $equipo_visitante_id = $_POST['equipo_visitante'];

                    // Consulta de actualización
                    $sql_update = "UPDATE partidos SET id_equipo_local = :equipo_local, id_equipo_visitante = :equipo_visitante, resultado_local = :resultado_local, resultado_visitante = :resultado_visitante, fecha_partido = :fecha WHERE id_partido = :id_partido";
                    $stmt_update = $pdo->prepare($sql_update);
                    $stmt_update->bindParam(':equipo_local', $equipo_local_id, PDO::PARAM_INT);
                    $stmt_update->bindParam(':equipo_visitante', $equipo_visitante_id, PDO::PARAM_INT);
                    $stmt_update->bindParam(':resultado_local', $resultado_local, PDO::PARAM_INT);
                    $stmt_update->bindParam(':resultado_visitante', $resultado_visitante, PDO::PARAM_INT);
                    $stmt_update->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                    $stmt_update->bindParam(':id_partido', $id_partido, PDO::PARAM_INT);

                    // Ejecutar la consulta de actualización
                    if ($stmt_update->execute()) {
                        echo "Los cambios se han guardado correctamente.";
                    } else {
                        echo "Error al guardar los cambios.";
                    }
                }
            }

            // Mostrar el menú desplegable para seleccionar el partido
            echo "<form action='' method='post'>";
            echo "<h3>Selecciona el partido que deseas actualizar:</h3>";
            echo "<select name='partido_seleccionado'>";
            // Obtener los partidos existentes
            $sql_partidos = "SELECT p.id_partido, e1.nombre_equipo as equipo_local, e2.nombre_equipo as equipo_visitante FROM partidos p JOIN equipos e1 ON p.id_equipo_local = e1.id_equipo JOIN equipos e2 ON p.id_equipo_visitante = e2.id_equipo";
            $stmt_partidos = $pdo->query($sql_partidos);
            $partidos = $stmt_partidos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($partidos as $partido) {
                echo "<option value='{$partido['id_partido']}'>{$partido['equipo_local']} vs {$partido['equipo_visitante']}</option>";
            }
            echo "</select>";
            echo "<input type='submit' name='submit' value='Seleccionar partido'>";
            echo "</form>";

            // Mostrar el formulario de actualización si se ha seleccionado un partido
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['partido_seleccionado'])) {
                $id_partido_seleccionado = $_POST['partido_seleccionado'];

                // Obtener los detalles del partido seleccionado
                $sql_partido = "SELECT p.id_partido, e1.id_equipo as id_equipo_local, e1.nombre_equipo as equipo_local, e2.id_equipo as id_equipo_visitante, e2.nombre_equipo as equipo_visitante, e1.id_liga as liga_local, e2.id_liga as liga_visitante, p.resultado_local, p.resultado_visitante, p.fecha_partido FROM partidos p JOIN equipos e1 ON p.id_equipo_local = e1.id_equipo JOIN equipos e2 ON p.id_equipo_visitante = e2.id_equipo WHERE p.id_partido = :id_partido";
                $stmt_partido = $pdo->prepare($sql_partido);
                $stmt_partido->bindParam(':id_partido', $id_partido_seleccionado);
                $stmt_partido->execute();
                $detalles_partido = $stmt_partido->fetch(PDO::FETCH_ASSOC);

                // Obtener los equipos de la misma liga para los menús desplegables
                $sql_equipos_misma_liga = "SELECT * FROM equipos WHERE id_liga = :liga";
                $stmt_equipos_misma_liga = $pdo->prepare($sql_equipos_misma_liga);
                $stmt_equipos_misma_liga->bindParam(':liga', $detalles_partido['liga_local']);
                $stmt_equipos_misma_liga->execute();
                $equipos_misma_liga = $stmt_equipos_misma_liga->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar el formulario de actualización con equipos de la misma liga
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='id_partido' value='{$id_partido_seleccionado}'>";
                echo "Equipo Local: <select name='equipo_local'>";
                foreach ($equipos_misma_liga as $equipo) {
                    $selected = ($equipo['id_equipo'] == $detalles_partido['id_equipo_local']) ? "selected" : "";
                    echo "<option value='{$equipo['id_equipo']}' {$selected}>{$equipo['nombre_equipo']}</option>";
                }
                echo "</select><br>";

                echo "Equipo Visitante: <select name='equipo_visitante'>";
                foreach ($equipos_misma_liga as $equipo) {
                    $selected = ($equipo['id_equipo'] == $detalles_partido['id_equipo_visitante']) ? "selected" : "";
                    echo "<option value='{$equipo['id_equipo']}' {$selected}>{$equipo['nombre_equipo']}</option>";
                }
                echo "</select><br>";

                echo "Resultado Local: <input type='number' name='resultado_local' value='{$detalles_partido['resultado_local']}'><br>";
                echo "Resultado Visitante: <input type='number' name='resultado_visitante' value='{$detalles_partido['resultado_visitante']}'><br>";
                echo "Fecha del partido: <input type='date' name='fecha' value='{$detalles_partido['fecha_partido']}'><br>";

                echo "<input type='submit' name='submit' value='Guardar cambios'>";
                echo "</form>";
            }
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos: " . $e->getMessage();
        }
        ?>
        <a href="./partidosadmin.php">
            <button class="boton-volver">Volver atras</button>
        </a>
    </div>
</body>

</html>