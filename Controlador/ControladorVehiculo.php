<?php
    include("../Modelo/ModeloVehiculo/Vehiculo.php");
    include("../Modelo/ModeloVehiculo/VehiculoDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $vehiculo = new Vehiculo();
        $vDAO = new VehiculoDAO();

        switch ($accion) {
            case "listarVehiculos": //Lista todos los vehículos
                $datos = $vDAO->listarVehiculos();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["Imagen"] = '<input type="image" src="data:image/jpeg;base64,'.$datos[$i]["Imagen"].'" width="110px" height="80px" alt="Vehiculo">';
                        $datos[$i]["editar"] = '<button class="btnEditar" type="button" onclick="btnEditarVehiculo('.$datos[$i]["ID"].')" title="Editar"><i class="fa-solid fa-pencil"></i></button>';
                        $datos[$i]["inactivar"] = '<button class="btnInactivar" type="button" onclick="btnInactivarVehiculo('.$datos[$i]["ID"].')" title="Inactivar"><i class="fa-solid fa-trash"></i></button>';
                    }
                }
            break;

            case "listarVehiculosInactivos": //Lista todos los vehículos inactivos
                $datos = $vDAO->listarVehiculosInactivos();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["Imagen"] = '<input type="image" src="data:image/jpeg;base64,'.$datos[$i]["Imagen"].'" width="110px" height="80px" alt="Vehiculo">';
                        $datos[$i]["activar"] = '<button class="btnActivar" type="button" onclick="btnActivarVehiculo('.$datos[$i]["ID"].')" title="Activar"><i class="fa-solid fa-trash-arrow-up"></i></button>';
                        $datos[$i]["eliminar"] = '<button class="btnEliminar" type="button" onclick="btnEliminarVehiculo('.$datos[$i]["ID"].')" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>';
                    }
                }
            break;

            case "obtenerVehiculos": //Retorna todas las filas de la tabla Vehículos
                $datos = $vDAO->listarVehiculos();

                $_SESSION["v"] = $datos;
            break;

            case "obtenerVehiculosPorFila": //Retorna fila específica de la tabla Vehículos
                $fila = $_POST["fila"];

                $datos = $vDAO->listarVehiculosPorFila($fila);
            break;

            case "agregarVehiculo": //Agrega un vehículo
                $img = $_FILES["imagen"];
                $img = file_get_contents($img["tmp_name"]);
                $img = base64_encode($img);

                $vehiculo->setImagen($img);
                $vehiculo->setPlaca($_POST["placa"]);
                $vehiculo->setModelo($_POST["modelo"]);
                $vehiculo->setMarca($_POST["marca"]);
                $vehiculo->setTipo($_POST["tipo"]);
                $vehiculo->setDescripcion($_POST["descripcion"]);
                $vehiculo->setCantidad($_POST["cantidad"]);
                $vehiculo->setPrecio($_POST["precio"]);

                $datos = $vDAO->agregarVehiculo($vehiculo);
            break;

            case "verificarPlacaVehiculo": //Busca la placa de un Vehículo
                $placa = $_POST["placa"];

                $datos = $vDAO->verificarPlacaVehiculo($placa);
            break;

            case "verificarPlacaVehiculoActual": //Busca la placa de un Vehículo excluyendo a uno específico
                $id = $_POST["id"];
                $placa = $_POST["placa"];

                $datos = $vDAO->verificarPlacaVehiculoActual($id,$placa);
            break;

            case "verificarModeloVehiculo": //Busca el modelo de un Vehículo
                $modelo = $_POST["modelo"];

                $datos = $vDAO->verificarModeloVehiculo($modelo);
            break;

            case "verificarModeloVehiculoActual": //Busca el modelo de un Vehículo excluyendo a uno específico
                $id = $_POST["id"];
                $modelo = $_POST["modelo"];

                $datos = $vDAO->verificarModeloVehiculoActual($id,$modelo);
            break;

            case "editarVehiculo": //Toma los datos de determinado Vehículo
                $id = $_POST["id"];

                $datos = $vDAO->buscarVehiculoPorID($id);
            break;

            case "editar": //Edita la información de un Vehículo
                if(isset($_FILES["imagen"])){
                    $img = $_FILES["imagen"];
                    $img = file_get_contents($img["tmp_name"]);
                    $img = base64_encode($img);

                    $vehiculo->setImagen($img);
                }
                else
                    $vehiculo->setImagen(NULL);

                $vehiculo->setId($_POST["id"]);
                $vehiculo->setPlaca($_POST["placa"]);
                $vehiculo->setModelo($_POST["modelo"]);
                $vehiculo->setMarca($_POST["marca"]);
                $vehiculo->setTipo($_POST["tipo"]);
                $vehiculo->setDescripcion($_POST["descripcion"]);
                $vehiculo->setCantidad($_POST["cantidad"]);
                $vehiculo->setPrecio($_POST["precio"]);

                $datos = $vDAO->modificarVehiculos($vehiculo);
            break;

            case "inactivarVehiculo": //Inactiva un vehículo
                $id = $_POST["id"];

                $datos = $vDAO->modificarEstadoVehiculo($id,2);
            break;

            case "activarVehiculo": //Activa un vehículo
                $id = $_POST["id"];

                $datos = $vDAO->modificarEstadoVehiculo($id,1);
            break;

            case "eliminarVehiculo": //Elimina un vehículo
                $id = $_POST["id"];

                $datos = $vDAO->eliminarVehiculo($id);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>