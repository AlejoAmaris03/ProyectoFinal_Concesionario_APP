<?php //Valida las acciones del Administrador
    include("../Modelo/ModeloUsuario/Usuario.php");
    include("../Modelo/ModeloUsuario/UsuarioDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $u = new Usuario();
        $usuarioDAO = new UsuarioDAO();

        switch ($accion){ //Verifica que acción se ejecutará
            case "listarUsuarios": //Lista todos los Usuarios
                $usuario = $_SESSION["u"];
                $datos = $usuarioDAO->listarUsuarios($usuario->getID());

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["editar"] = '<button class="btnEditar" type="button" onclick="btnEditarUsuario('.$datos[$i]["ID"].')" title="Editar"><i class="fa-solid fa-pencil"></i></button>';
                        $datos[$i]["inactivar"] = '<button class="btnInactivar" type="button" onclick="btnInactivarUsuario('.$datos[$i]["ID"].')" title="Inactivar"><i class="fa-solid fa-trash"></i></button>';
                    }
                }
            break;

            case "listarUsuariosInactivos":
                $datos = $usuarioDAO->listarUsuariosInactivos();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["activar"] = '<button class="btnActivar" type="button" onclick="btnActivarUsuario('.$datos[$i]["ID"].')" title="Activar"><i class="fa-solid fa-trash-arrow-up"></i></button>';
                        $datos[$i]["eliminar"] = '<button class="btnEliminar" type="button" onclick="btnEliminarUsuario('.$datos[$i]["ID"].')" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>';
                    }
                }
            break;

            case "verificarCorreoUsuario":
                $correo = $_POST["correo"];
                $tipoUsuario = $_POST["tipoUsuario"];

                $datos = $usuarioDAO->buscarUsuarioPorCorreo($correo,$tipoUsuario);
            break;

            case "verificarUsuario":
                $usuario = $_POST["usuario"];
                $tipoUsuario = $_POST["tipoUsuario"];

                $datos = $usuarioDAO->buscarUsuarioPorUsuarioTipo($usuario,$tipoUsuario);
            break;

            case "verificarCorreoUsuarioActual":
                $id = $_POST["id"];
                $correo = $_POST["correo"];
                $tipoUsuario = $_POST["tipoUsuario"];

                $datos = $usuarioDAO->verificarUsuarioPorIdCorreo($id,$correo,$tipoUsuario);
            break;

            case "verificarUsuarioPorId":
                $id = $_POST["id"];
                $usuario = $_POST["usuario"];
                $tipoUsuario = $_POST["tipoUsuario"];

                $datos = $usuarioDAO->verificarUsuarioPorId($id,$usuario,$tipoUsuario);
            break;
            
            case "agregarUsuario":
                $u->setNombre($_POST["nombre"]);
                $u->setApellido($_POST["apellido"]);
                $u->setCorreo($_POST["correo"]);
                $u->setFechaNacimiento($_POST["fechaNacimiento"]);
                $u->setTipoUsuario($_POST["tipoUsuario"]);
                $u->setUsuario($_POST["usuario"]);
                $u->setClave($_POST["clave"]);

                $datos = $usuarioDAO->agregarUsuarios($u);
            break;

            case "editarUsuario":
                $id = $_POST["id"];

                $datos = $usuarioDAO->buscarUsuarioPorID($id);
            break;

            case "editar":
                $u->setId($_POST["id"]);
                $u->setNombre($_POST["nombre"]);
                $u->setApellido($_POST["apellido"]);
                $u->setCorreo($_POST["correo"]);
                $u->setFechaNacimiento($_POST["fechaNacimiento"]);
                $u->setTipoUsuario($_POST["tipoUsuario"]);
                $u->setUsuario($_POST["usuario"]);
                $u->setClave($_POST["clave"]);

                $datos = $usuarioDAO->modificarUsuarios($u);
            break;

            case "editarUsuarioActual":
                $u->setId($_POST["id"]);
                $u->setNombre($_POST["nombre"]);
                $u->setApellido($_POST["apellido"]);
                $u->setCorreo($_POST["correo"]);
                $u->setFechaNacimiento($_POST["fechaNacimiento"]);
                $u->setTipoUsuario($_POST["tipoUsuario"]);
                $u->setUsuario($_POST["usuario"]);
                $u->setClave($_POST["clave"]);
                $u->setEstado($_POST["estado"]);

                $datos = $usuarioDAO->modificarUsuarios($u);
                $_SESSION["u"] = $u;
            break;

            case "inactivarUsuario":
                $id = $_POST["id"];

                $datos = $usuarioDAO->modificarEstadoUsuario($id,"Inactivo");
            break;

            case "activarUsuario":
                $id = $_POST["id"];

                $datos = $usuarioDAO->modificarEstadoUsuario($id,"Activo");
            break;

            case "eliminarUsuario":
                $id = $_POST["id"];

                $datos = $usuarioDAO->eliminarUsuario($id);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>