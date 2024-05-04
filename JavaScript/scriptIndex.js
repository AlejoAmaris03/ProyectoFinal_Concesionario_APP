const slides = document.querySelectorAll(".listaVehiculos img"); //Almacena todas la imágenes
let slideIndex = 0; //Posición de cada imágen

function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
} 
function obtenerDatosVehiculo(fila){
    $.ajax({
        url: "./Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            fila: fila,
            accion: "obtenerVehiculosPorFila"
        },
        success: function(data){
            datos = JSON.parse(data);

            //Información de Footer
            $("#marca").text("Marca: "+datos[0]["Marca"]);
            $("#modelo").text("Modelo: "+datos[0]["Modelo"]);
            $("#tipoVehiculo").text("Tipo de Vehículo: "+datos[0]["Tipo"]);
            $("#detalles").text("Detalles: "+datos[0]["Descripcion"]);

            //Información del formulario de Ver Más
            $("#marcaV").val(datos[0]["Marca"]);
            $("#modeloV").val(datos[0]["Modelo"]);
            $("#tipoV").val(datos[0]["Tipo"]);
            $("#placaV").val(datos[0]["Placa"]);
            $("#descripcionV").val(datos[0]["Descripcion"]);
            $("#cantidadV").val(datos[0]["Cantidad"]);
            $("#precioV").val(datos[0]["Precio"]);
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar los Vehículos!");
        }
    });
}
function inicializarSlide(){ //Muestra la primera imágen
    if(slides.length > 0){
        $("#noVehiculo").text("Vehículo "+(slideIndex + 1)+" de "+slides.length);
        obtenerDatosVehiculo(slideIndex);
        slides[slideIndex].classList.add("aparecerSlide");
    }
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
    obtenerDatosVehiculo(slideIndex);
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