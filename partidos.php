<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MisMarcadores</title>
        <link rel="icon" href="./assets/images/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="shortcut icon" href="./assets/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    </head>
    <body>
        <div class="container">
            <h1 class="title">Mis Marcadores</h1><img src="./assets/images/mis-marcadores-1.ico" width="100px"/><br>
            <?php
            
            if(isset($_POST['bundesliga'])){
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
                
                echo "<p class='competicion'>Competicion: " . $nombre_tabla ."</p>";
                echo "<table border='1' class='table'>";
                foreach ($resultados as $fila) {

                    echo "<tr>";
                    echo "<td>" . $fila['equipolocal'] . "</td>";
                    echo "<td>" . $fila['resultadolocal'] . "</td>";
                    echo "<td>" . $fila['resultadovisitante'] . "</td>";
                    echo "<td>" . $fila['equipovisitante'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                /* foreach ($resultados as $fila) {
                  // Accede a los datos de cada fila usando $fila['nombre_de_columna']
                  echo $fila['equipolocal']." " . $fila['resultadolocal'] . "-" .$fila['resultadovisitante']. " ".$fila['equipovisitante']."<br>";
                  } */
            } catch (Exception $e) {
                echo "Error con la bd: " . $e->getMessage();
            }
            }
            ?>
            
             <form action="partidos.php" method="post">
        <input type="submit" name="bundesliga" value="Bundesliga">
               
    </form>
        </div>
    </body>
</html>



