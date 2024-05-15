function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
}
function btnMostarBotonVender(){ //Muestra el botón de comprar
    document.getElementById("btnConfirmarVenta").style.display = "block";
}
function btnConfirmarVenta(){ //Verifica los campos de equipamiento
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
        verDetallesVenta();
}
function verDetallesVenta(){ //Muestra el modal con sus detalles
    $("#confirmarVenta").modal("show");

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
function verificarVenta(){ //Verifica los datos del formulario
    let correo = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    if(document.getElementById("comprador").value.trim() === ""){
        mensaje("error","Error","El Nombre del Comprador es Requerido!");

        return false;
    }

    if(document.getElementById("correoC").value.trim() === ""){
        mensaje("error","Error","El Correo del Comprador es Requerido!");

        return false;
    }
    if(!correo.test(document.getElementById("correoC").value)){
        mensaje("error","Error","El correo NO es Valido!");

        return false;
    }

    btnRealizarVenta();
}
function btnRealizarVenta(){ //Confirma la compra
    Swal.fire({
        icon: "warning",
        title: "Confirmar Venta",
        text: "¿Desea realizar la venta?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if(result.isConfirmed)
            realizarVenta();
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
function realizarVenta(){ //Realiza el proceso para vender el vehículo
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
                agregarDetallesVenta(placaVehiculo);
            },
            error: function(data){
                mensaje("error","ERROR","Error al realizar la Venta!");
            }
        });
    });
}
function agregarDetallesVenta(placaVehiculo){ //Busca la compra realizada recientemente
    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            placaVehiculo: placaVehiculo,
            accion: "listarCompraPorPlacaVehiculo"
        },
        success: function(data){
            datos = JSON.parse(data); 

            agregarDetalles(datos[0]["ID"]); //Agrega datos a la tabla DetallesVentasCompras
        },
        error: function(data){
            mensaje("error","ERROR","Error al obtener la Compra Reciente!");
        }
    });
}
function agregarDetalles(idVenta){ //Agrega datos a la tabla DetallesVentasCompras
    nombreVendedor = $("#vendedor").val();
    nombreComprador = $("#comprador").val();
    correoComprador = $("#correoC").val();
    sede = $("#sede").val();

    $.ajax({
        url: "../../Controlador/ControladorDetallesVentasCompras.php",
        method: "POST",
        data: {
            idVenta: idVenta,
            nombreVendedor: nombreVendedor,
            nombreComprador: nombreComprador,
            correoComprador: correoComprador,
            sede: sede,
            accion: "agregarDetallesVenta"
        },
        success: function(data){ 
            agregarEquipamientos(idVenta); //Agrega datos a la tabla Extras
        },
        error: function(data){
            mensaje("error","ERROR","Error al realizar la Compra!");
        }
    });
}
function agregarEquipamientos(idVenta){ //Agrega datos a la tabla Extras
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
                    idCompra: idVenta,
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
        title: "Venta Realizada",
        text: "La venta se ha realizado con éxito!",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
    }).then((result) => {
        if(result.isConfirmed)
            window.location.href = "./verVentas.php";
        else
            window.location.href = "./verVentas.php";
    });
}