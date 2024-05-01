//Script que ejecuta las funciones de la vista "Ver Usuarios Inactivos" del Administrador

$(document).ready(function() {
    tablaUsuariosInactivos = $('#tablaUsuariosInactivos').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
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
            {"data" : "TipoUsuario"},
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
function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
}
function btnActivarUsuario(id){ //Se confirma la acción de activar un usuario
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
function activarUsuario(id){ //Activa un usuario
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
function btnEliminarUsuario(id){ //Se confirma la acción de eliminar un usuario
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
function eliminarUsuario(id){ //Eliminar un usuario
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