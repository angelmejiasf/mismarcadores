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

        <h2>Eliminar Datos</h2>
        <form action="" method="post">
            <h3>Selecciona el partido que deseas eliminar:</h3>
            <select name="partido_eliminar">
                <?php
                // Conexión a la base de datos
                $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
                $usuario = "root";
                $clave = "";

                try {
                    $pdo = new PDO($cadena_conexion, $usuario, $clave);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Obtener los partidos existentes
                    $sql_partidos = "SELECT p.id_partido, e1.nombre_equipo as equipo_local, e2.nombre_equipo as equipo_visitante FROM partidos p JOIN equipos e1 ON p.id_equipo_local = e1.id_equipo JOIN equipos e2 ON p.id_equipo_visitante = e2.id_equipo";
                    $stmt_partidos = $pdo->query($sql_partidos);
                    $partidos = $stmt_partidos->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($partidos as $partido) {
                        echo "<option value='{$partido['id_partido']}'>{$partido['equipo_local']} vs {$partido['equipo_visitante']}</option>";
                    }
                } catch (PDOException $e) {
                    echo "Error al conectar con la base de datos: " . $e->getMessage();
                }
                ?>
            </select>
            <input type="submit" name="submit" value="Eliminar partido">
        </form>

        <?php
        // Procesar la solicitud de eliminación
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && $_POST['submit'] == 'Eliminar partido') {
            // Obtener el ID del partido a eliminar
            $partido_eliminar = $_POST['partido_eliminar'];

            // Verificar si se seleccionó un partido
            if (!empty($partido_eliminar)) {
                try {
                    // Preparar la consulta de eliminación
                    $sql_eliminar = "DELETE FROM partidos WHERE id_partido = :id_partido";
                    $stmt_eliminar = $pdo->prepare($sql_eliminar);
                    $stmt_eliminar->bindParam(':id_partido', $partido_eliminar, PDO::PARAM_INT);

                    // Ejecutar la consulta de eliminación
                    if ($stmt_eliminar->execute()) {
                        echo "<p>El partido ha sido eliminado correctamente.</p>";
                    } else {
                        echo "<p>Error al intentar eliminar el partido.</p>";
                    }
                } catch (PDOException $e) {
                    echo "Error en la eliminación: " . $e->getMessage();
                }
            } else {
                echo "<p>Por favor, selecciona un partido para eliminar.</p>";
            }
        }
        ?>
        <a href="./partidosadmin.php">
            <button class="boton-volver">Volver atras</button>
        </a>
        <a href="./sesion_logout.php">
            <button class="boton-volver">Cerrar Sesion</button>
        </a>
    </div>

</body>

</html>