<?php //Valida las acciones de Registrar, Iniciar Sesión o Cerrar Sesión
    include("../Modelo/ModeloUsuario/Usuario.php");
    include("../Modelo/ModeloUsuario/UsuarioDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $u = new Usuario();
        $usuarioDAO = new UsuarioDAO();

        switch ($accion){ //Verifica que acción se ejecutará
            case "Acceder": //Inicia Sesión
                $usuario = $_POST["usuario"];
                $clave = $_POST["clave"];
                $tipoUsuario = $_POST["tipoUsuario"];

                $datos = $usuarioDAO->buscarUsuario($usuario,$clave,$tipoUsuario);

                if(!empty($datos)){
                    $u->setId($datos[0]["ID"]);
                    $u->setNombre($datos[0]["Nombre"]); 
                    $u->setApellido($datos[0]["Apellido"]);
                    $u->setCorreo($datos[0]["Correo"]);
                    $u->setFechaNacimiento($datos[0]["FechaNacimiento"]);
                    $u->setTipoUsuario($datos[0]["TipoUsuario"]);
                    $u->setUsuario($datos[0]["Usuario"]);
                    $u->setClave($datos[0]["Clave"]);
                    $u->setEstado($datos[0]["Estado"]);

                    $_SESSION["u"] = $u; 
                }  
            break;

            case "Registrar": //Registra un usuario
                $u->setNombre($_POST["nombre"]);
                $u->setApellido($_POST["apellido"]);
                $u->setCorreo($_POST["correo"]);
                $u->setFechaNacimiento($_POST["fechaNacimiento"]);
                $u->setTipoUsuario($_POST["tipoUsuario"]);
                $u->setUsuario($_POST["usuario"]);
                $u->setClave($_POST["clave"]);

                $datos = $usuarioDAO->agregarUsuarios($u);
                $datos = $usuarioDAO->buscarUsuario($u->getUsuario(),$u->getClave(),$u->getTipoUsuario());

                $u->setId($datos[0]["ID"]);
                $u->setNombre($datos[0]["Nombre"]); 
                $u->setApellido($datos[0]["Apellido"]);
                $u->setCorreo($datos[0]["Correo"]);
                $u->setFechaNacimiento($datos[0]["FechaNacimiento"]);
                $u->setTipoUsuario($datos[0]["TipoUsuario"]);
                $u->setUsuario($datos[0]["Usuario"]);
                $u->setClave($datos[0]["Clave"]);
                $u->setEstado($datos[0]["Estado"]);

                $_SESSION["u"] = $u;
            break;

            case "Salir": //Cierra Sesión
                session_unset();
                session_destroy();
                header("Location: ../");
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>