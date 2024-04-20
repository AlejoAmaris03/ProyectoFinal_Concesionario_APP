<?php
    /*include("../Modelo/ModeloAdmin/Admin.php");
    include("../Modelo/ModeloAdmin/AdminDAO.php");
    include("../Modelo/ModeloCliente/Cliente.php");
    include("../Modelo/ModeloCliente/ClienteDAO.php");*/
    session_start();

    $accion = $_POST["accion"];

    /*if(isset($_POST["accion"])){*/
        switch ($accion){
            case "Acceder":
                break;

            case "Registrar":
                break;

            case "Salir":
                //session_unset("u");
                session_destroy();
                header("Location: ../");
                break;
        }
    /*}
    else
        header("Location: ../");*/
?>