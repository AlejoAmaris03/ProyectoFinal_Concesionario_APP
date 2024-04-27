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
                        $datos[$i]["eliminar"] = '<button class="btnEliminar" type="button" onclick="btnEliminarUsuario('.$datos[$i]["ID"].')" title="Eliminar"><i class="fa-solid fa-trash-arrow-up"></i></button>';
                    }
                }
            break;

            case "editarUsuario":
                $id = $_POST["id"];

                $datos = $usuarioDAO->buscarUsuarioPorID($id);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else
        header("Location: ../");
?>