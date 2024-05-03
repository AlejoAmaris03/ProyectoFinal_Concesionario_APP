<?php
    include("../Modelo/ModeloVehiculo/Vehiculo.php");
    include("../Modelo/ModeloVehiculo/VehiculoDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $vehiculo = new Vehiculo();
        $vDAO = new VehiculoDAO();

        switch ($accion) {
            case "listarVehiculos":
                $datos = $vDAO->listarVehiculos();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["Imagen"] = '<input type="image" src="data:image/jpeg;base64,'.$datos[$i]["Imagen"].'" width="110px" height="80px" alt="Vehiculo">';
                        $datos[$i]["editar"] = '<button class="btnEditar" type="button" onclick="btnEditarVehiculo('.$datos[$i]["ID"].')" title="Editar"><i class="fa-solid fa-pencil"></i></button>';
                        $datos[$i]["inactivar"] = '<button class="btnInactivar" type="button" onclick="btnInactivarVehiculo('.$datos[$i]["ID"].')" title="Inactivar"><i class="fa-solid fa-trash"></i></button>';
                    }
                }
            break;

            case "obtenerVehiculos":
                $datos = $vDAO->listarVehiculos();

                if(!empty($datos))
                    $_SESSION["v"] = $datos;
            break;

            case "obtenerVehiculosPorFila":
                $fila = $_POST["fila"];

                $datos = $vDAO->listarVehiculosPorFila($fila);
            break;

            case "agregarVehiculo":
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

            case "verificarPlacaVehiculo":
                $placa = $_POST["placa"];

                $datos = $vDAO->verificarPlacaVehiculo($placa);
            break;

            case "verificarPlacaVehiculoActual":
                $id = $_POST["id"];
                $placa = $_POST["placa"];

                $datos = $vDAO->verificarPlacaVehiculoActual($id,$placa);
            break;

            case "verificarModeloVehiculo":
                $modelo = $_POST["modelo"];

                $datos = $vDAO->verificarModeloVehiculo($modelo);
            break;

            case "verificarModeloVehiculoActual":
                $id = $_POST["id"];
                $modelo = $_POST["modelo"];

                $datos = $vDAO->verificarModeloVehiculoActual($id,$modelo);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>