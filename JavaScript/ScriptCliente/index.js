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
            $("#precioV").val(datos[0].Precio);

            obtenerSedesVehiculos(datos[0]["ID"]);
        }
    });
}
function obtenerSedesVehiculos(id){
    var sedes = "";

    $.ajax({
        url: "../../Controlador/ControladorSedeVehiculo.php",
        method: "POST",
        data: {
            idV: id,
            accion: "buscarVehiculoPorId"
        },
        success: function(data){
            datos = JSON.parse(data);

            //Información del formulario de Ver Más
            for (let i=0; i<datos.length; i++){
                if(datos[i]["Cantidad"] > 0)
                    sedes += datos[i]["Sede"] + " - " + datos[i]["Direccion"] + "\n";
            }

            document.getElementById("sedesV").value = sedes;
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar los Vehículos por Sedes!");
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
            datos = JSON.parse(data);

            seleccionarSedes(datos[0].ID);
        }
    });
}
function seleccionarSedes(id){
    $.ajax({
        url: "../../Controlador/ControladorSedeVehiculo.php",
        method: "POST",
        data: {
            idV: id,
            accion: "buscarVehiculoPorId"
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