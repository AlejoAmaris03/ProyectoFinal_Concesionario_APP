$(document).ready(function() { 
    tablaMarcas = $('#tablaMarcas').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorMarcas.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarMarcas"
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
function validarMarca(){ //Se ejecuta cuando se quiere agregar una marca
    $("#formMarcas").trigger("reset");
    $(".modal-title").text("Agregar Marcas");
    $("#btnPrincipal").text("Agregar");
    document.getElementById("campo-id").style.display = "none";
    $("#accion").val("agregarMarca");
    $(".modal").modal("show");
}
function btnAgregarMarca(){ //Verifica el formulario
    let form = document.form;

    if(form.nombre.value.trim() === ""){
        mensaje("error","Error","El Nombre es Requerido!");

        return false;
    }

    verificarMarca();
}
function verificarMarca(){
    id = $("#id").val();
    nombre = $("#nombre").val();
    accion = $("#accion").val();

    if(accion == "agregarMarca")
        accion = "buscarMarcaPorNombre";
    else
        accion = "buscarMarcaPorIdNombre";

    $.ajax({
        url: "../../Controlador/ControladorMarcas.php",
        method: "POST",
        data: {
            id: id,
            nombre: nombre,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                agregarMarca();
            else
                mensaje("error","ERROR","Esa marca ya existe. Intentelo nuevamente!");
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al buscar la marca!");
        }
    });
}
function agregarMarca(){
    id = $("#id").val();
    nombre = $("#nombre").val();
    accion = $("#accion").val();

    if(accion == "editarMarca")
        accion = "editar";

    $.ajax({
        url: "../../Controlador/ControladorMarcas.php",
        method: "POST",
        data: {
            id: id,
            nombre: nombre,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(accion == "agregarMarca")
                mensaje("success","Marca Agregada","La marca se agregó correctamente!");
            else
                mensaje("success","Información Editada","La información se editó correctamente!");

            tablaMarcas.ajax.reload();
        },
        error: function(data){
            if(accion == "agregarMarca")
                mensaje("error","ERROR","Ha ocurrido un error al agregar la marca!");
            else
                mensaje("error","ERROR","Ha ocurrido un error al editar la información!");

            tablaMarcas.ajax.reload();
        }
    });

    $(".modal").modal("hide");
}
function btnEditarMarca(id){
    $(".modal-title").text("Modificar Marca");
    $("#btnPrincipal").text("Modificar");
    document.getElementById("campo-id").style.display = "";
    $("#accion").val("editarMarca");
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorMarcas.php",
        method: "POST",
        data: {
            id: id,
            accion: "editarMarca"
        },
        success: function(data){
            datos = JSON.parse(data);

            $("#id").val(datos[0]["ID"]);
            $("#nombre").val(datos[0]["Nombre"]);
        }
    });
}
function btnEliminarMarca(id){
    Swal.fire({
        icon: "warning",
        title: "Eliminar Marca",
        text: "¿Desea eliminar una marca?. Esta acción NO se puede deshacer",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if(result.isConfirmed)
            eliminarMarca(id);
    });
}
function eliminarMarca(id){
    $.ajax({
        url: "../../Controlador/ControladorMarcas.php",
        method: "POST",
        data: {
            id: id,
            accion: "eliminarMarca"
        },
        success: function(data){
            mensaje("success","Marca Eliminada","La información se ha eliminado correctamente!");
            tablaMarcas.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar la Marca!");
            tablaMarcas.ajax.reload();
        }
    });
}