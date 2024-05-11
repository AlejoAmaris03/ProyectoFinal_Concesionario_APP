$(document).ready(function() { 
    tablaSedes = $('#tablaSedes').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorSede.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarSedes"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Nombre"},
            {"data" : "Direccion"},
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
function validarSede(){ //Se ejecuta cuando se quiere agregar una marca
    $("#formSedes").trigger("reset");
    $(".modal-title").text("Agregar Sedes");
    $("#btnPrincipal").text("Agregar");
    document.getElementById("campo-id").style.display = "none";
    $("#accion").val("agregarSede");
    $(".modal").modal("show");
}
function btnAgregarSede(){ //Verifica el formulario
    let form = document.form;
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var seleccion = 0;

    if(form.nombre.value.trim() === ""){
        mensaje("error","Error","El Nombre es Requerido!");

        return false;
    }
    if(form.direccion.value.trim() === ""){
        mensaje("error","Error","La Dirección es Requerida!");

        return false;
    }

    checkboxes.forEach(function(checkbox){
        if(checkbox.checked)
            seleccion++;
    });
    
    if(seleccion == 0){
        mensaje("error","Error","Seleccione al menos un (1) Vehículo!");

        return false;
    }

    verificarSede();
}
function verificarSede(){ //Verifica que la Sede no exista
    id = $("#id").val();
    nombre = $("#nombre").val();
    accion = $("#accion").val();

    if(accion == "agregarSede")
        accion = "buscarSedePorNombre";
    else
        accion = "buscarSedePorIdNombre";

    $.ajax({
        url: "../../Controlador/ControladorSede.php",
        method: "POST",
        data: {
            id: id,
            nombre: nombre,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                verificarDireccion();
            else
                mensaje("error","ERROR","Ese nombre ya existe. Intentelo nuevamente!");
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al buscar una sede!");
        }
    });
}
function verificarDireccion(){ //Verifica que la direccion no exista
    id = $("#id").val();
    direccion = $("#direccion").val();
    accion = $("#accion").val();

    if(accion == "agregarSede")
        accion = "buscarSedePorDireccion";
    else
        accion = "buscarSedePorIdDireccion";

    $.ajax({
        url: "../../Controlador/ControladorSede.php",
        method: "POST",
        data: {
            id: id,
            direccion: direccion,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                verificarVehiculos();
            else
                mensaje("error","ERROR","Esa dirección ya existe. Intentelo nuevamente!");
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al buscar una sede!");
        }
    });
}
function verificarVehiculos(){ //Verifica los checkbox seleccionados
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var cantidadInputs = document.querySelectorAll('.sede .cantidad input');

    var informacionCorrecta = true;

    checkboxes.forEach(function(checkbox,index){ //Recorre lo campos (checkbox)
        if(checkbox.checked){ //Si el checkbox está seleccionado
            if(cantidadInputs[index].value.trim() === ""){ //Si no se escribió la cantidad
                informacionCorrecta = false;
                mensaje("error","ERROR","Ingrese una cantidad para el vehículo seleccionado!");
            }
            else if(cantidadInputs[index].value < 0){ //Si la cantidad no es valida
                informacionCorrecta = false;
                mensaje("error","ERROR","Ingrese una cantidad valida!");
            }
        }
    });

    if(informacionCorrecta) //Si todo es correcto
        agregarSede();
}
function agregarSede(){ //Agrega/Edita la Sede
    id = $("#id").val();
    nombre = $("#nombre").val();
    direccion = $("#direccion").val();
    accion = $("#accion").val();

    if(accion == "editarSede")
        accion = "editar";

    $.ajax({
        url: "../../Controlador/ControladorSede.php",
        method: "POST",
        data: {
            id: id,
            nombre: nombre,
            direccion: direccion,
            accion: accion
        },
        success: function(data){
            datos = JSON.parse(data);

            if(accion == "agregarSede")
                llenarTablaSedeVehiculo(nombre); //Agrega la relación entre la sede y los vehículos
            else
                editarTablaSedeVehiculo(id,"editar"); //Edita la relación entre la sede y los vehículos

            tablaSedes.ajax.reload();
        },
        error: function(data){
            if(accion == "agregarSede")
                mensaje("error","ERROR","Ha ocurrido un error al agregar la sede!");
            else
                mensaje("error","ERROR","Ha ocurrido un error al editar la información!");

            tablaSedes.ajax.reload();
        }
    });

    $(".modal").modal("hide");
}
function llenarTablaSedeVehiculo(nombre){
    $.ajax({
        url: "../../Controlador/ControladorSede.php",
        method: "POST",
        data: {
            nombre: nombre,
            accion: "buscarSedePorNombre"
        },
        success: function(data){
            datos = JSON.parse(data);

            llenar(datos[0]["ID"]);
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al buscar una sede!");
        }
    });
}
function editarTablaSedeVehiculo(idSede,accion){ //Edita/Elimina la relación entre la sede y los vehículos
    $.ajax({
        url: "../../Controlador/ControladorSedeVehiculo.php",
        method: "POST",
        data: {
            idSede: idSede,
            accion: "eliminarPorIdSede"
        },
        success: function(data){
            if(accion == "editar")
                llenar(idSede);
            else
                eliminarSede(idSede)
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar una sede por Id!");
        }
    });
}
function llenar(idSede){
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var cantidadInputs = document.querySelectorAll('.sede .cantidad input');
    accion = $("#accion").val();

    for(let i=0; i<checkboxes.length; i++){
        if(checkboxes[i].checked == true){
            IdVehiculo = checkboxes[i].value;
            cantidad = cantidadInputs[i].value;

            $.ajax({
                url: "../../Controlador/ControladorSedeVehiculo.php",
                method: "POST",
                data: {
                    idSede: idSede,
                    idVehiculo: IdVehiculo,
                    cantidad: cantidad,
                    accion: "agregarSedeVehiculo"
                },
                success: function(data){
                },
                error: function(data){
                    mensaje("error","ERROR","Ha ocurrido un error al llenar la tabla SedeVehiculo!");
                }
            });
        }
    }

    if(accion == "agregarSede")
        mensaje("success","Sede Agregada","La Sede se agregó correctamente!");
    else
        mensaje("success","Información Editada","La información se editó correctamente!");
}
function btnEditarSede(id){ //Toma los datos de la Sede
    $("#formSedes").trigger("reset");
    $(".modal-title").text("Modificar Sede");
    $("#btnPrincipal").text("Modificar");
    document.getElementById("campo-id").style.display = "";
    $("#accion").val("editarSede");
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorSede.php",
        method: "POST",
        data: {
            id: id,
            accion: "editarSede"
        },
        success: function(data){
            datos = JSON.parse(data);

            $("#id").val(datos[0]["ID"]);
            $("#nombre").val(datos[0]["Nombre"]);
            $("#direccion").val(datos[0]["Direccion"]);

            seleccionarCheckbox(datos[0]["ID"]);
        }
    });
}
function seleccionarCheckbox(id){ //Selecciona los vehiculos que posee una sede específica
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var cantidadInputs = document.querySelectorAll('.sede .cantidad input');

    checkboxes.forEach(function(checkbox){
        checkbox.checked = false;
    });

    $.ajax({
        url: "../../Controlador/ControladorSedeVehiculo.php",
        method: "POST",
        data: {
            idS: id,
            accion: "buscarSedePorId"
        },
        success: function(data){
            datos = JSON.parse(data);

            for(let i= 0; i<datos.length; i++){
                for(let j=0; j<checkboxes.length; j++){
                    if(datos[i]["IdVehiculo"] == checkboxes[j].value){
                        checkboxes[j].checked = true;
                        cantidadInputs[j].value = datos[i]["Cantidad"];
                    }
                }
            }
        }
    });
}
function btnEliminarSede(id){ //Confirma la eliminación de la Sede
    Swal.fire({
        icon: "warning",
        title: "Eliminar Sede",
        text: "¿Desea eliminar una Sede?. Esta acción NO se puede deshacer",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if(result.isConfirmed)
            editarTablaSedeVehiculo(id,"eliminar"); //Elimina la relación entre la Sede y los Vehiculos
    });
}
function eliminarSede(id){ //Elimina la sede
    $.ajax({
        url: "../../Controlador/ControladorSede.php",
        method: "POST",
        data: {
            id: id,
            accion: "eliminarSede"
        },
        success: function(data){
            mensaje("success","Sede Eliminada","La información se ha eliminado correctamente!");
            tablaSedes.ajax.reload();
        },
        error: function(data){
            mensaje("error","ERROR","Ha ocurrido un error al eliminar la Sede!");
            tablaSedes.ajax.reload();
        }
    });
}