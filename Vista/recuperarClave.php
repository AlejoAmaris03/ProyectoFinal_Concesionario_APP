<?php //Vista que permite la recuperación de la clave de un inicio
    session_start();
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/estilosRecuperarClave.css">
    <link rel="stylesheet" href="../Sweetalert/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../FontAwesome/css/brands.css">
    <link rel="stylesheet" href="../FontAwesome/css/solid.css">
    <title>Auto Shop S.A.S | Recuperar Contraseña</title>
</head>

<body onload="limpiar()">
    <div class="contenedor">
        <div class="form">
            <div class="logoPrincipal">
                <a href="./iniciarSesion.php" title="Regresar a la Página de Inicio de Sesión">
                    <img src="../CSS/Imgs/logoPrincipal.jpg" alt="Logo Principal">
                </a>
            </div>

            <div class="titulo">
                <h1>Recuperar Contraseña</h1>
            </div>

            <form name="form" id="form" method="POST">
                <div class="campos">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="correo" id="correo" placeholder="Ingrese su correo electrónico">
                </div>

                <div class="botones">
                    <input type="button" onclick="btnRecuperarClave()" value="Recuperar">
                    <input type="reset" value="Limpiar">
                </div>
            </form>
        </div>
    </div>
    
    <script src="../JQuery/jquery-3.7.1.min.js"></script>
    <script src="../Sweetalert/package/dist/sweetalert2.all.min.js"></script>
    <script src="../JavaScript/scriptRecuperarClave.js"></script>
</body>

</html>