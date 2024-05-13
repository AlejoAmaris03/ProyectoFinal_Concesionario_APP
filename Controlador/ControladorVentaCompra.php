<?php
    include("../Modelo/ModeloVentaCompra/VentaCompra.php");
    include("../Modelo/ModeloVentaCompra/VentaCompraDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $ventaCompra = new VentaCompra();
        $ventaCompraDAO = new VentaCompraDAO();

        switch($accion){
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
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>