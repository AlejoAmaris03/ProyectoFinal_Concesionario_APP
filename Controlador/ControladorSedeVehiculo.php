<?php
    include("../Modelo/ModeloSedeVehiculo/SedeVehiculo.php");
    include("../Modelo/ModeloSedeVehiculo/SedeVehiculoDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $sedeVehiculo = new SedeVehivulo();
        $sedeVehiculoDAO = new SedeVehiculoDAO();

        switch ($accion) {
            case "buscarSedePorId":
                $idS = $_POST["idS"];

                $datos = $sedeVehiculoDAO->buscarSedePorId($idS);
            break;

            case "buscarVehiculoPorId":
                $idV = $_POST["idV"];

                $datos = $sedeVehiculoDAO->buscarVehiculoPorId($idV);

                $_SESSION["sedes"] = $datos;
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else  
        header("Location: ../");
?>