$(document).ready(function() { //Tabla de Colores de Vehículos
    tablaHistorialVentas = $('#tablaHistorialVentas').DataTable({
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        }
    });
});