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
    correo = $("#correo");
    tipoUsuario = $("#tipoUsuario");

    $.ajax({
        url: "../Controlador/ControladorRecuperarClave.php",
        method: "POST",
        data: {
            correo: correo,
            tipoUsuario: tipoUsuario,
            accion: "buscarUsuario"
        },
        success: function(data){
            datos = JSON.parse(data);

            if(Object.keys(datos).length !== 0){

            }
            else
                mensaje("error","Error","El Correo o el Tipo de Usuario son Incorrectos!");
        },
        error: function(data){

        }
    });
}
function recuperarClave(){ //Realiza la recuperación de la clave

}