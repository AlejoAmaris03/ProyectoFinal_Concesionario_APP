<?php
    include("../Modelo/ModeloMarcaVehiculo/MarcaVehiculo.php");
    include("../Modelo/ModeloMarcaVehiculo/MarcaVehiculoDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $marcaVehiculo = new MarcaVehiculo();
        $mVDAO = new MarcaVehiculoDAO();

        switch ($accion){
            case "listarMarcas":
                $datos = $mVDAO->listarMarcasVehiculos();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["editar"] = '<button class="btnEditar" type="button" onclick="btnEditarMarca('.$datos[$i]["ID"].')" title="Editar"><i class="fa-solid fa-pencil"></i></button>';
                        //$datos[$i]["eliminar"] = '<button class="btnEliminar" type="button" onclick="btnEliminarMarca('.$datos[$i]["ID"].')" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>';
                    }
                }
            break;

            case "obtenerMarcasV":
                $datos = $mVDAO->listarMarcasVehiculos();

                if(!empty($datos))
                    $_SESSION["marcaV"] = $datos;
            break;

            case "buscarMarcaPorNombre":
                $nombre = $_POST["nombre"];

                $datos = $mVDAO->buscarMarcaPorNombre($nombre);
            break;

            case "buscarMarcaPorIdNombre":
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];

                $datos = $mVDAO->buscarMarcaPorIdNombre($id,$nombre);
            break;

            case "agregarMarca":
                $marcaVehiculo->setNombre($_POST["nombre"]);

                $datos = $mVDAO->agregarMarcaVehiculo($marcaVehiculo);
            break;

            case "editarMarca":
                $id = $_POST["id"];

                $datos = $mVDAO->buscarMarcaPorId($id);
            break;

            case "editar":
                $marcaVehiculo->setId($_POST["id"]);
                $marcaVehiculo->setNombre($_POST["nombre"]);

                $datos = $mVDAO->modificarMarcaVehiculo($marcaVehiculo);
            break;

            /*case "eliminarMarca":
                $id = $_POST["id"];

                $datos = $mVDAO->eliminarMarcaVehiculo($id);
            break;*/
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else  
        header("Location: ../");
?>