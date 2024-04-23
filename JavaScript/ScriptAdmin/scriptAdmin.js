$(document).ready(function() { //Tabla de Usuario
    tablaUsuarios = $('#tablaUsuarios').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });
});
$(document).ready(function() { //Tabla de Vehículos
    tablaVehiculos = $('#tablaVehiculos').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });
});
$(document).ready(function() { //Tabla de Marcas de Vehículos
    tablaMarcas = $('#tablaMarcas').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });
});
$(document).ready(function() { //Tabla de Tipos de Vehículos
    tablaTipos = $('#tablaTipos').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });
});
$(document).ready(function() { //Tabla de Colores de Vehículos
    tablaColores = $('#tablaColores').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });
});