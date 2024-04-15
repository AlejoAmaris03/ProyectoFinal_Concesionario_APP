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
    <link rel="stylesheet" href="../CSS/estilosRegistro.css">
    <link rel="stylesheet" href="../Sweetalert/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Concesionario | Registrarse</title>
</head>

<body onload="limpiar()">
    <div class="contenedor">
        <div class="form">
            <div class="titulo">
                <h1>Bienvenido/a al Concesionario S.A.S</h1>
            </div>

            <form name="form" action="../Controlador/ControladorCliente.php" method="POST">
                <div class="ingresar">
                    ¿Ya tiene una cuenta? <a href="../">Ingresar</a>
                </div>

                <div class="campos">
                    <i class="fa-solid fa-user"></i>
                    <input class="form-campos" type="text" name="nombre" id="nombre" placeholder="Digite su Nombre">
                </div>

                <div class="campos">
                    <i class="fa-solid fa-user"></i>
                    <input class="form-campos" type="text" name="apellido" id="apellido" placeholder="Digite su Apellido">
                </div>

                <div class="campos">
                    <i class="fa-solid fa-envelope"></i>
                    <input class="form-campos" type="email" name="correo" id="correo" placeholder="Digite su Correo Electrónico">
                </div>

                <abbr title="Seleccione su Fecha de Nacimiento">
                    <div class="campos fecha-nacimiento">
                        <p>Fecha de Nacimiento</p>
                        <input class="form-campos" type="date" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Eliga su Fecha de Nacimiento">
                    </div>
                </abbr>

                <div class="campos">
                    <i class="fa-solid fa-user"></i>
                    <input class="form-campos" type="text" name="usuario" id="usuario" placeholder="Digite su Nombre de Usuario">
                </div>

                <div class="campos">
                    <i class="fa-solid fa-lock"></i>
                    <input class="form-campos" type="password" name="clave" id="clave" placeholder="Digite su Contraseña">
                </div>

                <div class="botones">
                    <input type="hidden" name="accion" value="Registrar">
                    <input type="button" onclick="validar()" value="Registrar">
                    <input type="reset" value="Limpiar">
                </div>
            </form>
        </div>
    </div>

    <script src="../Sweetalert/package/dist/sweetalert2.all.min.js"></script>
    <script src="../JavaScript/scriptRegistro.js"></script>
</body>

</html>