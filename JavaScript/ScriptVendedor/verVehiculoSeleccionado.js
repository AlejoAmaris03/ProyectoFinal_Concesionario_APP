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
function realizarVenta(){ //Realiza el proceso para vender el vehículo
}