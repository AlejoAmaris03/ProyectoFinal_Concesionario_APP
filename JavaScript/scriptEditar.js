//Script que ejecuta las funciones de la vista que se encarga de editar la información del ususario que tiene iniciada la sesión

function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
}
function btnMostarBotonEditar(){ //Muestra el botón de editar
    document.getElementById("btnEditarUsuarioActual").style.display = "block";
}
function btnEditarUsuarioActual(){ //Verifica el formulario
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

    verificarCorreoUsuarioActual();
}
function verificarCorreoUsuarioActual(){  //Verifica que el correo no se repita
    id = $("#id").val();
    correo = $("#correo").val();

    $.ajax({
        url: "../../Controlador/ControladorUsuario.php",
        method: "POST",
        data: {
            id: id,
            correo: correo,
            accion: "verificarCorreoUsuarioActual"
        },
        success: function(data){ 
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                verificarUsuarioActual();
            else
                mensaje("error","ERROR","Ya existe ese Correo Electrónico. Intentelo nuevamente!");
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error verificar el registro!");
        }
    });
}
function verificarUsuarioActual(){ //Verifica que el nombre de usuario no se repita
    id = $("#id").val();
    usuario = $("#usuario").val();

    $.ajax({
        url: "../../Controlador/ControladorUsuario.php",
        method: "POST",
        data: {
            id: id,
            usuario: usuario,
            accion: "verificarUsuarioPorId"
        },
        success: function(data){ 
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0){
                Swal.fire({
                    icon: "warning",
                    title: "Editar Información",
                    text: "¿Desea editar la información?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continuar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if(result.isConfirmed)
                        editarInformacion();
                });
            }
            else
                mensaje("error","ERROR","Ya existe ese Nombre de Usuario. Intentelo nuevamente!");
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error verificar el usuario!");
        }
    });
}
function confirmar(){
    
}
function editarInformacion(){ //Edita la información
    id = $("#id").val();
    nombre = $("#nombre").val();
    apellido = $("#apellido").val();
    correo = $("#correo").val();
    fechaNacimiento = $("#fechaNacimiento").val();
    tipoUsuario = $("#tipoUsuario").val();
    usuario = $("#usuario").val();
    clave = $("#clave").val();
    estado = 1;

    if(tipoUsuario == "Administrador")
        tipoUsuario = 1;
    else
        tipoUsuario = 2;

    $.ajax({
        url: "../../Controlador/ControladorUsuario.php",
        method: "POST",
        data: {
            id: id,
            nombre: nombre,
            apellido: apellido,
            correo: correo,
            fechaNacimiento: fechaNacimiento,
            tipoUsuario: tipoUsuario,
            usuario: usuario,
            clave: clave,
            estado: estado,
            accion: "editarUsuarioActual"
        },
        success: function(data){    
            Swal.fire({
                icon: "success",
                title: "Información Editada",
                text: "La información se editó correctamente!",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
            }).then((result) => {
                if(result.isConfirmed)
                    window.location.reload();
                else
                    window.location.reload();
            });
        },
        error: function(data){  
            mensaje("error","ERROR","Ha ocurrido un error al editar la información!");
        }
    });

    document.getElementById("btnEditarUsuarioActual").style.display = "none";
}