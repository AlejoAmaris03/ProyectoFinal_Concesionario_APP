<?php //Ejecuta las acciones del Administrador
    include("../Modelo/ModeloDetalles/DetallesVentasCompras.php");
    include("../Modelo/ModeloDetalles/DetallesVentasComprasDAO.php");

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $detalles = new DetallesVentasCompras();
        $detallesDAO = new DetallesVentasComprasDAO();

        switch($accion){ //Verifica que acción se ejecutará
            case "agregarDetallesCompra":
                $detalles->setIdVentaCompra($_POST["idCompra"]);
                $detalles->setNombreComprador($_POST["nombreComprador"]);
                $detalles->setCorreoComprador($_POST["correoComprador"]);
                
                $idSede = $_POST["sede"]; 
                $sede = $detallesDAO->obtenerSede($idSede);
                $detalles->setSedeConcesionario($sede[0]["Sede"]);

                $datos = $detallesDAO->agregarDetallesCompra($detalles);
            break;

            case "agregarDetallesVenta":
                $detalles->setIdVentaCompra($_POST["idVenta"]);
                $detalles->setNombreVendedor($_POST["nombreVendedor"]);
                $detalles->setNombreComprador($_POST["nombreComprador"]);
                $detalles->setCorreoComprador($_POST["correoComprador"]);
                
                $idSede = $_POST["sede"]; 
                $sede = $detallesDAO->obtenerSede($idSede);
                $detalles->setSedeConcesionario($sede[0]["Sede"]);

                $datos = $detallesDAO->agregarDetallesVenta($detalles);
            break;

            case "eliminarDetallesPorIdCompraVenta":
                $idVentaCompra = $_POST["idVentaCompra"];

                $datos = $detallesDAO->eliminarDetallesPorIdCompraVenta($idVentaCompra);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>