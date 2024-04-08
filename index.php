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
    <link rel="stylesheet" href="../Estilos/estilos.css">
    <title>Concesionario | Iniciar Sesion</title>
</head>

<body onload="limpiar()">
    <div class="contenedor">
        <div class="form">
            <div class="titulo">
                <h1>Bienvenido/a</h1>
            </div>

            <form name="form" action="" method="POST">
                    <div class="campos">
                        <input class="form-campos" type="text" name="usuario" id="usuario" placeholder="Nombre de Usuario">
                    </div>

                    <div class="campos">
                        <input class="form-campos" type="password" name="clave" id="clave" placeholder="Contraseña">
                    </div>

                    <div class="campos">
                        <label for="tipo_usuario">Tipo de Usuario</label>

                        <section>
                            <select name="estandar" id="tipo_usuario">Estándar/Normal</select>
                            <select name="admin" id="tipo_usuario">Administrador</select>
                        </section>
                    </div>

                    <div class="botones">
                        <br>
                        <input type="hidden" name="accion" value="Acceder">
                        <input type="button" onclick="" value="Acceder">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>