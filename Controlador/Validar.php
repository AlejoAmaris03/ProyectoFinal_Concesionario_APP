<?php //Valida las acciones de Registrar, Iniciar Sesión o Cerrar Sesión
    include("../Modelo/ModeloUsuario/Usuario.php");
    include("../Modelo/ModeloUsuario/UsuarioDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $u = new Usuario();
        $usuarioDAO = new UsuarioDAO();

        switch ($accion){ //Verifica que acción se ejecutará
            case "Acceder": //Ejecuta la acción de Iniciar Sesión
                $usuario = $_POST["usuario"];
                $clave = $_POST["clave"];
                $tipoUsuario = $_POST["tipoUsuario"];

                $datos = $usuarioDAO->buscarUsuario($usuario,$clave,$tipoUsuario); //Verifica la existencia del usuario

                if(!empty($datos)){ //Si el usuario existe se crea la sesión
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

            case "Registrar": //Ejecuta la acción de Registrar un usuario
                $u->setNombre($_POST["nombre"]);
                $u->setApellido($_POST["apellido"]);
                $u->setCorreo($_POST["correo"]);
                $u->setFechaNacimiento($_POST["fechaNacimiento"]);
                $u->setTipoUsuario($_POST["tipoUsuario"]);
                $u->setUsuario($_POST["usuario"]);
                $u->setClave($_POST["clave"]);

                $datos = $usuarioDAO->agregarUsuarios($u); //Agregar al usuario
                $datos = $usuarioDAO->buscarUsuario($u->getUsuario(),$u->getClave(),$u->getTipoUsuario()); //Se toman los datos completos del usuario para crear la sesión

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

            case "Salir": //Ejecuta la acción de Cerrar la sesión
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