<?php
    include("../Modelo/ModeloVentaCompra/VentaCompra.php");
    include("../Modelo/ModeloVentaCompra/VentaCompraDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $ventaCompra = new VentaCompra();
        $ventaCompraDAO = new VentaCompraDAO();

        switch($accion){
            case "listarVentaCompra":
                $datos = $ventaCompraDAO->listarVentaCompra();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["verDetalles"] = '<button class="btnEditar" type="button" onclick="btnVerDetallesHistorial('.$datos[$i]["ID"].')" title="Ver Detalles"><i class="fa-solid fa-receipt"></i></button>';
                        $datos[$i]["descargar"] = '<button class="btnEliminar" type="button" onclick="btnDescargarHistorial('.$datos[$i]["ID"].')" title="Descargar"><i class="fa-solid fa-file-pdf"></i></button>';
                    }
                }
            break; 

            case "listarCompras":
                $idUsuario = $_POST["idUsuario"];
                
                $datos = $ventaCompraDAO->listarCompras($idUsuario);

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["verDetalles"] = '<button class="btnEditar" type="button" onclick="btnVerDetalleCompra('.$datos[$i]["ID"].')" title="Ver Detalles"><i class="fa-solid fa-receipt"></i></button>';
                        $datos[$i]["descargar"] = '<button class="btnEliminar" type="button" onclick="btnDescargarCompra('.$datos[$i]["ID"].')" title="Descargar"><i class="fa-solid fa-file-pdf"></i></button>';
                    }
                }
            break;

            case "listarVentas":
                $idUsuario = $_POST["idUsuario"];
                
                $datos = $ventaCompraDAO->listarVentas($idUsuario);

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["verDetalles"] = '<button class="btnEditar" type="button" onclick="btnVerDetalleVenta('.$datos[$i]["ID"].')" title="Ver Detalles"><i class="fa-solid fa-receipt"></i></button>';
                        $datos[$i]["descargar"] = '<button class="btnEliminar" type="button" onclick="btnDescargarVenta('.$datos[$i]["ID"].')" title="Descargar"><i class="fa-solid fa-file-pdf"></i></button>';
                    }
                }
            break;

            case "listarComprasPorIdCompra":
                $idCompra = $_POST["idCompra"];
                
                $datos = $ventaCompraDAO->listarComprasPorIdCompra($idCompra);
            break;

            case "listarVentasPorIdVenta":
                $idVenta = $_POST["idVenta"];
                
                $datos = $ventaCompraDAO->listarVentasPorIdVenta($idVenta);
            break;

            case "listarHistorialPorIdVentaCompra":
                $idVentaCompra = $_POST["idVentaCompra"];

                $datos = $ventaCompraDAO->listarHistorialPorIdVentaCompra($idVentaCompra);
            break;

            case "listarCompraPorPlacaVehiculo":
                $placaVehiculo = $_POST["placaVehiculo"];
                
                $datos = $ventaCompraDAO->listarCompraPorPlacaVehiculo($placaVehiculo);
            break;

            case "generarReferencia":
                $idVehiculo = $_POST["idVehiculo"];

                $datos = $ventaCompraDAO->generarReferencia($idVehiculo);
            break;

            case "generarPlaca":
                $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $numeros = "0123456789";
                
                $caracteresRandom = substr(str_shuffle($caracteres), 0, 3); //Barajea aleatoriamente la cadena y obtiene los primeros 3 datos
                $numerosRandom = substr(str_shuffle($numeros), 0, 3);

                $datos = $caracteresRandom.$numerosRandom;
            break;

            case "realizarCompraVenta":
                $ventaCompra->setIdUsuario($_POST["idUsuario"]);
                $ventaCompra->setIdVehiculo($_POST["idVehiculo"]);
                $ventaCompra->setReferencia($_POST["referencia"]);
                $ventaCompra->setPlacaVehiculo($_POST["placaVehiculo"]);
                $ventaCompra->setTotal($_POST["total"]);

                $datos = $ventaCompraDAO->realizarVentaCompra($ventaCompra);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>