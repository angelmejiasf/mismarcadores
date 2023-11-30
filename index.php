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
            <h1 class="title">Mis Marcadores </h1><img src="./assets/images/mis-marcadores-1.ico" width="100px"/><br>
            <section class="section">
                <article>

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
                session_start();
                
                // Verificar si el usuario ya está autenticado
                if (isset($_SESSION['usuario'])) {
                    header("Location: index.php");
                    exit();
                }

                // Verificar si se ha enviado el formulario
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $usuario = $_POST["username"];
                    $contrasena = $_POST["password"];

                    // Verificar si es el admin
                    if ($usuario == "admin" && $contrasena == "admin") {
                        header("Location: ./pages/partidosadmin.php");
                        exit();
                    }
                    // Verificar si es un usuario normal
                    elseif ($usuario == "user" && $contrasena == "user") {
                        header("Location: ./pages/partidos.php");
                        exit();
                    } else {
                        $error = "Usuario o contraseña incorrecta";
                        echo '<p class="error">' . $error . '</p>';
                    }
                }
                ?>

            </section>



        </div>
    </body>
</html>



