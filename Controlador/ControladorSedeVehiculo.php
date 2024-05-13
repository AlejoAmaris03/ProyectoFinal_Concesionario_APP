<?php
    include("../Modelo/ModeloSedeVehiculo/SedeVehiculo.php");
    include("../Modelo/ModeloSedeVehiculo/SedeVehiculoDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $sedeVehiculo = new SedeVehivulo();
        $sedeVehiculoDAO = new SedeVehiculoDAO();

        switch ($accion){
            case "agregarSedeVehiculo":
                $sedeVehiculo->setIdSede($_POST["idSede"]);
                $sedeVehiculo->setIdVehiculo($_POST["idVehiculo"]);
                $sedeVehiculo->setCantidad($_POST["cantidad"]);

                $datos = $sedeVehiculoDAO->agregarSedeVehiculo($sedeVehiculo);
            break;

            case "actualizarStock":
                $idS = $_POST["idSede"];
                $idV = $_POST["idVehiculo"];

                $stock = $sedeVehiculoDAO->obtenerStock($idS,$idV); //Obtenemos la cantidad actual
                $stock = $stock[0]["Cantidad"];

                $datos = $sedeVehiculoDAO->actualizarStock($idS,$idV,$stock); //Actualizamos la cantidad
            break;

            case "buscarSedePorId":
                $idS = $_POST["idS"];

                $datos = $sedeVehiculoDAO->buscarSedePorId($idS);
            break;

            case "buscarVehiculoPorId":
                $idV = $_POST["idV"];

                $datos = $sedeVehiculoDAO->buscarVehiculoPorId($idV);

                $_SESSION["sedes"] = $datos;
            break;

            case "eliminarPorIdVehiculo":
                $idVehiculo = $_POST["idVehiculo"];

                $datos = $sedeVehiculoDAO->eliminarPorIdVehiculo($idVehiculo);
            break;
            
            case "editarPorIdVehiculo":
                $sedeVehiculo->setIdSede($_POST["idSede"]);
                $sedeVehiculo->setIdVehiculo($_POST["idVehiculo"]);
                $sedeVehiculo->setCantidad($_POST["cantidad"]);

                $datos = $sedeVehiculoDAO->eliminarPorIdVehiculo($sedeVehiculo->getIdVehiculo());
                $datos = $sedeVehiculoDAO->agregarSedeVehiculo($sedeVehiculo);
            break;

            case "eliminarPorIdSede":
                $idSede = $_POST["idSede"];

                $datos = $sedeVehiculoDAO->eliminarPorIdSede($idSede);
            break;
            
            case "editarPorIdSede":
                $sedeVehiculo->setIdSede($_POST["idSede"]);
                $sedeVehiculo->setIdVehiculo($_POST["idVehiculo"]);
                $sedeVehiculo->setCantidad($_POST["cantidad"]);

                $datos = $sedeVehiculoDAO->agregarSedeVehiculo($sedeVehiculo);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else  
        header("Location: ../");
?>