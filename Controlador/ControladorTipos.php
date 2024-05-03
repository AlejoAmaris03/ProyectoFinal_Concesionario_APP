<?php
    include("../Modelo/ModeloTipoVehiculo/TipoVehiculo.php");
    include("../Modelo/ModeloTipoVehiculo/TipoVehiculoDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $tipoVehiculo = new TipoVehiculo();
        $tVDAO = new TipoVehiculoDAO();

        switch ($accion) {
            case "listarTipos":
                $datos = $tVDAO->listarTiposVehiculos();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["editar"] = '<button class="btnEditar" type="button" onclick="btnEditarTipo('.$datos[$i]["ID"].')" title="Editar"><i class="fa-solid fa-pencil"></i></button>';
                        $datos[$i]["eliminar"] = '<button class="btnEliminar" type="button" onclick="btnEliminarTipo('.$datos[$i]["ID"].')" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>';
                    }
                }
            break;

            case "obtenerTiposV":
                $datos = $tVDAO->listarTiposVehiculos();

                if(!empty($datos))
                    $_SESSION["tipoV"] = $datos;
            break;

            case "buscarTipoPorNombre":
                $nombre = $_POST["nombre"];

                $datos = $tVDAO->buscarTipoPorNombre($nombre);
            break;

            case "buscarTipoPorIdNombre":
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];

                $datos = $tVDAO->buscarTipoPorIdNombre($id,$nombre);
            break;

            case "agregarTipo":
                $tipoVehiculo->setNombre($_POST["nombre"]);

                $datos = $tVDAO->agregarTipoVehiculo($tipoVehiculo);
            break;

            case "editarTipo":
                $id = $_POST["id"];

                $datos = $tVDAO->buscarTipoPorId($id);
            break;

            case "editar":
                $tipoVehiculo->setId($_POST["id"]);
                $tipoVehiculo->setNombre($_POST["nombre"]);

                $datos = $tVDAO->modificarTipoVehiculo($tipoVehiculo);
            break;

            case "eliminarTipo":
                $id = $_POST["id"];

                $datos = $tVDAO->eliminarTipoVehiculo($id);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else  
        header("Location: ../");
?>