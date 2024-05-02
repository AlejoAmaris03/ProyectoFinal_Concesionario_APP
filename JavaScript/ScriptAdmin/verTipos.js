$(document).ready(function() { 
    tablaTipos = $('#tablaTipos').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorTipos.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarTipos"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Nombre"},
            {"data" : "editar"},
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
function validarTipo(){ //Se ejecuta cuando se quiere agregar una marca
    $("#formMarcas").trigger("reset");
    $(".modal-title").text("Agregar Tipos de Vehículos");
    $("#btnPrincipal").text("Agregar");
    document.getElementById("campo-id").style.display = "none";
    $("#accion").val("agregarTipo");
    $(".modal").modal("show");
}
function btnAgregarTipo(){ //Verifica el formulario
    let form = document.form;

    if(form.nombre.value.trim() === ""){
        mensaje("error","Error","El Nombre es Requerido!");

        return false;
    }

    verificarTipo();
}
function verificarTipo(){
    id = $("#id").val();
    nombre = $("#nombre").val();
    accion = $("#accion").val();

    if(accion == "agregarTipo")
        accion = "buscarTipoPorNombre";
    else
        accion = "buscarTipoPorIdNombre";

    $.ajax({
        url: "../../Controlador/ControladorTipos.php",
        method: "POST",
        data: {
            id: id,
            nombre: nombre,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                agregarTipo();
            else
                mensaje("error","ERROR","Ese tipo de vehículo ya existe. Intentelo nuevamente!");
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al buscar el tipo de vehículo!");
        }
    });
}
function agregarTipo(){
    id = $("#id").val();
    nombre = $("#nombre").val();
    accion = $("#accion").val();

    if(accion == "editarTipo")
        accion = "editar";

    $.ajax({
        url: "../../Controlador/ControladorTipos.php",
        method: "POST",
        data: {
            id: id,
            nombre: nombre,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(accion == "agregarTipo")
                mensaje("success","Tipo de Vehículo Agregado","El tipo de vehículo se agregó correctamente!");
            else
                mensaje("success","Información Editada","La información se editó correctamente!");

            tablaTipos.ajax.reload();
        },
        error: function(data){
            if(accion == "agregarTipo")
                mensaje("error","ERROR","Ha ocurrido un error al agregar el tipo de vehículo!");
            else
                mensaje("error","ERROR","Ha ocurrido un error al editar la información!");

            tablaTipos.ajax.reload();
        }
    });

    $(".modal").modal("hide");
}
function btnEditarTipo(id){
    $(".modal-title").text("Modificar Tipo de Vehículo");
    $("#btnPrincipal").text("Modificar");
    document.getElementById("campo-id").style.display = "";
    $("#accion").val("editarTipo");
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorTipos.php",
        method: "POST",
        data: {
            id: id,
            accion: "editarTipo"
        },
        success: function(data){
            datos = JSON.parse(data);

            $("#id").val(datos[0]["ID"]);
            $("#nombre").val(datos[0]["Nombre"]);
        }
    });
}
function btnEliminarTipo(id){
    Swal.fire({
        icon: "warning",
        title: "Eliminar Tipo de Vehículo",
        text: "¿Desea eliminar un tipo de vehículo?. Esta acción NO se puede deshacer",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if(result.isConfirmed)
            eliminarTipo(id);
    });
}
function eliminarTipo(id){
    $.ajax({
        url: "../../Controlador/ControladorTipos.php",
        method: "POST",
        data: {
            id: id,
            accion: "eliminarTipo"
        },
        success: function(data){
            mensaje("success","Tipo de Vehículo Eliminado","La información se ha eliminado correctamente!");
            tablaTipos.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar el Tipo de Vehiculo!");
            tablaTipos.ajax.reload();
        }
    });
}