<?php
session_start();
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MisMarcadores</title>
    <link rel="icon" href="./assets/images/mis-marcadores-1.ico" type="image/x-icon">
    <link rel="shortcut icon" href="./assets/images/mis-marcadores-1.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/styleindex.css" />

</head>

<body>
    <div class="container">
        <h1 class="title">Mis Marcadores </h1><img src="./assets/images/mis-marcadores-1.ico" alt="logo" /><br>
        <section class="section">
            <article class="article">

                <form action="index.php" method="post">

                    <h1>Iniciar Sesion</h1>


                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Iniciar sesión</button>
                </form>
                <p>Si no estas registrado.<a href="./pages/register.php" class="href">Registrate</a></p>
            </article>

            <?php



            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "mismarcadores";


            $conn = new mysqli($servername, $username, $password, $database);

            // Verifica la conexión
            if ($conn->connect_error) {
                die("La conexión falló");
            }



            // Verificar si se ha enviado el formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuario = $_POST["username"];
                $contrasena = $_POST["password"];



                // Consulta SQL para obtener el usuario de la base de datos
                $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $usuario);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();

                    // Verificar la contraseña
                    $hashed_password = hash('sha256', $contrasena);
                    if ($hashed_password === $row['contraseña']) {
                        // Autenticación exitosa
                        
                        setcookie('usuario', $usuario, time() + (86400 * 30), '/');
                        $_SESSION['usuario'] = $usuario;
                        
                        
                        // Redirigir al usuario a la página apropiada
                        if ($row['nombre_usuario'] == 'admin') {
                            header("Location: ./pages/partidosadmin.php");
                            exit();
                        } else {
                            header("Location: ./pages/partidos.php");
                            exit();
                        }
                    } else {
                        $mensaje = "Credenciales incorrectas. Intenta de nuevo.";
                        echo '<p class="error">' . $mensaje . '</p>';
                    }
                } else {
                    $mensaje = "Credenciales incorrectas. Intenta de nuevo.";
                    echo '<p class="error">' . $mensaje . '</p>';
                }
            }

            // Cierra la conexión
            $conn->close();


            ?>



        </section>



    </div>
</body>

</html>