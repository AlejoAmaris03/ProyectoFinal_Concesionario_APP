 $(document).ready(function() { 
    tablaHistorialVentas = $('#tablaHistorialVentas').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorVentaCompra.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarVentaCompra"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Usuario"},
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