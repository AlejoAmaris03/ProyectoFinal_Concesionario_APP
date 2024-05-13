$(document).ready(function() {
    idUsuario = $("#idUsuario").val();
    
    tablaHistorialCompras = $('#tablaHistorialCompras').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorVentaCompra.php",
            method: "POST",
            dataSrc: "",
            data: {
                idUsuario: idUsuario,
                accion: "listarCompras"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Vehiculo"},
            {"data" : "Referencia"},
            {"data" : "PlacaVehiculo"},
            {"data" : "Total"},
            {"data" : "verDetalles"},
            {"data" : "descargar"},
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        }
    });
});
function btnVerDetalleCompra(id){
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            idCompra: id,
            accion: "listarComprasPorIdCompra"
        },
        success: function(data){
            datos = JSON.parse(data);
            
            $("#referencia").val(datos[0]["Referencia"]);
            $("#vehiculo").val(datos[0]["Vehiculo"]);
            $("#placa").val(datos[0]["PlacaVehiculo"]);
            $("#sede").val();
            $("#precioVehiculo").val(datos[0]["PrecioVehiculo"]);
            $("#totalVenta").val(datos[0]["Total"]);
        },
        error: function(data){
            reject("Error al generar obtener una Compra!");
        }
    });
}