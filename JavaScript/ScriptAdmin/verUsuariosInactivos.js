$(document).ready(function() { //Tabla de Vehículos
    tablaUsuariosInactivos = $('#tablaUsuariosInactivos').DataTable({
        responsive: true,
        ajax: {
            url: "../../Controlador/ControladorAdmin.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarUsuariosInactivos"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Nombre"},
            {"data" : "Apellido"},
            {"data" : "Correo"},
            {"data" : "Usuario"},
            {"data" : "Estado"},
            {"data" : "activar"},
            {"data" : "eliminar"},
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
function btnActivarUsuario(id){
    Swal.fire({
        icon: "warning",
        title: "Activar Usuario",
        text: "Esta acción activará la cuenta del usuario. ¿Desea Continuar?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if(result.isConfirmed)
            activarUsuario(id);
      });
}
function activarUsuario(id){
    $.ajax({
        url: "../../Controlador/ControladorAdmin.php",
        method: "POST",
        data: {
            id: id,
            accion: "activarUsuario"
        },
        success: function(data){
            mensaje("success","Usuario Activado","El usuario ha sido activado con exito!");
            tablaUsuariosInactivos.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al activar el usuario!");
            tablaUsuariosInactivos.ajax.reload();
        }
    });
}
function btnEliminarUsuario(id){
    Swal.fire({
        icon: "warning",
        title: "Eliminar Usuario",
        text: "¿Desea eliminar un usuario?. Esta acción NO se puede deshacer",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if(result.isConfirmed)
            eliminarUsuario(id);
      });
}
function eliminarUsuario(id){
    $.ajax({
        url: "../../Controlador/ControladorAdmin.php",
        method: "POST",
        data: {
            id: id,
            accion: "eliminarUsuario"
        },
        success: function(data){
            mensaje("success","Usuario Eliminado","El usuario ha sido eliminado con exito!");
            tablaUsuariosInactivos.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar el usuario!");
            tablaUsuariosInactivos.ajax.reload();
        }
    });
}