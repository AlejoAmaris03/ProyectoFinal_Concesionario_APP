$(document).ready(function() {
    tablaVehiculosInactivos = $('#tablaVehiculosInactivos').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorVehiculo.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarVehiculosInactivos"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Imagen"},
            {"data" : "Modelo"},
            {"data" : "Marca"},
            {"data" : "Tipo"},
            {"data" : "Estado"},
            {"data" : "activar"}/*,
            {"data" : "eliminar"}*/
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        dom: "Bfrtilp",
        buttons: [
            {
                extend: "pdfHtml5",
                download: "open",
                titleAttr: "Reporte de Vehículos Inactivos (pdf)",
                title: "Reporte de Vehículos Inactivos",
                filename: "ReporteVehiculosInactivos",
                text: "<i class='fa-solid fa-file-pdf'></i>",
                className: "pdf btn btn-danger",
                exportOptions: {
                    columns: [0, 2, 3, 4, 5]
                }
            },
            {
                extend: "print",
                titleAttr: "Reporte de Vehículos Inactivos (pdf)",
                title: "Reporte de Vehículos Inactivos",
                filename: "ReporteVehiculosInactivos",
                text: "<i class='fa-solid fa-print'></i>",
                className: "imprimir btn btn-info",
                exportOptions: {
                    columns: [0, 2, 3, 4, 5]
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
function btnActivarVehiculo(id){ //Se confirma la acción de activar un vehículo
    Swal.fire({
        icon: "warning",
        title: "Activar Vehículo",
        text: "Esta acción activará el vehículo. ¿Desea Continuar?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if(result.isConfirmed)
            activarVehiculo(id);
    });
}
function activarVehiculo(id){ //Activa un vehículo
    $.ajax({
        url: "../../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            id: id,
            accion: "activarVehiculo"
        },
        success: function(data){
            mensaje("success","Vehículo Activado","El vehículo ha sido activado con exito!");
            tablaVehiculosInactivos.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al activar el vehículo!");
            tablaVehiculosInactivos.ajax.reload();
        }
    });
}
/*function eliminarTablaSedeVeh(idVehiculo){ //Elimina la relación entre la sede y los vehículos
    $.ajax({
        url: "../../Controlador/ControladorSedeVehiculo.php",
        method: "POST",
        data: {
            idVehiculo: idVehiculo,
            accion: "eliminarPorIdVehiculo"
        },
        success: function(data){
            eliminarVehiculo(idVehiculo);
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar una sede por Id!");
        }
    });
}
function btnEliminarVehiculo(id){ //Se confirma la acción de eliminar un vehículo
    Swal.fire({
        icon: "warning",
        title: "Eliminar Vehículo",
        text: "¿Desea eliminar un vehículo?. Esta acción NO se puede deshacer",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if(result.isConfirmed)
            eliminarTablaSedeVeh(id);
    });
}
function eliminarVehiculo(id){ //Eliminar un usuario
    $.ajax({
        url: "../../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            id: id,
            accion: "eliminarVehiculo"
        },
        success: function(data){
            mensaje("success","Vehículo Eliminado","El vehículo ha sido eliminado con exito!");
            tablaVehiculosInactivos.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar el vehículo!");
            tablaVehiculosInactivos.ajax.reload();
        }
    });
}*/