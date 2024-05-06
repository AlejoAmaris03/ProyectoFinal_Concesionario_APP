<?php
    include("./Modelo/ModeloVehiculo/Vehiculo.php");
    session_start();
?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Sweetalert/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="./CSS/estilosIndex.css">
    <link rel="stylesheet" href="./Bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="./FontAwesome/css/brands.css">
    <link rel="stylesheet" href="./FontAwesome/css/solid.css">
    <script src="./JQuery/jquery-3.7.1.min.js"></script>
    <title>Auto Shop S.A.S | Inicio</title>
</head>

<body onload="inicializarSlide()">
    <script>
        $.ajax({
            url: "./Controlador/ControladorVehiculo.php",
            method: "POST",
            data: {
                accion: "obtenerVehiculos"
            },
            success: function(data){
            },
            error: function(data){   
                mensaje("error","ERROR","Ha ocurrido un error al buscar los Vehículos!");
            }
        });
    </script>

    <div class="contenedor">
        <div class="contenido">
            <nav class="nav">
                <div class="logo">
                    <a href="./" title="Página Principal">
                        <i class="fa-solid fa-car"></i>
                        <h4>Concesionario Auto Shop S.A.S</h4>
                    </a>
                </div>

                <div class="links">
                    <div class="iniciarSesion">
                        <a href="./Vista/iniciarSesion.php" title="Iniciar Sesión">
                            <h6>Iniciar Sesión</h6>
                        </a>
                    </div>

                    <div class="registrarse">
                        <a href="./Vista/registro.php" title="Registrarse">
                            <h6>Registrarse</h6>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="listaVehiculos">
                <div class="img">
                    <?php 
                        $v = $_SESSION["v"];

                        for ($i=0; $i<count($v); $i++){
                            if($v[$i]["Cantidad"] > 0){ ?>
                                <img src="data:image/jpeg;base64,<?=$v[$i]["Imagen"]?>" onclick="btnVerMas(<?=$v[$i]['ID']?>) " width="100%" height="100%" alt="Imágen Vehículos" title="Ver Más">
                    <?php   }
                        }?>
                </div>

                <button class="btnIzq" id="anterior" onclick="btnAnterior()" title="Anterior">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <button class="btnDer" id="siguiente" onclick="btnSiguiente()" title="Siguiente">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

                <p id="noVehiculo"></p>
            </div>

            <!-- Modal de Ver Detalles -->
            <div class="modal fade" id="verMas" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Detalles del Vehículo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="campos" title="Marca del Vehículo">
                                <i class="fa-solid fa-car"></i>
                                <input class="form-campos" type="text" name="marcaV" id="marcaV" readonly>
                            </div>

                            <div class="campos" title="Modelo del Vehículo">
                                <i class="fa-solid fa-car"></i>
                                <input class="form-campos" type="text" name="modeloV" id="modeloV" readonly>
                            </div>

                            <div class="campos" title="Tipo de Vehículo">
                                <i class="fa-solid fa-car"></i>
                                <input class="form-campos" type="text" name="tipoV" id="tipoV" readonly>
                            </div>

                            <div class="campos descripcion" title="Descripción del Vehículo">
                                <i>Descripción</i>
                                <textarea name="descripcionV" id="descripcionV" cols="30" rows="3" readonly></textarea>
                            </div>

                            <div class="campos" title="Cantidad de Vehículos Disponibles">
                                <i class="fa-solid fa-hashtag"></i>
                                <input class="form-campos" type="number" name="cantidadV" id="cantidadV" readonly>
                            </div>

                            <div class="campos" title="Precio del Vehículo">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <input class="form-campos" type="number" name="precioV" id="precioV" readonly>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                            <button type="button" class="btn btn-secondary" onclick="btnAdquirir()">Adquirir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./Sweetalert/package/dist/sweetalert2.all.min.js"></script>
    <script src="./Bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./Bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JavaScript/scriptIndex.js"></script>
</body>

</html>