<?php
    /*include("../Modelo/ModeloAdmin/Admin.php");
    include("../Modelo/ModeloAdmin/AdminDAO.php");
    include("../Modelo/ModeloCliente/Cliente.php");
    include("../Modelo/ModeloCliente/ClienteDAO.php");*/
    session_start();

    $accion = $_POST["accion"];
    //$adminDAO = new AdminDAO();
    //$clienteDAO = new ClienteDAO();

    if(isset($_POST["accion"])){
        switch ($accion){ //Verifica que acción se ejecutará
            case "Acceder": //Inicia Sesión
                $usuario = $_POST["usuario"];
                $clave = $_POST["clave"];
                $tipo_usuario = $_POST["tipo_usuario"];

                if($tipo_usuario == "Estandar"){
                    $datos = $clienteDAO->buscarCliente();

                    if(!empty($datos)){
                        $u = $clienteDAO->obtenerCliente();
                        $_SESSION["u"] = $u;
                    }
                }
                else{
                    $datos = $adminDAO->buscarAdmin();

                    if(!empty($datos)){
                        $u = $adminDAO->obtenerAdmin();
                        $_SESSION["u"] = $u;
                    }
                }
            break;

            case "Registrar": //Registra un usuario
            break;

            case "Salir": //Cierra Sesión
                //session_unset("u");
                session_destroy();
                header("Location: ../");
            break;
        }
    }
    else
        header("Location: ../");
?>