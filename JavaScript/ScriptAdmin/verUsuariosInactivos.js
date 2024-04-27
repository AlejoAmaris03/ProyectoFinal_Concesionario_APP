$(document).ready(function() { //Tabla de Vehículos
    tablaUsuariosInactivos = $('#tablaUsuariosInactivos').DataTable({
        responsive: true,
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