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
    return new Promise(function(resolve,reject){
        $.ajax({
            url: "../../Controlador/ControladorVentaCompra.php",
            method: "POST",
            data: {
                idVehiculo: idVehiculo,
                accion: "generarReferencia"
            },
            success: function(data){
                datos = JSON.parse(data);
                let referencia = datos[0]["Referencia"] + 1;
                resolve(referencia);
            },
            error: function(data){
                mensaje("error","ERROR","Error al generar la Referencia!");
            }
        });
    });
}
function generarPlaca(){
    return new Promise(function(resolve,reject){
        $.ajax({
            url: "../../Controlador/ControladorVentaCompra.php",
            method: "POST",
            data: {
                accion: "generarPlaca"
            },
            success: function(data){
                datos = JSON.parse(data);
                resolve(datos);
            },
            error: function(data){
                mensaje("error","ERROR","Error al generar la Placa!");
            }
        });
    });
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

    Promise.all([generarReferencia(idV), generarPlaca()]).then(function(values){
        let referencia = values[0];
        let placaVehiculo = values[1];

        $.ajax({
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
            success: function(data){ //Se realiza la venta y se actualiza el stock del vehículo
                actualizarStockVehiculo(idSede,idV);
                agregarDescripcionCompra(placaVehiculo);
            },
            error: function(data){
                mensaje("error","ERROR","Error al realizar la Compra!");
            }
        });
    });
}
function agregarDescripcionCompra(placaVehiculo){ //Busca la compra realizada recientemente
    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            placaVehiculo: placaVehiculo,
            accion: "listarCompraPorPlacaVehiculo"
        },
        success: function(data){
            datos = JSON.parse(data); 

            agregarDescripcion(datos[0]["ID"]); //Agrega datos a la tabla DetallesVentasCompras
        },
        error: function(data){
            mensaje("error","ERROR","Error al obtener la Compra Reciente!");
        }
    });
}
function agregarDescripcion(idCompra){ //Agrega datos a la tabla DetallesVentasCompras
    nombreComprador = $("#nombreComprador").val();
    correoComprador = $("#correoComprador").val();
    sede = $("#sede").val();

    $.ajax({
        url: "../../Controlador/ControladorDetallesVentasCompras.php",
        method: "POST",
        data: {
            idCompra: idCompra,
            nombreComprador: nombreComprador,
            correoComprador: correoComprador,
            sede: sede,
            accion: "agregarDetallesCompra"
        },
        success: function(data){ 
            agregarEquipamientosCompra(idCompra); //Agrega datos a la tabla Extras
        },
        error: function(data){
            mensaje("error","ERROR","Error al realizar la Compra!");
        }
    });
}
function agregarEquipamientosCompra(idCompra){ //Agrega datos a la tabla Extras
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var cantidadInputs = document.querySelectorAll('.edicion .cantidad input');

    for(let i=0; i<checkboxes.length; i++){
        if(checkboxes[i].checked == true){
            idEquipamiento = checkboxes[i].value;
            cantidad = cantidadInputs[i].value;

            $.ajax({
                url: "../../Controlador/ControladorExtra.php",
                method: "POST",
                data: {
                    idCompra: idCompra,
                    idEquipamiento: idEquipamiento,
                    cantidad: cantidad,
                    accion: "agregarExtras"
                },
                success: function(data){
                },
                error: function(data){
                    mensaje("error","ERROR","Ha ocurrido un error al llenar la tabla Extras!");
                }
            });
        }
    }

    Swal.fire({
        icon: "success",
        title: "Compra Realizada",
        text: "La compra se ha realizado con éxito!",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
    }).then((result) => {
        if(result.isConfirmed)
            window.location.href = "./verCompras.php";
        else
            window.location.href = "./verCompras.php";
    });
}