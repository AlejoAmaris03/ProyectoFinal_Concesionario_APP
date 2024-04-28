$(document).ready(function() { //Tabla de Tipos de Vehículos
    tablaTipos = $('#tablaTipos').DataTable({
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        }
    });
});