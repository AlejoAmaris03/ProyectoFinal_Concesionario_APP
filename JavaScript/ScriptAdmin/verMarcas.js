$(document).ready(function() { //Tabla de Marcas de Vehículos
    tablaMarcas = $('#tablaMarcas').DataTable({
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        }
    });
});