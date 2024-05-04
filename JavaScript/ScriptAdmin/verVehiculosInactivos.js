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
            {"data" : "Placa"},
            {"data" : "Modelo"},
            {"data" : "Marca"},
            {"data" : "Tipo"},
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
            mensaje("success","Usuario Activado","El usuario ha sido activado con exito!");
            tablaVehiculosInactivos.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al activar el vehículo!");
            tablaVehiculosInactivos.ajax.reload();
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
            eliminarVehiculo(id);
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
}