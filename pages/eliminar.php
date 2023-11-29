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
            <a href="./partidosadmin.php"><img src="../assets/images/mis-marcadores-1.ico" width="100px"/></a><br>



            <h2>Eliminar Datos</h2>
            <form action="eliminar.php" method="post">
                <h3>Introduce primero el nombre de la competicion</h3>
                <input type="text" name='competicion' required="" placeholder="Competicion">
                <p>Eliminar por Equipo Local</p><input type="text" name="equipolocal" placeholder="Nombre Equipo Local">
                <p>Eliminar por Numero de Goles Local</p><input type="text" name="resultadolocal" placeholder="Numero de Goles Locales">
                <p>Eliminar por Equipo Visitante</p><input type="text" name="equipovisitante" placeholder="Nombre Equipo Visitante">
                <p>Eliminar por Numero de Goles Visitante</p><input type="text" name="resultadovisitante" placeholder="Numero Goles Visitantes"><br>

                <input type="submit" name="submit" value="Eliminar">
            </form>


            <?php
            //Conexion Base de Datos
            $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
            $usuario = "root";
            $clave = "";

            try {
                $pdo = new PDO($cadena_conexion, $usuario, $clave);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //BORRAR POR NOMBRE DE EQUIPO LOCAL
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST['equipolocal']) && !empty($_POST['equipolocal']) && isset($_POST['competicion']) && !empty($_POST['competicion'])) {

                        // Recuperar y validar el dato del formulario
                        $equipolocal = ($_POST['equipolocal']);
                        $competicion = ($_POST['competicion']);

                        try {
                            $pdo = new PDO($cadena_conexion, $usuario, $clave);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            
                            $sql = "DELETE FROM $competicion WHERE equipolocal = :equipolocal";

                            $stmt = $pdo->prepare($sql);

                            
                            $stmt->bindParam(':equipolocal', $equipolocal, PDO::PARAM_STR);

                            // Ejecutar la consulta
                            $stmt->execute();

                            
                            header("Location: partidos.php");
                            exit();
                        } catch (Exception $e) {
                            echo "Error en la eliminación: ";
                        }
                    }
                }



                //BORRAR POR NUMERO DE GOLES LOCALES
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST['resultadolocal']) && ($_POST['resultadolocal']) && isset($_POST['competicion']) && !empty($_POST['competicion'])) {


                        $resultadolocal = $_POST['resultadolocal'];
                        $competicion = ($_POST['competicion']);

                        try {
                            $pdo = new PDO($cadena_conexion, $usuario, $clave);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "DELETE FROM $competicion WHERE resultadolocal = :resultadolocal";

                            $stmt = $pdo->prepare($sql);

                            $stmt->bindParam(':resultadolocal', $resultadolocal, PDO::PARAM_INT);

                            // Ejecutar la consulta
                            $stmt->execute();

                            header("Location: partidos.php");
                            exit();
                        } catch (Exception $e) {
                            echo "Error en la eliminación ";
                        }
                    }
                }

                //BORRAR POR NOMBRE DE EQUIPO VISITANTE
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST['equipovisitante']) && !empty($_POST['equipovisitante']) && isset($_POST['competicion']) && !empty($_POST['competicion'])) {


                        $equipovisitante = ($_POST['equipovisitante']);
                        $competicion = ($_POST['competicion']);

                        try {
                            $pdo = new PDO($cadena_conexion, $usuario, $clave);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "DELETE FROM $competicion WHERE equipovisitante = :equipovisitante";

                            $stmt = $pdo->prepare($sql);

                            $stmt->bindParam(':equipovisitante', $equipovisitante, PDO::PARAM_STR);

                            // Ejecutar la consulta
                            $stmt->execute();

                            header("Location: partidos.php");
                            exit();
                        } catch (Exception $e) {
                            echo "Error en la eliminación";
                        }
                    }
                }

                //BORRAR POR EQUIPO VISITANTE
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST['resultadovisitante']) && ($_POST['resultadovisitante']) && isset($_POST['competicion']) && !empty($_POST['competicion'])) {


                        $resultadovisitante = $_POST['resultadovisitante'];
                        $competicion = ($_POST['competicion']);

                        try {
                            $pdo = new PDO($cadena_conexion, $usuario, $clave);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "DELETE FROM $competicion WHERE resultadovisitante = :resultadovisitante";

                            $stmt = $pdo->prepare($sql);

                            $stmt->bindParam(':resultadovisitante', $resultadovisitante, PDO::PARAM_INT);

                            // Ejecutar la consulta
                            $stmt->execute();

                            header("Location: partidos.php");
                            exit();
                        } catch (Exception $e) {
                            echo "Error en la eliminación";
                        }
                    }
                }
            } catch (Exception $e) {
                echo "La base de datos está actualmente en mantenimiento, vuelva a intentarlo más tarde";
            }
            ?>





        </div>
    </body>
</html>