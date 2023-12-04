<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MisMarcadores</title>
        <link rel="icon" href="./assets/images/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="shortcut icon" href="./assets/images/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/styleindex.css" />

    </head>
    <body>
        <div class="container">
            <h1 class="title">Mis Marcadores</h1><img src="../assets/images/mis-marcadores-1.ico" width="100px"/><br>
            <form action="../pages/register.php" method="post">
                <h2>Registrarse</h2>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>

                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Registrarse</button>
            </form>

            <p>¿Ya tienes una cuenta? <a href="../index.php" class="href">Iniciar sesión</a></p>


            <?php
           
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Obtener los datos del formulario
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $email = $_POST["email"];
                $username = $_POST["username"];
                $password = $_POST["password"];

                // Verificar si todos los campos están llenos
                if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($username) && !empty($password)) {
                    $mensaje = "Registro exitoso.";
                    echo '<p class="registro">' . $mensaje . '</p>';
                } else {
                    $mensaje = "Por favor, completa todos los campos.";
                    echo '<p class="error">' . $mensaje . '</p>';
                }
            }
            ?>

        </section>



    </div>
</body>
</html>



