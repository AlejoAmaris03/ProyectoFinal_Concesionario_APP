<?php //Ejecuta las acciones para el módulo de recuperación de contraseña
    include("../Modelo/ModeloUsuario/Usuario.php");
    include("../Modelo/ModeloUsuario/UsuarioDAO.php");

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $u = new Usuario();
        $usuarioDAO = new UsuarioDAO();

        switch($accion){
            case "buscarUsuario":
                $correo = $_POST["correo"];
                $tipoUsuario = $_POST["tipoUsuario"];

                $datos = $usuarioDAO->buscarUsuarioPorCorreoYTipo($correo,$tipoUsuario);
            break;

            case "recuperarClave":
                $correo = $_POST["correo"];

                /*Código restante*/
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else   
        header("Location: ../");
?>