<?php //Ejecuta las acciones para el módulo de recuperación de contraseña
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use \PHPMailer\PHPMailer\SMTP;

    include("../Modelo/ModeloUsuario/Usuario.php");
    include("../Modelo/ModeloUsuario/UsuarioDAO.php");
    require("../RecuperarClave/PHPMailer/Exception.php");
    require("../RecuperarClave/PHPMailer/PHPMailer.php");
    require("../RecuperarClave/PHPMailer/SMTP.php");

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
        $u = new Usuario();
        $usuarioDAO = new UsuarioDAO();

        switch($accion){
            case "buscarUsuario":
                $correo = $_POST["correo"];

                $datos = $usuarioDAO->buscarUsuarioPorCorreo($correo);
            break;

            case "recuperarClave":
                $correo = $_POST["correo"];
                $link = "http://localhost/Programaci%C3%B3n/Proyecto%20Final%20-%20Concesionario%20(APP)/ProyectoFinal_Concesionario_APP/";

                $datos = $usuarioDAO->buscarUsuarioPorCorreo($correo);
                
                if(!empty($datos)){
                    $mail = new PHPMailer();

                    try{
                        //Se configura el servidor  
                        
                        $mail->SMTPDebug=2;                 
                        $mail->isSMTP();                                           
                        $mail->Host       = 'smtp.gmail.com';                     
                        $mail->SMTPAuth   = true;                                   
                        $mail->Username   = 'concesionarioud@gmail.com';                     
                        $mail->Password   = 'reie smyd zxlo ftsj';  
                        $mail->SMTPSecure = 'tls';                                     
                        $mail->Port       = 587;         

                        //Se adiciona la info para enviar el correo
                        $mail->setFrom('concesionarioud@gmail.com', 'Concesionario');
                        $mail->addAddress($datos[0]["Correo"],"");     //Se agrega el destinatario
                        $mail->isHTML(true);
                        $mail->Subject = 'Lo invitamos a que recupere su clave';
                        $mail->Body    = 'Hey, recupera tu clave ingresando utilizando el siguiente link <a href="'.$link.'/Vista/cambiarClave.php?idUsuario='.$datos[0]['ID'].'">Recupere su Contraseña</a>';
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        $mail->send();
                    } 
                    catch(Exception $e){
                        die("ERROR al enviar el mensaje: <br>".$mail->ErrorInfo);
                    }
                }
                else
                    header("Location: ../");
            break;

            case "cambiarClave":
                $id = $_POST["id"];
                $clave = $_POST["clave"];

                $datos = $usuarioDAO->modificarClave($id,$clave);
            break;
        }

        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    }
    else   
        header("Location: ../");
?>