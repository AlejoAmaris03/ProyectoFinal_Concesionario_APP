<?php //Ejecuta las acciones del Administrador
    include("../Modelo/ModeloUsuario/Usuario.php");
    include("../Modelo/ModeloUsuario/UsuarioDAO.php");
    session_start();

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $u = new Usuario();
        $usuarioDAO = new UsuarioDAO();

        switch($accion){ //Verifica que acción se ejecutará
            case "listarUsuarios": //Lista todos los Usuarios
                $usuario = $_SESSION["u"]; //Toma el ID del usuario el cual tiene la sesión iniciada
                $datos = $usuarioDAO->listarUsuarios($usuario->getID());

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["editar"] = '<button class="btnEditar" type="button" onclick="btnEditarUsuario('.$datos[$i]["ID"].')" title="Editar"><i class="fa-solid fa-pencil"></i></button>';
                        $datos[$i]["inactivar"] = '<button class="btnInactivar" type="button" onclick="btnInactivarUsuario('.$datos[$i]["ID"].')" title="Inactivar"><i class="fa-solid fa-trash"></i></button>';
                    }
                }
            break;

            case "listarUsuariosInactivos": //Lista los usuarios inactivos
                $datos = $usuarioDAO->listarUsuariosInactivos();

                if(!empty($datos)){
                    for($i=0; $i<count($datos); $i++){
                        $datos[$i]["activar"] = '<button class="btnActivar" type="button" onclick="btnActivarUsuario('.$datos[$i]["ID"].')" title="Activar"><i class="fa-solid fa-trash-arrow-up"></i></button>';
                        $datos[$i]["eliminar"] = '<button class="btnEliminar" type="button" onclick="btnEliminarUsuario('.$datos[$i]["ID"].')" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>';
                    }
                }
            break;

            case "verificarCorreoUsuario": //Verifica la existencia de un correo
                $correo = $_POST["correo"];

                $datos = $usuarioDAO->buscarUsuarioPorCorreo($correo);
            break;

            case "verificarUsuario": //Verifica la existencia de un nombre de usuario
                $usuario = $_POST["usuario"];

                $datos = $usuarioDAO->buscarUsuarioPorNombreUsuario($usuario);
            break;
 
            case "verificarCorreoUsuarioActual": //Verifica la existencia de un correo excluyendo a un usuario en específico
                $id = $_POST["id"];
                $correo = $_POST["correo"];

                $datos = $usuarioDAO->verificarUsuarioPorIdCorreo($id,$correo);
            break;

            case "verificarUsuarioPorId": //Verifica la existencia de un nombre de usuario excluyendo a un usuario en específico
                $id = $_POST["id"];
                $usuario = $_POST["usuario"];

                $datos = $usuarioDAO->verificarUsuarioPorIdUsuario($id,$usuario);
            break;
            
            case "agregarUsuario": //Agrega un usuario
                $u->setNombre($_POST["nombre"]);
                $u->setApellido($_POST["apellido"]);
                $u->setCorreo($_POST["correo"]);
                $u->setFechaNacimiento($_POST["fechaNacimiento"]);
                $u->setTipoUsuario($_POST["tipoUsuario"]);
                $u->setUsuario($_POST["usuario"]);
                $u->setClave($_POST["clave"]);

                $datos = $usuarioDAO->agregarUsuarios($u);
            break;

            case "editarUsuario": //Busca un usuario por su ID
                $id = $_POST["id"];

                $datos = $usuarioDAO->buscarUsuarioPorID($id);
            break;

            case "editar": //Edita la información de un usuario (como administrador)
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
 
            case "editarUsuarioActual": //Edita la información del usuario que tiene iniciada la sesión
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
                $_SESSION["u"] = $u; //Actualiza la sesión con los nuevos datos
            break;

            case "inactivarUsuario": //Inactiva un usuario
                $id = $_POST["id"];

                $datos = $usuarioDAO->modificarEstadoUsuario($id,"Inactivo");
            break;

            case "activarUsuario": //Activa un usuario
                $id = $_POST["id"];

                $datos = $usuarioDAO->modificarEstadoUsuario($id,"Activo");
            break;

            case "eliminarUsuario": //Elimina un usuario
                $id = $_POST["id"];

                $datos = $usuarioDAO->eliminarUsuario($id);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>