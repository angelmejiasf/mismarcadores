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



            <h2>Insertar Datos</h2>
            <form action="insertar.php" method="post">
                <p>Competicion</p><input type="text" name='competicion'>
                <p>Equipo Local</p><input type="text" name="equipolocal" >
                <p>Numero de Goles Local</p><input type="number" name="resultadolocal" >
                <p>Equipo Visitante</p><input type="text" name="equipovisitante">
                <p>Numero de Goles Visitante</p><input type="number" name="resultadovisitante" required=""><br>

                <input type="submit" name="submit" value="Insertar">
            </form>


            <?php
            //Conexion Base de Datos
            $cadena_conexion = "mysql:dbname=mismarcadores;host=127.0.0.1";
            $usuario = "root";
            $clave = "";

            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
                try {
                    $pdo = new PDO($cadena_conexion, $usuario, $clave);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Recuperar datos del formulario
                    $competicion = $_POST['competicion'];
                    $equipolocal = $_POST['equipolocal'];
                    $resultadolocal = $_POST['resultadolocal'];
                    $equipovisitante = $_POST['equipovisitante'];
                    $resultadovisitante = $_POST['resultadovisitante'];

                    
                    $sql = "INSERT INTO $competicion (equipolocal, resultadolocal, equipovisitante, resultadovisitante) 
                    VALUES (:equipolocal, :resultadolocal, :equipovisitante, :resultadovisitante)";

                    $stmt = $pdo->prepare($sql);

                    
                    $stmt->bindParam(':equipolocal', $equipolocal);
                    $stmt->bindParam(':resultadolocal', $resultadolocal);
                    $stmt->bindParam(':equipovisitante', $equipovisitante);
                    $stmt->bindParam(':resultadovisitante', $resultadovisitante);

                    // Ejecutar la consulta
                    $stmt->execute();

                    
                    header("Location: partidos.php");
                    exit();
                } catch (Exception $e) {
                    echo "La base de datos está actualmente en mantenimiento, vuelva a intentarlo más tarde";
                }
            }
            ?>



        </div>
    </body>
</html>