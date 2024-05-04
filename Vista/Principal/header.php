<?php  //Encabezado que aparece en todas las vistas por defecto
    include("../../Modelo/ModeloUsuario/Usuario.php");
    include("../../Modelo/ModeloMarcaVehiculo/MarcaVehiculo.php");
    include("../../Modelo/ModeloTipoVehiculo/TipoVehiculo.php");
    session_start();

    if(isset($_SESSION["u"])) //Verifica que exista una sesión iniciada
        $u = $_SESSION["u"];
    else
        header("Location: ../../");
?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/estilosPrincipal.css">
    <link rel="stylesheet" href="../../CSS/estilosAdmin.css">
    <link rel="stylesheet" href="../../CSS/estilosOpcionesAdmin.css">
    <link rel="stylesheet" href="../../CSS/estilosCliente.css">
    <link rel="stylesheet" href="../../CSS/estilosEditar.css">
    <link rel="stylesheet" href="../../Bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Sweetalert/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../../FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../FontAwesome/css/brands.css">
    <link rel="stylesheet" href="../../FontAwesome/css/solid.css">
    <link rel="stylesheet" href="../../DataTables/datatables.min.css">
    <title>Auto Shop S.A.S</title>
</head>

<?php
    $link;

    if(strcmp($u->getTipoUsuario(),"Administrador")==0) //Link que redirecciona a la página principal (index) dependiendo del tipo de usuario
        $link = "../VistaAdmin/";
    else
        $link = "../VistaCliente/";
?>

<body>
    <div class="contenedor">
        <div class="contenido">
            <nav class="nav">
                <div class="logo">
                    <a href="<?php echo $link; ?>" title="Página Principal">
                        <i class="fa-solid fa-car"></i>
                        <h4>Concesionario Auto Shop S.A.S</h4>
                    </a>
                </div>

                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>

                        <div class="nombre">
                            <?php echo $u->getNombre(); ?>
                        </div>
                    </button>

                    <div class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="../Principal/editar.php">Ver Perfil</a></li>

                        <form action="../../Controlador/Validar.php" method="POST">
                            <li><input class="dropdown-item" type="submit" name="accion" value="Salir"></li>
                        </form>
                    </div>
                </div>
            </nav>

            <main>
                <div class="principal">