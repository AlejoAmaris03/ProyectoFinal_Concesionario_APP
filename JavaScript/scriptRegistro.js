//Funciones que verifican la ventana de Registro de Usuarios

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
    document.form.nombre.focus();
}
function validar(){
    let form = document.form;
    let correo = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    if(form.nombre.value.trim() === ""){
        mensaje("error","Error","El Nombre es Requerido!");

        return false;
    }
    if(form.apellido.value.trim() === ""){
        mensaje("error","Error","El Apellido es Requerido!");

        return false;
    }

    if(form.correo.value.trim() === ""){
        mensaje("error","Error","El Correo es Requerido!");

        return false;
    }
    if(!correo.test(form.correo.value)){
        mensaje("error","Error","El correo NO es Valido!");

        return false;
    }

    if(form.fechaNacimiento.value.trim() === ""){
        mensaje("error","Error","La Fecha de Nacimiento es Requerida!");
        
        return false;
    }
    if(form.usuario.value.trim() === ""){
        mensaje("error","Error","El Nombre de Usuario es Requerido!");

        return false;
    }
    if(form.clave.value.trim() === ""){
        mensaje("error","Error","La Contraseña es Requerida!");
        
        return false;
    }

    verificarUsuario();
}
function verificarUsuario(){
    usuario = $("#usuario").val();

    $.ajax({
        url: "../Controlador/ControladorAdmin.php",
        method: "POST",
        data: {
            usuario: usuario,
            tipoUsuario: "Estandar",
            accion: "verificarUsuario"
        },
        success: function(data){ 
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                agregarUsuario();
            else
                mensaje("error","ERROR","Ya existe ese Nombre de Usuario. Intentelo nuevamente!");
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error verificar el registro!");
        }
    });
}
function agregarUsuario(){
    nombre = $("#nombre").val();
    apellido = $("#apellido").val();
    correo = $("#correo").val();
    fechaNacimiento = $("#fechaNacimiento").val();
    usuario = $("#usuario").val();
    clave = $("#clave").val();

    $.ajax({
        url: "../Controlador/Validar.php",
        method: "POST",
        data: {
            nombre: nombre,
            apellido: apellido,
            correo: correo,
            fechaNacimiento: fechaNacimiento,
            tipoUsuario: "Estandar",
            usuario: usuario,
            clave: clave,
            accion: "Registrar"
        },
        success: function(data){ 
            window.location = "./VistaCliente/";            
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al registrar el usuario!");
        }
    });
}