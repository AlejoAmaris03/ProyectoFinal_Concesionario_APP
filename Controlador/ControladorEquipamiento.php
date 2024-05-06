<?php //Ejecuta las acciones del Administrador
    include("../Modelo/ModeloEquipamiento/Equipamiento.php");
    include("../Modelo/ModeloEquipamiento/EquipamientoDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $e = new Equipamiento();
        $eDAO = new EquipamientoDAO();

        switch($accion){ //Verifica que acción se ejecutará
            case "listarEquipamientos":
                $datos = $eDAO->listarEquipamientos();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["editar"] = '<button class="btnEditar" type="button" onclick="btnEditarEquipamiento('.$datos[$i]["ID"].')" title="Editar"><i class="fa-solid fa-pencil"></i></button>';
                        $datos[$i]["eliminar"] = '<button class="btnEliminar" type="button" onclick="btnEliminarEquipamiento('.$datos[$i]["ID"].')" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>';
                    }
                }
            break;

            case "obtenerEquipamientos":
                $datos = $eDAO->listarEquipamientos();

                if(!empty($datos))
                    $_SESSION["equipamiento"] = $datos;
            break;

            case "buscarEquipamientoPorNombre":
                $nombre = $_POST["nombre"];

                $datos = $eDAO->buscarEquipamientoPorNombre($nombre);
            break;

            case "buscarEquipamientoPorIdNombre":
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];

                $datos = $eDAO->buscarEquipamientoPorIdNombre($id,$nombre);
            break;

            case "agregarEquipamiento":
                $e->setNombre($_POST["nombre"]);
                $e->setPrecio($_POST["precio"]);

                $datos = $eDAO->agregarEquipamiento($e);
            break;

            case "editarEquipamiento":
                $id = $_POST["id"];

                $datos = $eDAO->buscarEquipamentoPorId($id);
            break;

            case "editar":
                $e->setId($_POST["id"]);
                $e->setNombre($_POST["nombre"]);
                $e->setPrecio($_POST["precio"]);

                $datos = $eDAO->modificarEquipamento($e);
            break;

            case "eliminarEquipamento":
                $id = $_POST["id"];

                $datos = $eDAO->eliminarEquipamento($id);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>