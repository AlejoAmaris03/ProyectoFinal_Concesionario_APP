function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
}
function btnMostarBotonComprar(){ //Muestra el botón de comprar
    document.getElementById("btnConfirmarCompra").style.display = "block";
}
function btnConfirmarCompra(){ //Verifica los campos de equipamiento
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var cantidadInputs = document.querySelectorAll('.edicion .cantidad input[type="number"]');

    var informacionCorrecta = true;

    checkboxes.forEach(function(checkbox,index){ //Recorre lo campos (checkbox)
        if(checkbox.checked){ //Si el checkbox está seleccionado
            if(cantidadInputs[index].value.trim() === ""){ //Si no se escribió la cantidad
                informacionCorrecta = false;
                mensaje("error","ERROR","Ingrese una cantidad para el equipamiento seleccionado!");
            }
            else if(cantidadInputs[index].value < 1){ //Si la cantidad no es valida
                informacionCorrecta = false;
                mensaje("error","ERROR","Ingrese una cantidad valida!");
            }
        }
    });

    if(informacionCorrecta) //Si todo es correcto
        verDetallesCompra();
}
function verDetallesCompra(){ //Muestra el modal con sus detalles
    $("#confirmarCompra").modal("show");

    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var labels = document.querySelectorAll('.edicion .equipamiento .eqNombre');
    var cantidadInputs = document.querySelectorAll('.edicion .cantidad input[type="number"]');
    var precioEq = document.querySelectorAll('.edicion .equipamiento .precioEq');
    var total = parseInt(document.getElementById("precioVehiculo").textContent);
    var equipamientosSeleccionados = '';

    checkboxes.forEach(function(checkbox,index){ //Recorre lo campos (checkbox)
        if(checkbox.checked){ //Si el checkbox está seleccionado
            equipamientosSeleccionados += " ("+cantidadInputs[index].value+") " + labels[index].textContent + " $" +(parseInt(cantidadInputs[index].value) * parseInt(precioEq[index].textContent))+ '\n';
            total += (parseInt(cantidadInputs[index].value) * parseInt(precioEq[index].textContent));
        }
    });

    document.getElementById("equipamientos").value = equipamientosSeleccionados; //Llena el campo de los equipamentos seleccionados
    document.getElementById("totalVenta").value = total.toString();
}
function btnRealizarCompra(){ //Confirma la compra
    Swal.fire({
        icon: "warning",
        title: "Confirmar Compra",
        text: "¿Desea realizar la compra?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if(result.isConfirmed)
            realizarCompra();
    });
}
function generarReferencia(idVehiculo){
    referencia = 0;

    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            idVehiculo: idVehiculo,
            accion: "generarReferencia"
        },
        success: function(data){ //Se busca el vehículo y se genera la Referencia
            datos = JSON.parse(data);
            
            referencia = datos[0]["Referencia"] + 1;
        },
        error: function(data){
            mensaje("error","ERROR","Error al generar la Referencia!");
        }
    });

    return referencia;
}
function generarPlaca(){
    placa = 0;

    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            accion: "generarPlaca"
        },
        success: function(data){ //Se busca el vehículo y se genera la Referencia
            placa = data;
        },
        error: function(data){
            mensaje("error","ERROR","Error al generar la Placa!");
        }
    });

    return placa;
}
function actualizarStockVehiculo(idSede,idVehiculo){
    $.ajax({
        url: "../../Controlador/ControladorSedeVehiculo.php",
        method: "POST",
        data: {
            idSede: idSede,
            idVehiculo: idVehiculo,
            accion: "actualizarStock"
        },
        success: function(data){
        },
        error: function(data){
            mensaje("error","ERROR","Error al actualizar el Stock!");
        }
    });
}
function realizarCompra(){ //Realiza el proceso para adquirir el vehículo
    idU = $("#idU").val();
    idV = $("#idV").val();
    idSede = $("#sede").val();
    total = document.getElementById("totalVenta").value;
    referencia = generarReferencia(idV);
    placaVehiculo = generarPlaca();

    /*$.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            idUsuario: idU,
            idVehiculo: idV,
            referencia: referencia,
            placaVehiculo: placaVehiculo,
            total: total,
            accion: "realizarCompraVenta"
        },
        success: function(data){ //Se busca el vehículo y se genera la Referencia
            actualizarStockVehiculo(idSede,idV);
        },
        error: function(data){

        }
    });*/
}