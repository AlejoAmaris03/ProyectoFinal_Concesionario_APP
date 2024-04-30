//Script que ejecuta las funciones de la vista que inica sesión

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
    document.form.usuario.focus();
}
function validar(){  //Verifica el formulario
    let form = document.form;

    if(form.usuario.value.trim() === ""){
        mensaje("error","Error","El Nombre de Usuario es Requerido!");

        return false;
    }
    if(form.clave.value.trim() === ""){
        mensaje("error","Error","La contraseña es Requerida!");

        return false;
    }

    validarIngreso();
}
function validarIngreso(){ //Realiza el inicio de la sesión
    usuario = $("#usuario").val();
    clave = $("#clave").val();
    tipoUsuario = $("#tipoUsuario").val();
    accion = "Acceder";

    $.ajax({
        url: "./Controlador/Validar.php",
        method: "POST",
        data: {
            usuario: usuario,
            clave: clave,
            tipoUsuario: tipoUsuario,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(Object.keys(datos).length !== 0){ //Se verifica que el usuario exista
                if(datos[0]["Estado"] != "Inactivo"){ //Se verifica si el usuario está activo o on
                    if(tipoUsuario == "Estandar") //Redirije al usuario de acuerdo a su tipo de usuario (Administrador / Estándar [Cliente])
                        window.location.href = "./Vista/VistaCliente/";
                    else    
                        window.location.href = "./Vista/VistaAdmin/";
                }
                else   
                    mensaje("error","Error","Su cuenta está Inactiva. Intentelo en otra ocasión!");
            }
            else
                mensaje("error","Error","El Usuario, la Contraseña o el Tipo de Usuario son Incorrectos!");
        },
        error: function(data){
            mensaje("error","Error","Error al realizar el Ingreso!");
        }
    });
}