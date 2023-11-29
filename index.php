<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MisMarcadores</title>
        <link rel="icon" href="./assets/images/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="shortcut icon" href="./assets/images/mis-marcadores-1.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
         <script>
            // JavaScript para agregar la clase 'loaded' al cuerpo después de que la página se haya cargado
            window.addEventListener('load', function () {
                document.body.classList.add('content-loaded');
            });
        </script>
    </head>
    <body>
        <div class="container">
            <h1 class="title">Mis Marcadores </h1><img src="./assets/images/mis-marcadores-1.ico" width="100px"/><br>
            <section class="section">
                <article>
                    
                    <form action="login.php" method="post">
                        
                        <h1>Iniciar Sesion</h1>
                        

                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" required>

                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>

                        <button type="submit">Iniciar sesión</button>
                    </form>
                    <p>Si no estas registrado.<a href="#" class="href">Registrate</a></p>
                </article>

            </section>


            <a href="pages/partidos.php">partidos para el usuario</a>
            <a href="pages/partidosadmin.php">partidos para el admin</a>
        </div>
    </body>
</html>



