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
    if(grecaptcha.getResponse().length === 0){
        mensaje("error","Error","El Captcha es Requerido!");

        return false;
    }

    validarIngreso();
}
function listarVehiculosDisponibles(tipoUsuario){
    $.ajax({
        url: "../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            accion: "obtenerVehiculos"
        },
        success: function(data){
            if(tipoUsuario == "Cliente") //Redirije al usuario de acuerdo a su tipo de usuario (Administrador / Estándar [Cliente] / Vendedor)
                window.location.href = "./VistaCliente/";
            else if(tipoUsuario == "Administrador")    
                window.location.href = "./VistaAdmin/";
            else
                window.location.href = "./VistaVendedor/";
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar los Vehículos!");
        }
    });
}
function listarMarcasVehiculos(){
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
function listarTiposVehiculos(){
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
function listarEquipamientosV(){
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
function validarIngreso(){ //Realiza el inicio de la sesión
    usuario = $("#usuario").val();
    clave = $("#clave").val();
    accion = "Acceder";

    $.ajax({
        url: "../Controlador/Validar.php",
        method: "POST",
        data: {
            usuario: usuario,
            clave: clave,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(Object.keys(datos).length !== 0){ //Se verifica que el usuario exista
                if(datos[0]["Estado"] != "Inactivo"){ //Se verifica si el usuario está activo o no
                    listarMarcasVehiculos(); //Se listan los datos necesarios
                    listarTiposVehiculos();
                    listarEquipamientosV();
                    listarSedes();
                    listarVehiculosDisponibles(datos[0]["TipoUsuario"])
                }
                else   
                    mensaje("error","Error","Su cuenta está Inactiva. Intentelo en otra ocasión!");
            }
            else
                mensaje("error","Error","El Usuario o la Contraseña son Incorrectos!");
        },
        error: function(data){
            mensaje("error","Error","Error al realizar el Ingreso!");
        }
    });
}