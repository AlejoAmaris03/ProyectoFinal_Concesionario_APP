//Funciones que verifican la ventana de Inicio de Sesión

function mensaje(icono,titulo,texto){ //Muestra las ventanas emergentes
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto,
        confirmButtonText: "Aceptar"
    });
}
function limpiar(){
    document.form.reset();
    document.form.usuario.focus();
}
function validar(){ //Verifica los espacios vacios
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
    tipo_usuario = $("#tipo_usuario").val();
    accion = "Acceder";

    $.ajax({
        url: "./Controlador/Validar.php",
        type: "POST",
        datatype: "json",
        data: {
            usuario: usuario,
            clave: clave,
            tipo_usuario: tipo_usuario,
            accion: accion
        },
        success: function(r){
            if(r == 1){
                if(tipo_usuario == "Cliente")
                    window.location.href = "./Vista/VistaCliente/";
                else    
                    window.location.href = "./Vista/VistaAdmin/";
            }
            else
                mensaje("error","Error","El Usuario, Contraseña o Tipo de Usuario son Incorrectos!");
        },
        error: function(r){
            mensaje("error","Error","Error al realizar el Ingreso!");
        }
    });
}