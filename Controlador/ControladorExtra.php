<?php //Ejecuta las acciones del Administrador
    include("../Modelo/ModeloExtra/Exta.php");
    include("../Modelo/ModeloExtra/ExtraDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $extra = new Extra();
        $extraDAO = new ExtraDAO();

        switch($accion){ //Verifica que acción se ejecutará
            case "agregarExtras":
                $extra->setIdVentaCompra($_POST["idCompra"]);
                $extra->setIdEquipamiento($_POST["idEquipamiento"]);
                $extra->setCantidad($_POST["cantidad"]);

                $datos = $extraDAO->agregarExtras($extra);
            break;

            case "listarExtrasPorIdCompra":
                $idCompra = $_POST["idCompra"];

                $datos = $extraDAO->listarExtrasPorIdCompra($idCompra);
            break;

            case "eliminarExtasPorIdCompraVenta":
                $idVentaCompra = $_POST["idVentaCompra"];

                $datos = $extraDAO->eliminarExtasPorIdCompraVenta($idVentaCompra);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>