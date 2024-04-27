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
    <link rel="stylesheet" href="./Sweetalert/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="./FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="./FontAwesome/css/brands.css">
    <link rel="stylesheet" href="./FontAwesome/css/solid.css">
    <title>Auto Shop S.A.S | Iniciar Sesion</title>
</head>

<body onload="limpiar()">
    <div class="contenedor">
        <div class="form">
            <div class="logoPrincipal">
                <img src="./CSS/Imgs/logoPrincipal.jpg" alt="Logo Principal">
            </div>
            
            <div class="titulo">
                <h1>Bienvenido/a a Auto Shop S.A.S</h1>
            </div>

            <form name="form" method="POST">
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

                    <select name="tipoUsuario" id="tipoUsuario">
                        <option value="Estandar">Estándar</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>

                <div class="recuperar-clave">
                    <a href="./Controlador/ControladorRecuperarClave.php">¿Olvido su contraseña?</a>
                </div>

                <div class="botones">
                    <input type="button" onclick="validar()" value="Acceder">
                    <input type="reset" value="Limpiar">
                </div>
            </form>
        </div>
    </div>

    <script src="./JQuery/jquery-3.7.1.min.js"></script>
    <script src="./Sweetalert/package/dist/sweetalert2.all.min.js"></script>
    <script src="./JavaScript/scriptIndex.js"></script>
</body>

</html>