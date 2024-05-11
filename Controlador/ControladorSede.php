<?php
    include("../Modelo/ModeloSede/Sede.php");
    include("../Modelo/ModeloSede/SedeDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $sede = new Sede();
        $sedeDAO = new SedeDAO();

        switch ($accion) {
            case "listarSedes":
                $datos = $sedeDAO->listarSedes();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["editar"] = '<button class="btnEditar" type="button" onclick="btnEditarSede('.$datos[$i]["ID"].')" title="Editar"><i class="fa-solid fa-pencil"></i></button>';
                        $datos[$i]["eliminar"] = '<button class="btnEliminar" type="button" onclick="btnEliminarSede('.$datos[$i]["ID"].')" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>';
                    }
                }
            break;

            case "obtenerSedes":
                $datos = $sedeDAO->listarSedes();

                if(!empty($datos))
                    $_SESSION["sede"] = $datos;
            break;

            case "buscarSedePorNombre":
                $nombre = $_POST["nombre"];

                $datos = $sedeDAO->buscarSedePorNombre($nombre);
            break;

            case "buscarSedePorIdNombre":
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];

                $datos = $sedeDAO->buscarSedePorIdNombre($id,$nombre);
            break;

            case "buscarSedePorDireccion":
                $direccion = $_POST["direccion"];

                $datos = $sedeDAO->buscarSedePorDireccion($direccion);
            break;

            case "buscarSedePorIdDireccion":
                $id = $_POST["id"];
                $direccion = $_POST["direccion"];

                $datos = $sedeDAO->buscarSedePorIdDireccion($id,$direccion);
            break;

            case "agregarSede":
                $sede->setNombre($_POST["nombre"]);
                $sede->setDireccion($_POST["direccion"]);

                $datos = $sedeDAO->agregarSedes($sede);
            break;

            case "editarSede":
                $id = $_POST["id"];

                $datos = $sedeDAO->buscarSedePorId($id);
            break;

            case "editar":
                $sede->setId($_POST["id"]);
                $sede->setNombre($_POST["nombre"]);
                $sede->setDireccion($_POST["direccion"]);

                $datos = $sedeDAO->modificarSedes($sede);
            break;

            case "eliminarSede":
                $id = $_POST["id"];

                $datos = $sedeDAO->eliminarSedes($id);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else  
        header("Location: ../");
?>