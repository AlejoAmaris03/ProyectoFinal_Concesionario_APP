<?php
    session_start();
?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/estilosPrincipal.css">
    <link rel="stylesheet" href="../../CSS/estilosAdmin.css">
    <link rel="stylesheet" href="../../Bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../FontAwesome/css/brands.css">
    <link rel="stylesheet" href="../../FontAwesome/css/solid.css">
    <title>Concesionario S.A.S</title>
</head>

<?php
    $link = "../../";
?>

<body>
    <div class="contenedor">
        <div class="contenido">
            <nav class="nav">
                <div class="logo">
                    <a href="<?php echo $link; ?>" title="Página Principal">
                        <i class="fa-solid fa-car"></i>
                        <h4>Concesionario S.A.S</h4>
                    </a>
                </div>

                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>

                        <div class="nombre">
                            Pepe Lopez
                        </div>
                    </button>

                    <div class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#">Ver Perfil</a></li>

                        <form action="../../Controlador/Validar.php" method="POST">
                            <li><input class="dropdown-item" type="submit" name="accion" value="Salir"></li>
                        </form>
                    </div>
                </div>
            </nav>

            <main>
                <div class="principal">