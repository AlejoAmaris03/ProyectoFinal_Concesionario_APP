function showPopUp(nombre){
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    var windowHeight = window.innerHeight;
    var popUpHeight = document.querySelector(nombre).offsetHeight;
    var topPosition = scrollTop + (windowHeight - popUpHeight) / 2;

    document.querySelector(nombre).style.top = topPosition + 'px';
    document.querySelector(nombre).style.visibility = 'visible';

}
function cerrarPopUp(nombre){
    document.querySelector(nombre).style.visibility = 'hidden';
};
function btnComprar(){
    cerrarPopUp(".pop-up-detalles");
    showPopUp(".pop-up-compra");
}
function btnVerDetalles(N){
    cerrarPopUp(".pop-up-compra");
    showPopUp(".pop-up-detalles");
}
function comprar(){
    Swal.fire({
        icon: "error",
        title: "sdfsfs",
        text: "Boton",
    });

    cerrarPopUp(".pop-up-compra");
}