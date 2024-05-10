//Script que ejecuta las funciones de la vista "Ver Usuario" del Administrador

$(document).ready(function() { 
    tablaUsuarios = $('#tablaUsuarios').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorUsuario.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarUsuarios"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Nombre"},
            {"data" : "Apellido"},
            {"data" : "Correo"},
            {"data" : "FechaNacimiento"},
            {"data" : "TipoUsuario"},
            {"data" : "Usuario"},
            {"data" : "Clave"},
            {"data" : "Estado"},
            {"data" : "editar"},
            {"data" : "inactivar"},
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        }
    });
});
function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
}
function validarUsuario(){ //Se ejecuta cuando se quiere agregar un usuario
    $("#formUsuarios").trigger("reset");
    $(".modal-title").text("Agregar Usuario");
    $("#btnPrincipal").text("Agregar");
    document.getElementById("campo-id").style.display = "none";
    $("#accion").val("agregarUsuario");
    $(".modal").modal("show");
}
function btnAgregarUsuarios(){ //Verifica el formulario
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

    verificarCorreoUsuario();
}
function verificarCorreoUsuario(){ //Verifica que el correo no se repita
    id = $("#id").val();
    correo = $("#correo").val();
    accion = $("#accion").val();

    if(accion == "agregarUsuario") //Se decide que parte del controlador ejecutar
        accion = "verificarCorreoUsuario";
    else
        accion = "verificarCorreoUsuarioActual";

    $.ajax({
        url: "../../Controlador/ControladorUsuario.php",
        method: "POST",
        data: {
            id: id,
            correo: correo,
            accion: accion
        },
        success: function(data){ 
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                verificarUsuario(); //Si no se repite el correo
            else
                mensaje("error","ERROR","Ya existe ese Correo Electrónico. Intentelo nuevamente!");
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error verificar el registro!");
        }
    });
}
function verificarUsuario(){ //Verifica que el nombre de usuario no se repita
    id = $("#id").val();
    usuario = $("#usuario").val();
    accion = $("#accion").val();

    if(accion == "agregarUsuario") //Se decide que parte del controlador ejecutar
        accion = "verificarUsuario";
    else
        accion = "verificarUsuarioPorId";

    $.ajax({
        url: "../../Controlador/ControladorUsuario.php",
        method: "POST",
        data: {
            id: id,
            usuario: usuario,
            accion: accion
        },
        success: function(data){ 
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                agregarUsuario(); //si no se repite el nombre de usuario
            else
                mensaje("error","ERROR","Ya existe ese Nombre de Usuario. Intentelo nuevamente!");
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error verificar el usuario!");
        }
    });
}
function agregarUsuario(){ //Agrega o Edita la información de un usuario
    id = $("#id").val();
    nombre = $("#nombre").val();
    apellido = $("#apellido").val();
    correo = $("#correo").val();
    fechaNacimiento = $("#fechaNacimiento").val();
    tipoUsuario = $("#tipoUsuario").val();
    usuario = $("#usuario").val();
    clave = $("#clave").val();
    accion = $("#accion").val();

    if(accion == "editarUsuario") //Si la opción es editar
        accion = "editar";

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
            accion: accion
        },
        success: function(data){
            if(accion == "agregarUsuario") //Si se agrega un usuario
                mensaje("success","Usuario Agregado","El usuario se agregó correctamente!");
            else //Si se edita la información de un usuario
                mensaje("success","Información Editada","La información se editó correctamente!");

            tablaUsuarios.ajax.reload();
        },
        error: function(data){
            if(accion == "agregarUsuario")
                mensaje("error","ERROR","Ha ocurrido un error al agregar el usuario!");
            else    
                mensaje("error","ERROR","Ha ocurrido un error al editar la información!");

            tablaUsuarios.ajax.reload();
        }
    });

    $(".modal").modal("hide");
}
function btnEditarUsuario(id){ //Se ejecuta cuando se quiere editar la información de un usuario
    $(".modal-title").text("Editar Infomación");
    $("#btnPrincipal").text("Editar");
    document.getElementById("campo-id").style.display = "";
    $("#accion").val("editarUsuario");
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorUsuario.php",
        method: "POST",
        data: {
            id: id,
            accion: "editarUsuario"
        },
        success: function(data){ //Se busca el usuario y se ponen sus datos en el formulario
            datos = JSON.parse(data);

            if(datos[0].TipoUsuario == "Administrador")
                $("#tipoUsuario").val("1");
            else
                $("#tipoUsuario").val("2");

            $("#id").val(datos[0].ID);
            $("#nombre").val(datos[0].Nombre);
            $("#apellido").val(datos[0].Apellido);
            $("#correo").val(datos[0].Correo);
            $("#fechaNacimiento").val(datos[0].FechaNacimiento);
            $("#usuario").val(datos[0].Usuario);
            $("#clave").val(datos[0].Clave);
        }
    });
}
function btnInactivarUsuario(id){ //Se ejecuta cuando se quiere activar un usuario
    Swal.fire({
        icon: "warning",
        title: "Inactivar Usuario",
        text: "Esta acción NO elimara al usuario definitivamente, solo lo inactivara. ¿Desea Continuar?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if(result.isConfirmed)
            inactivarUsuario(id);
    });
}
function inactivarUsuario(id){ //Se ejecuta cuando se quiere inactivar un usuario
    $.ajax({
        url: "../../Controlador/ControladorUsuario.php",
        method: "POST",
        data: {
            id: id,
            accion: "inactivarUsuario"
        },
        success: function(data){
            mensaje("success","Usuario Inactivado","El usuario se ha inactivado con exito!");
            tablaUsuarios.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al inactivar el usuario!");
            tablaUsuarios.ajax.reload();
        }
    });
}