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
    <link rel="stylesheet" type="text/css" href="../css/styleindex.css" />
</head>

<body>
    <div class="container">
        <h1 class="title">Mis Marcadores</h1><img src="../assets/images/mis-marcadores-1.ico" width="100px" /><br>
        <form action="../pages/register.php" method="post">
            <h2>Registrarse</h2>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registrarse</button>
        </form>

        <p>¿Ya tienes una cuenta? <a href="../index.php" class="href">Iniciar sesión</a></p>

        <?php
        try {
            // Configuración de la conexión PDO
            $cadena_conexion = "mysql:host=localhost;dbname=mismarcadores";
            $usuario = "root";
            $clave = "";

            // Crear la conexión PDO
            $pdo = new PDO($cadena_conexion, $usuario, $clave);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verificar si se ha enviado el formulario de registro
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = $_POST["nombre"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                // Verificar que los campos no estén vacíos
                if (!empty($nombre) && !empty($email) && !empty($password)) {
                    // Consulta SQL para verificar si el nombre de usuario ya existe
                    $sql_check_username = "SELECT id_usuario FROM usuarios WHERE nombre_usuario = ?";
                    $stmt_check_username = $pdo->prepare($sql_check_username);
                    $stmt_check_username->execute([$nombre]);

                    if ($stmt_check_username->rowCount() > 0) {
                        $mensaje = "Ya existe un usuario con este nombre. Por favor, elige otro nombre de usuario.";
                        echo '<p class="error">' . $mensaje . '</p>';
                    } else {
                        // Hash de la contraseña
                        $hashed_password = hash('sha256', $password);

                        // Inserción del nuevo usuario
                        $sql_insert_user = "INSERT INTO usuarios (nombre_usuario, correo_electronico, contraseña, fecha_registro) VALUES (?, ?, ?, NOW())";
                        $stmt_insert_user = $pdo->prepare($sql_insert_user);
                        $stmt_insert_user->execute([$nombre, $email, $hashed_password]);

                        $mensaje = "Registro exitoso.";
                        echo '<p class="registro">' . $mensaje . '</p>';
                    }
                } else {
                    $mensaje = "Por favor, completa todos los campos.";
                    echo '<p class="error">' . $mensaje . '</p>';
                }
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        ?>
    </div>
</body>

</html>