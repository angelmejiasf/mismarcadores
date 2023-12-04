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



            <h2>Actualizar Datos</h2>
            <form action="actualizar.php" method="post">
                <h3>Introduce primero el nombre de la competicion</h3>
                <input type="text" name='competicion' required="" placeholder="Competicion">
                <p>Equipo Local que quieres modificar</p><input type="text" name="equipolocal" placeholder="Nombre Equipo Local">
                <p>Nuevo Equipo Local</p><input type="text" name="nuevo_valor_local" placeholder="Nuevo equipo local">

                <p>Numero de goles local que quieres modificar</p><input type="number" name="resultadolocal" placeholder="Numero de Goles Locales">
                <p>Nuevo numero de goles local</p><input type="number" name="nuevo_valor_gol_local" placeholder="Nuevo numero de goles local">

                <p>Equipo visitante que quieres actualizar</p><input type="text" name="equipovisitante" placeholder="Nombre Equipo Visitante">
                <p>Nuevo Equipo Visitante</p><input type="text" name="nuevo_valor_visitante" placeholder="Nuevo Equipo Visitante">

                <p>Numero de goles visitante que quieres modificar</p><input type="number" name="resultadovisitante" placeholder="Numero Goles Visitantes"><br>
                <p>Nuevo numero de goles visitante</p><input type="number" name="nuevo_valor_gol_visitante" placeholder="Nuevo Numero Goles Visitantes"><br>

                <input type="submit" name="submit" value="Actualizar">
            </form>


            <?php
            //Conexion Base de Datos
            $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
            $usuario = "root";
            $clave = "";

            try {
                $pdo = new PDO($cadena_conexion, $usuario, $clave);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //ACTUALIZAR POR NOMBRE DE EQUIPO LOCAL
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST['equipovisitante']) && !empty($_POST['equipovisitante']) &&
                            isset($_POST['nuevo_valor_visitante']) && !empty($_POST['nuevo_valor_visitante']) &&
                            isset($_POST['competicion']) && !empty($_POST['competicion'])) {

                        // Recuperar y validar los datos del formulario
                        $equipovisitante = $_POST['equipovisitante'];
                        $nuevo_valor_visitante = $_POST['nuevo_valor_visitante'];
                        $competicion = $_POST['competicion'];

                        try {
                            $pdo = new PDO($cadena_conexion, $usuario, $clave);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "UPDATE $competicion SET equipovisitante = :nuevo_valor_visitante WHERE equipovisitante = :equipovisitante";

                            $stmt = $pdo->prepare($sql);

                            $stmt->bindParam(':nuevo_valor_visitante', $nuevo_valor_visitante, PDO::PARAM_STR);
                            $stmt->bindParam(':equipovisitante', $equipovisitante, PDO::PARAM_STR);

                            
                            $stmt->execute();

                            header("Location: partidos.php");
                            exit();
                        } catch (Exception $e) {
                            echo "Error en la actualización: " . $e->getMessage();
                        }
                    }
                }

                //ACTUALIZAR POR NUMERO DE GOLES LOCAL

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST['resultadolocal']) && !empty($_POST['resultadolocal']) &&
                            isset($_POST['nuevo_valor_gol_local']) && !empty($_POST['nuevo_valor_gol_local']) &&
                            isset($_POST['competicion']) && !empty($_POST['competicion'])) {

                        // Recuperar y validar los datos del formulario
                        $resultadolocal = ($_POST['resultadolocal']);
                        $nuevo_valor_gol_local = ($_POST['nuevo_valor_gol_local']);
                        $competicion = ($_POST['competicion']);

                        try {
                            $pdo = new PDO($cadena_conexion, $usuario, $clave);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            
                            $sql = "UPDATE $competicion SET resultadolocal = :nuevo_valor_gol_local WHERE resultadolocal = :resultadolocal";

                            $stmt = $pdo->prepare($sql);

                           
                            $stmt->bindParam(':nuevo_valor_gol_local', $nuevo_valor_gol_local, PDO::PARAM_STR);
                            $stmt->bindParam(':resultadolocal', $resultadolocal, PDO::PARAM_STR);

                            
                            $stmt->execute();

                            // Redirigir después de la actualización
                            header("Location: partidos.php");
                            exit();
                        } catch (Exception $e) {
                            echo "Error en la actualización: " . $e->getMessage();
                        }
                    }
                }


                //ACTUALIZAR POR NOMBRE DE EQUIPO VISITANTE
                if ($_SERVER["REQUEST_METHOD"] === "POST") {

                    if (isset($_POST['equipovisitante']) && !empty($_POST['equipovisitante']) &&
                            isset($_POST['nuevo_valor_visitante']) && !empty($_POST['nuevo_valor_visitante']) &&
                            isset($_POST['competicion']) && !empty($_POST['competicion'])) {

                        // Recuperar y validar los datos del formulario
                        $equipolocal = ($_POST['equipolocal']);
                        $nuevo_valor_visitante = ($_POST['nuevo_valor_visitante']);
                        $competicion = ($_POST['competicion']);

                        try {
                            $pdo = new PDO($cadena_conexion, $usuario, $clave);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "UPDATE $competicion SET equipovisitante = :nuevo_valor_visitante WHERE equipovisitante = :equipovisitante";

                            $stmt = $pdo->prepare($sql);

                            $stmt->bindParam(':nuevo_valor_visitante', $nuevo_valor_visitante, PDO::PARAM_STR);
                            $stmt->bindParam(':equipovisitante', $equipovisitante, PDO::PARAM_STR);

                            
                            $stmt->execute();

                            header("Location: partidos.php");
                            exit();
                        } catch (Exception $e) {
                            echo "Error en la actualización: " . $e->getMessage();
                        }
                    }
                }

                //ACTUALIZAR POR NUMERO DE GOLES VISITANTES
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if (isset($_POST['resultadovisitante']) && !empty($_POST['resultadovisitante']) &&
                            isset($_POST['nuevo_valor_gol_visitante']) && !empty($_POST['nuevo_valor_gol_visitante']) &&
                            isset($_POST['competicion']) && !empty($_POST['competicion'])) {

                        // Recuperar y validar los datos del formulario
                        $resultadovisitante = $_POST['resultadovisitante'];
                        $nuevo_valor_gol_visitante = $_POST['nuevo_valor_gol_visitante'];
                        $competicion = $_POST['competicion'];

                        try {
                            $pdo = new PDO($cadena_conexion, $usuario, $clave);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            
                            $sql = "UPDATE $competicion SET resultadovisitante = :nuevo_valor_gol_visitante WHERE resultadovisitante = :resultadovisitante";

                            $stmt = $pdo->prepare($sql);

                            
                            $stmt->bindParam(':nuevo_valor_gol_visitante', $nuevo_valor_gol_visitante, PDO::PARAM_STR);
                            $stmt->bindParam(':resultadovisitante', $resultadovisitante, PDO::PARAM_STR);

                            
                            $stmt->execute();

                            
                            header("Location: partidos.php");
                            exit();
                        } catch (Exception $e) {
                            echo "Error en la actualización: " . $e->getMessage();
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