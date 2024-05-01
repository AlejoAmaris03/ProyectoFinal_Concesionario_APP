const slides = document.querySelectorAll(".listaVehiculos img");
let slideIndex = 0;

function inicilizarSlide(){
    if(slides.length > 0){
        $("#marca").text("Ferrari: "+slideIndex);
        slides[slideIndex].classList.add("aparecerSlide");
    }
}
function listarVehiculos(){
    inicilizarSlide();
}
function mostrarSlide(index){
    if(index >= slides.length)
        slideIndex = 0;
    else if(index < 0)
        slideIndex = slides.length - 1;

    slides.forEach(slide => {
        slide.classList.remove("aparecerSlide");
    });

    $("#marca").text("Ferrari: "+slideIndex);
    slides[slideIndex].classList.add("aparecerSlide");
}
function btnAnterior(){
    slideIndex--;
    mostrarSlide(slideIndex);
}
function btnSiguiente(){
    slideIndex++;
    mostrarSlide(slideIndex);
}