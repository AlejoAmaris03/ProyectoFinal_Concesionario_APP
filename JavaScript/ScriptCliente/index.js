function btnVerDetalles(id){ //Se ejcuta cuando se quieren ver los detalles de un vehículo
    $("#verDetalles").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            id: id,
            accion: "editarVehiculo"
        },
        success: function(data){ //Se busca el vehículo y se ponen sus datos en el formulario
            datos = JSON.parse(data);
            
            $("#idV").val(datos[0].ID);
            $("#marcaV").val(datos[0].Marca);
            $("#modeloV").val(datos[0].Modelo);
            $("#tipoV").val(datos[0].Tipo);
            $("#descripcionV").val(datos[0].Descripcion);
            $("#cantidadV").val(datos[0].Cantidad);
            $("#precioV").val(datos[0].Precio);
        }
    });
}
function btnSeleccionarVehiculo(id){ //Trae los datos del vehículo seleccionado por el cliente
    $.ajax({
        url: "../../Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            id: id,
            accion: "editarVehiculo"
        },
        success: function(data){
            window.location.href = "./verVehiculoSeleccionado.php";
        }
    });
}
function btnVistaComprar(){
    id = $("#idV").val();
    btnSeleccionarVehiculo(id);
}