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
    <title>Concesionario Auto Shop S.A.S | Inicio</title>
</head>

<body onload="listarVehiculos()">
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
                    <?php for ($i=0; $i<5; $i++){ ?>
                        <img src="./CSS/Imgs/Fondo_14.jpg" width="100%" height="100%" alt="Imágen Vehículos">
                    <?php } ?>
                </div>

                <button class="btnIzq" id="anterior" onclick="btnAnterior()" title="Anterior">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <button class="btnDer" id="siguiente" onclick="btnSiguiente()" title="Siguiente">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <div class="detalles">
                <div class="izq">
                    <p id="marca">Marca:</p>
                    <p id="modelo">Modelo:</p>
                </div>

                <div class="der">
                    <p id="tipoVehiculo">Tipo de Vehículo:</p>
                    <p id="detalles">Detalles:</p>
                </div>

                <div class="botones">
                    <button class="btnAdquirir" type="button" onclick="btnAdquirir()" title="Adquirir">Adquirir</button>
                    <button class="btnVerMas" type="button" onclick="btnVerMas()" title="Ver Más">Ver Más</button>
                </div>
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
                        </div>

                        <div class="modal-footer">
                            <buton type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./JQuery/jquery-3.7.1.min.js"></script>
    <script src="./Sweetalert/package/dist/sweetalert2.all.min.js"></script>
    <script src="./Bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./Bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JavaScript/scriptIndex.js"></script>
</body>

</html>