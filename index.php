<?php
    session_start();
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/estilosIndex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Concesionario | Iniciar Sesion</title>
</head>

<body onload="">
    <div class="contenedor">
        <div class="form">
            <div class="titulo">
                <h1>Bienvenido/a al Concesionario S.A.S</h1>
            </div>

            <form name="form" action="./Controlador/Validar.php" method="POST">
                <div class="registro">
                    ¿Aún no tiene cuenta? <a href="./Vista/registro.php">Registrarse</a>
                </div>

                <div class="campos">
                    <i class="fa-solid fa-user"></i>
                    <input class="form-campos" type="text" name="usuario" id="usuario" placeholder="Nombre de Usuario">
                </div>

                <div class="campos">
                    <i class="fa-solid fa-lock"></i>
                    <input class="form-campos" type="password" name="clave" id="clave" placeholder="Contraseña">
                </div>

                <div class="campos select">
                    <p>Tipo de Usuario</p>

                    <select name="tipo_usuario">
                        <option value="Estandar">Estándar</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>

                <div class="botones">
                    <input type="hidden" name="accion" value="Acceder">
                    <input type="button" onclick="" value="Acceder">
                    <input type="reset" value="Limpiar">
                </div>
            </form>
        </div>
    </div>
</body>

</html>