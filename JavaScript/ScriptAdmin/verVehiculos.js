$(document).ready(function() {
    tablaVehiculos = $('#tablaVehiculos').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[3, 5, 10, 15, -1], [3, 5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorVehiculo.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarVehiculos"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Imagen"},
            {"data" : "Placa"},
            {"data" : "Modelo"},
            {"data" : "Marca"},
            {"data" : "Tipo"},
            {"data" : "Descripcion"},
            {"data" : "Cantidad"},
            {"data" : "Precio"},
            {"data" : "Estado"},
            {"data" : "editar"},
            {"data" : "inactivar"},
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
function listarVehiculos(){
    $.ajax({
        url: "../../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            accion: "obtenerVehiculos"
        },
        success: function(data){
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar los Vehículos!");
        }
    });
}
function listarMarcasV(){
    $.ajax({
        url: "../../Controlador/ControladorMarcas.php",
        method: "POST",
        data: {
            accion: "obtenerMarcasV"
        },
        success: function(data){
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar los Tipos de Vehículos!");
        }
    });
}
function listarTiposV(){
    $.ajax({
        url: "../../Controlador/ControladorTipos.php",
        method: "POST",
        data: {
            accion: "obtenerTiposV"
        },
        success: function(data){
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar las Marcas de Vehículos!");
        }
    });
}
function cargarVariablesVehiculo(){
    listarVehiculos();
    listarMarcasV();
    listarTiposV();
}
function verificarVehiculo(){ //Se ejecuta cuando se quiere agregar un usuario
    $("#formVehiculos").trigger("reset");
    $(".modal-title").text("Agregar Vehículo");
    $("#btnPrincipal").text("Agregar");
    document.getElementById("campo-id").style.display = "none";
    $("#accion").val("agregarVehiculo");
    $(".modal").modal("show");
}
function btnAgregarVehiculo(){ //Verifica el formulario
    let form = document.form;

    if(form.imagen.value.trim() === ""){
        mensaje("error","Error","La Imagen es Requerida!");

        return false;
    }
    if(form.placa.value.trim() === ""){
        mensaje("error","Error","La Placa es Requerida!");

        return false;
    }
    if(form.modelo.value.trim() === ""){
        mensaje("error","Error","El Modelo es Requerido!");

        return false;
    }
    if(form.marca.value.trim() === ""){
        mensaje("error","Error","La Marca es Requerida!");
        
        return false;
    }
    if(form.tipo.value.trim() === ""){
        mensaje("error","Error","El Tipo de Vehiculo es Requerido!");

        return false;
    }
    if(form.descripcion.value.trim() === ""){
        mensaje("error","Error","La Descripción es Requerida!");
        
        return false;
    }

    if(form.cantidad.value.trim() === ""){
        mensaje("error","Error","La Cantidad es Requerida!");
        
        return false;
    }
    if(form.cantidad.value < 1){
        mensaje("error","Error","La Cantidad NO es valida!");
        
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

    verificarPlaca();
}
function verificarPlaca(){
    id = $("#id").val();
    placa = $("#placa").val();
    accion = $("#accion").val();

    if(accion == "agregarVehiculo") //Se decide que parte del controlador ejecutar
        accion = "verificarPlacaVehiculo";
    else
        accion = "verificarPlacaVehiculoActual";

    $.ajax({
        url: "../../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            id: id,
            placa: placa,
            accion: accion
        },
        success: function(data){ 
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                verificarModelo(); //Si no se repite la placa
            else
                mensaje("error","ERROR","Ya existe esa Placa. Intentelo nuevamente!");
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error verificar el registro!");
        }
    });
}
function verificarModelo(){
    id = $("#id").val();
    modelo = $("#modelo").val();
    accion = $("#accion").val();

    if(accion == "agregarVehiculo") //Se decide que parte del controlador ejecutar
        accion = "verificarModeloVehiculo";
    else
        accion = "verificarModeloVehiculoActual";

    $.ajax({
        url: "../../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            id: id,
            modelo: modelo,
            accion: accion
        },
        success: function(data){ 
            datos = JSON.parse(data);

            if(Object.keys(datos).length === 0)
                agregarVehiculo(); //Si no se repite el modelo
            else
                mensaje("error","ERROR","Ya existe ese Modelo. Intentelo nuevamente!");
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error verificar el registro!");
        }
    });
}
function agregarVehiculo(){
    id = $("#id").val();
    imagen = document.getElementById("imagen").files[0];
    placa = $("#placa").val();
    modelo = $("#modelo").val();
    marca = $("#marca").val();
    tipo = $("#tipo").val();
    descripcion = $("#descripcion").val();
    cantidad = $("#cantidad").val();
    precio = $("#precio").val();
    accion = $("#accion").val();
    
    if(accion == "editarVehiculo")
        accion = "editar";

    var formData = new FormData();
    formData.append('id', id);
    formData.append('imagen', imagen);
    formData.append('placa', placa);
    formData.append('modelo', modelo);
    formData.append('marca', marca);
    formData.append('tipo', tipo);
    formData.append('descripcion', descripcion);
    formData.append('cantidad', cantidad);
    formData.append('precio', precio);
    formData.append('accion', accion);
    
    $.ajax({
        url: "../../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){ 
            if(accion == "agregarVehiculo")
                mensaje("success","Vehículo Agregado","El vehículo agregó correctamente!");
            else
                mensaje("success","Información Modificada","La información se editó correctamente!");
            
            tablaVehiculos.ajax.reload();
        },
        error: function(data){   
            if(accion == "agregarVehiculo")
                mensaje("error","ERROR","Ha ocurrido un error al agregar el vehículo!");
            else
                mensaje("error","ERROR","Ha ocurrido un error al modificar la información!");
            
            tablaVehiculos.ajax.reload();
        }
    });

    $(".modal").modal("hide");
}