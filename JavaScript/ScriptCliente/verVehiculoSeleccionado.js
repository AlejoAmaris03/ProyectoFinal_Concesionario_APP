function btnMostarBotonComprar(){ //Muestra el botón de comprar
    document.getElementById("btnConfirmarCompra").style.display = "block";
}
function btnConfirmarCompra(){ //Muestra el modal con los detalles de la compra
    $("#confirmarCompra").modal("show");
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
function realizarCompra(){ //Realiza el proceso para adquirir el vehículo
}