$(document).ready(function() { //Tabla de Usuario
    tablaUsuarios = $('#tablaUsuarios').DataTable({
        responsive: true,
        ajax: {
            url: "../../Controlador/ControladorAdmin.php",
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
function mensaje(icono,titulo,texto){
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
}
function validarUsuario(){
    $("#formUsuarios").trigger("reset");
    $(".modal-title").text("Agregar Usuario");
    $("#btnPrincipal").text("Agregar");
    $("#accion").val("agregarUsuario");
    $(".modal").modal("show");
}
function btnAgregarUsuarios(){
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

    agregarUsuario();
}
function agregarUsuario(){
    nombre = $("#nombre").val();
    apellido = $("#apellido").val();
    correo = $("#correo").val();
    fechaNacimiento = $("#fechaNacimiento").val();
    tipoUsuario = $("#tipoUsuario").val();
    usuario = $("#usuario").val();
    clave = $("#clave").val();
    accion = $("#accion").val();

    if(accion == "editarUsuario")
        $("#accion").val("editar");

    $.ajax({
        url: "../../Controlador/ControladorAdmin.php",
        method: "POST",
        data: {
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
            if(accion == "agregarUsuario")
                mensaje("success","Usuario Agregado","El usuario se agrego correctamente!");
            else    
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
function btnEditarUsuario(id){ //Boton para Modificar
    $(".modal-title").text("Editar Infomación");
    $("#btnPrincipal").text("Editar");
    $("#accion").val("editarUsuario");
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorAdmin.php",
        method: "POST",
        data: {
            id: id,
            accion: "editarUsuario"
        },
        success: function(data){
            datos = JSON.parse(data);

            $("#nombre").val(datos[0].Nombre);
            $("#apellido").val(datos[0].Apellido);
            $("#correo").val(datos[0].Correo);
            $("#fechaNacimiento").val(datos[0].FechaNacimiento);
            $("#tipoUsuario").val(datos[0].TipoUsuario);
            $("#usuario").val(datos[0].Usuario);
            $("#clave").val(datos[0].Clave);
        }
    });
}