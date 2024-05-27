$(document).ready(function() {
    tablaEquipamiento = $('#tablaEquipamiento').DataTable({ //Llena la tabla con los datos
        responsive: true,
        ajax: {
            url: "../../Controlador/ControladorEquipamiento.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarEquipamientos"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Nombre"},
            {"data" : "Precio"},
            {"data" : "editar"}/*,
            {"data" : "eliminar"}*/
        ],
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
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
function validarEquipamiento(){ //Se ejecuta cuando se quiere agregar un equipamiento
    $("#formEquipamiento").trigger("reset");
    $(".modal-title").text("Agregar Equipamiento");
    $("#btnPrincipal").text("Agregar");
    document.getElementById("campo-id").style.display = "none";
    $("#accion").val("agregarEquipamiento");
    $(".modal").modal("show");
}
function btnAgregarEquipamento(){ //Verifica el formulario
    let form = document.form;

    if(form.nombre.value.trim() === ""){
        mensaje("error","Error","El Nombre es Requerido!");

        return false;
    }

    if(form.precio.value.trim() === ""){
        mensaje("error","Error","El Precio es Requerido!");

        return false;
    }
    if(form.precio.value < 1){
        mensaje("error","Error","El Precio NO es valido!");

        return false;
    }

    verificarEquipamiento();
}
function verificarEquipamiento(){ //Verifica que el nombre del equipamiento no existe
    id = $("#id").val();
    nombre = $("#nombre").val();
    accion = $("#accion").val();

    if(accion == "agregarEquipamiento")
        accion = "buscarEquipamientoPorNombre";
    else
        accion = "buscarEquipamientoPorIdNombre";

    $.ajax({
        url: "../../Controlador/ControladorEquipamiento.php",
        method: "POST",
        data: {
            id: id,
            nombre: nombre,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                agregarEquipamiento();
            else
                mensaje("error","ERROR","Ese equipamiento ya existe. Intentelo nuevamente!");
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al buscar el equipamiento!");
        }
    });
}
function agregarEquipamiento(){ //Agrega/Edita el equipamiento
    id = $("#id").val();
    nombre = $("#nombre").val();
    precio = $("#precio").val();
    accion = $("#accion").val();

    if(accion == "editarEquipamiento")
        accion = "editar";

    $.ajax({
        url: "../../Controlador/ControladorEquipamiento.php",
        method: "POST",
        data: {
            id: id,
            nombre: nombre,
            precio: precio,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(accion == "agregarEquipamiento")
                mensaje("success","Equipamiento Agregado","El equipamiento se agregó correctamente!");
            else
                mensaje("success","Información Editada","La información se editó correctamente!");

            tablaEquipamiento.ajax.reload();
        },
        error: function(data){
            if(accion == "agregarEquipamiento")
                mensaje("error","ERROR","Ha ocurrido un error al agregar el equipamiento!");
            else
                mensaje("error","ERROR","Ha ocurrido un error al editar la información!");

            tablaEquipamiento.ajax.reload();
        }
    });

    $(".modal").modal("hide");
}
function btnEditarEquipamiento(id){ //Toma los datos del equipamiento
    $(".modal-title").text("Modificar Equipamiento");
    $("#btnPrincipal").text("Modificar");
    document.getElementById("campo-id").style.display = "";
    $("#accion").val("editarEquipamiento");
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorEquipamiento.php",
        method: "POST",
        data: {
            id: id,
            accion: "editarEquipamiento"
        },
        success: function(data){
            datos = JSON.parse(data);

            $("#id").val(datos[0]["ID"]);
            $("#nombre").val(datos[0]["Nombre"]);
            $("#precio").val(datos[0]["Precio"]);
        }
    });
}
/*function btnEliminarEquipamiento(id){ //Verifica la eliminación del equipamiento
    Swal.fire({
        icon: "warning",
        title: "Eliminar Equipamiento",
        text: "¿Desea eliminar una equipamiento?. Esta acción NO se puede deshacer",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if(result.isConfirmed)
            eliminarEquipamiento(id);
    });
}
function eliminarEquipamiento(id){ //Elimina el equipamiento
    $.ajax({
        url: "../../Controlador/ControladorEquipamiento.php",
        method: "POST",
        data: {
            id: id,
            accion: "eliminarEquipamento"
        },
        success: function(data){
            mensaje("success","Equipamento Eliminada","La información se ha eliminado correctamente!");
            tablaEquipamiento.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar el Equipamento!");
            tablaEquipamiento.ajax.reload();
        }
    });
}*/