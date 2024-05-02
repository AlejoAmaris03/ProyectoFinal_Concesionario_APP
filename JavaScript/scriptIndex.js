const slides = document.querySelectorAll(".listaVehiculos img"); //Almacena todas la imágenes
let slideIndex = 0; //Posición de cada imágen

function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
} 
function inicilizarSlide(){ //Muestra la primera imágen
    if(slides.length > 0){
        $("#noVehiculo").text("Vehículo "+(slideIndex + 1)+" de "+slides.length);
        slides[slideIndex].classList.add("aparecerSlide");
    }
}
function listarVehiculos(){ //Crea el objeto que contiene la información de los vehículos
    inicilizarSlide();
}
function mostrarSlide(index){ //Muestra lás demás imágenes
    if(index >= slides.length) //Si la posición es mayor que el número total de imágenes
        slideIndex = 0;
    else if(index < 0) //Si la posición es menor que 0
        slideIndex = slides.length - 1;

    slides.forEach(slide => { //Desaparece las imágenes 
        slide.classList.remove("aparecerSlide");
    });

    $("#noVehiculo").text("Vehículo "+(slideIndex + 1)+" de "+slides.length);
    slides[slideIndex].classList.add("aparecerSlide"); //Muestra la imágen
}
function btnAnterior(){ //Ejecuta la acción de retroceder una imágen
    slideIndex--;
    mostrarSlide(slideIndex);
}
function btnSiguiente(){ //Ejecuta la acción de avanzar una imágen
    slideIndex++;
    mostrarSlide(slideIndex);
}
function btnAdquirir(){ //Ejecuta el boton de adquirir un vehículo
    mensaje("warning","ATENCIÓN","Inicie Sesión para Adquirir el Vehículo!");
}
function btnVerMas(){ //Muestra los detalles de un vehículo determinado
    $(".modal").modal("show");
}