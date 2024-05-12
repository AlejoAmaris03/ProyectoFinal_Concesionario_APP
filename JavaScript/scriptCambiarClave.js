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
function btnCambiarClave(){ //Verifica el formulario
    let form = document.form;

    if(form.clave.value.trim() === ""){
        mensaje("error","Error","La Contraseña es Requerida!");

        return false;
    }

    cambiarClave();
}
function cambiarClave(){ //Verifica la existencia del correo
    id = $("#id").val();
    clave = $("#clave").val();

    $.ajax({
        url: "../Controlador/ControladorRecuperarClave.php",
        method: "POST",
        data: {
            id: id,
            clave: clave,
            accion: "cambiarClave"
        },
        success: function(data){
            Swal.fire({
                icon: "success",
                title: "Contraseña Modificada",
                text: "La contraseña se modificó correctamente!",
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