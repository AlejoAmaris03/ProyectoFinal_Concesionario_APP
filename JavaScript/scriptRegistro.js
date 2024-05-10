//Script que ejecuta las funciones de la vista que registra a los usuarios 

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
    document.form.nombre.focus();
}
function validarRegistro(){ //Verifica el formulario
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

    verificarCorreoUsuarioRegistro();
}
function verificarCorreoUsuarioRegistro(){ //Verifica que el correo no se repita
    correo = $("#correo").val();

    $.ajax({
        url: "../Controlador/ControladorUsuario.php",
        method: "POST",
        data: {
            correo: correo,
            accion: "verificarCorreoUsuario"
        },
        success: function(data){ 
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                verificarUsuarioRegistro();
            else
                mensaje("error","ERROR","Ya existe ese Correo Electrónico. Intentelo nuevamente!");
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error verificar el registro!");
        }
    });
}
function verificarUsuarioRegistro(){ //Verifica que el nombre de usuario no se repita
    usuario = $("#usuario").val();

    $.ajax({
        url: "../Controlador/ControladorUsuario.php",
        method: "POST",
        data: {
            usuario: usuario,
            accion: "verificarUsuario"
        },
        success: function(data){ 
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                agregarUsuarioRegistro();
            else
                mensaje("error","ERROR","Ya existe ese Nombre de Usuario. Intentelo nuevamente!");
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error verificar el registro!");
        }
    });
}
function listarVehiculos(){
    $.ajax({
        url: "../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            accion: "obtenerVehiculos"
        },
        success: function(data){
            window.location.href = "./VistaCliente/";
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar los Vehículos!");
        }
    });
}
function listarMarcasV(){
    $.ajax({
        url: "../Controlador/ControladorMarcas.php",
        method: "POST",
        data: {
            accion: "obtenerMarcasV"
        },
        success: function(data){
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar los Tipos de Vehículos!");
        }
    });
}
function listarTiposV(){
    $.ajax({
        url: "../Controlador/ControladorTipos.php",
        method: "POST",
        data: {
            accion: "obtenerTiposV"
        },
        success: function(data){
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar las Marcas de Vehículos!");
        }
    });
}
function listarEquipamientos(){
    $.ajax({
        url: "../Controlador/ControladorEquipamiento.php",
        method: "POST",
        data: {
            accion: "obtenerEquipamientos"
        },
        success: function(data){
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar los Equipamientos!");
        }
    });
}
function listarSedes(){
    $.ajax({
        url: "../Controlador/ControladorSede.php",
        method: "POST",
        data: {
            accion: "obtenerSedes"
        },
        success: function(data){
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar las Sedes!");
        }
    });
}
function agregarUsuarioRegistro(){ //Agrega un usuario
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
            tipoUsuario: 2,
            usuario: usuario,
            clave: clave,
            accion: "Registrar"
        },
        success: function(data){ 
            Swal.fire({
                icon: "success",
                title: "Registro Exitoso",
                text: "Su registro se ha generado de manera exitosa!",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continuar",
            }).then((result) => {
                if(result.isConfirmed){
                    listarMarcasV(); //Se listan los datos necesarios
                    listarTiposV();
                    listarEquipamientos();
                    listarVehiculos();
                }
                else{
                    listarMarcasV(); //Se listan los datos necesarios
                    listarTiposV();
                    listarEquipamientos();
                    listarVehiculos();
                }
            });
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al registrar el usuario!");
        }
    });
}