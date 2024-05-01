<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Sweetalert/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="./CSS/estilosIndex.css">
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
                        <h1>Concesionario Auto Shop S.A.S</h1>
                    </a>
                </div>

                <div class="links">
                    <div class="iniciarSesion">
                        <a href="./Vista/iniciarSesion.php" title="Iniciar Sesión">
                            <h4>Iniciar Sesión</h4>
                        </a>
                    </div>

                    <div class="registrarse">
                        <a href="./Vista/registro.php" title="Registrarse">
                            <h4>Registrarse</h4>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="listaVehiculos">
                <div class="img">
                    <?php for ($i=0; $i<5; $i++){ ?>
                        <img src="./CSS/Imgs/Fondo_13.jpg" width="100%" height="100%" alt="Imágen Vehículos">
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
                    <p id="marca">Marca: Ferrari</p>
                    <p id="modelo">Modelo: 250 GT Berlinetta</p>
                </div>

                <div class="der">
                    <p id="tipoVehiculo">Tipo de Vehículo: Deportivo</p>
                    <p id="detalles">Detalles: Vehiculo con color ffdsf fsdfsdf fsfsdf fsdfsdf fsdfsdf fsdfsdf fdfsdfdsfsd fsdfsdfsdf fsdfsdfsd fsdfsdfsdf</p>
                </div>

                <div class="btnVerMas">
                    <button type="button" title="Ver Más">Ver Más</button>
                </div>
            </div>
        </div>
    </div>

    <script src="./JQuery/jquery-3.7.1.min.js"></script>
    <script src="./Sweetalert/package/dist/sweetalert2.all.min.js"></script>
    <script src="./JavaScript/scriptIndex.js"></script>
</body>

</html>