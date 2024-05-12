//Script que ejecuta las funciones de la vista que permite recuperar la contraseña 

function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto,
        confirmButtonText: "Aceptar"
    });
}
function limpiar(){ //Limpia el formulario
    document.form.reset();
}
function btnRecuperarClave(){ //Verifica el formulario
    let form = document.form;
    let correo = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    if(form.correo.value.trim() === ""){
        mensaje("error","Error","El Correo es Requerido!");

        return false;
    }
    if(!correo.test(form.correo.value)){
        mensaje("error","Error","El correo NO es Valido!");

        return false;
    }

    validarDatos();
}
function validarDatos(){ //Verifica la existencia del correo
    correo = $("#correo").val();

    $.ajax({
        url: "../Controlador/ControladorRecuperarClave.php",
        method: "POST",
        data: {
            correo: correo,
            accion: "buscarUsuario"
        },
        success: function(data){
            datos = JSON.parse(data);

            if(Object.keys(datos).length !== 0){
                if(datos[0]["Estado"] == "Activo") //Se verifica si el usuario está activo o no
                    recuperarClave();
                else
                    mensaje("error","Error","Su cuenta está Inactiva. Intentelo en otra ocasión!");
            }
            else
                mensaje("error","Error","El Correo es Incorrecto!");
        },
        error: function(data){
            mensaje("error","Error","Error al realizar la Recuperación de Contraseña!");
        }
    });
}
function recuperarClave(){ //Realiza la recuperación de la clave
    correo = $("#correo").val();

    $.ajax({
        url: "../Controlador/ControladorRecuperarClave.php",
        method: "POST",
        data: {
            correo: correo,
            accion: "recuperarClave"
        },
        success: function(data){
            Swal.fire({
                icon: "success",
                title: "Correo Enviado",
                text: "Se envio un mensaje, por favor verifique su correo electrónico!",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
            }).then((result) => {
                if(result.isConfirmed)
                    window.location.href = "./iniciarSesion.php";
                else
                    window.location.href = "./iniciarSesion.php";
            });
        },
        error: function(data){
            mensaje("error","Error","Error al realizar la Recuperación de Contraseña!");
        }
    });
}