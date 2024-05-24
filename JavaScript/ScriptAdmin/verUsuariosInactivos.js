//Script que ejecuta las funciones de la vista "Ver Usuarios Inactivos" del Administrador

$(document).ready(function() {
    tablaUsuariosInactivos = $('#tablaUsuariosInactivos').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorUsuario.php",
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
        },
        dom: "Bfrtilp",
        buttons: [
            {
                extend: "pdfHtml5",
                download: "open",
                titleAttr: "Reporte de Usuarios Inactivos (pdf)",
                title: "Reporte de Usuarios Inactivos",
                filename: "ReporteUsuariosInactivos",
                text: "<i class='fa-solid fa-file-pdf'></i>",
                className: "pdf btn btn-danger",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6]
                }
            },
            {
                extend: "print",
                titleAttr: "Reporte de Usuarios Inactivos (pdf)",
                title: "Reporte de Usuarios Inactivos",
                filename: "ReporteUsuariosInactivos",
                text: "<i class='fa-solid fa-print'></i>",
                className: "imprimir btn btn-info",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6]
                }
            }
        ]
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
        url: "../../Controlador/ControladorUsuario.php",
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
            eliminarComprasVentas(id);
      });
}
function eliminarExtras(idVentaCompra){
    $.ajax({
        url: "../../Controlador/ControladorExtra.php",
        method: "POST",
        data: {
            idVentaCompra: idVentaCompra,
            accion: "eliminarExtasPorIdCompraVenta"
        },
        success: function(data){
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar los Extas de la Compra/Venta!");
        }
    });
}
function elimiarDetalles(idVentaCompra){
    $.ajax({
        url: "../../Controlador/ControladorDetallesVentasCompras.php",
        method: "POST",
        data: {
            idVentaCompra: idVentaCompra,
            accion: "eliminarDetallesPorIdCompraVenta"
        },
        success: function(data){
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar los Detalles de la Compra/Venta!");
        }
    });
}
function eliminarHistorial(idUsuario){
    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            idUsuario: idUsuario,
            accion: "eliminarVentaCompraPorIdUsuario"
        },
        success: function(data){
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar la Compra/Venta!");
        }
    });
}
function eliminarComprasVentas(idUsuario){
    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            idUsuario: idUsuario,
            accion: "listarCompras"
        },
        success: function(data){
            datos = JSON.parse(data);

            for(let i=0; i<datos.length; i++){
                eliminarExtras(datos[i]["ID"]);
                elimiarDetalles(datos[i]["ID"]); 
            }

            eliminarHistorial(idUsuario);
            eliminarUsuario(idUsuario)
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar las Compras/Ventas del Usuario!");
        }
    });
}
function eliminarUsuario(id){ //Eliminar un usuario
    $.ajax({
        url: "../../Controlador/ControladorUsuario.php",
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