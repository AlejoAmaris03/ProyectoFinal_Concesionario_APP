const slides = document.querySelectorAll(".listaVehiculos img"); //Almacena todas la imágenes
let slideIndex = 0; //Posición de cada imágen

function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
} 
function obtenerDatosVehiculo(id){
    $.ajax({
        url: "./Controlador/ControladorVehiculo.php",
        method: "POST",
        data: {
            id: id,
            accion: "editarVehiculo"
        },
        success: function(data){
            datos = JSON.parse(data);

            //Información del formulario de Ver Más
            $("#marcaV").val(datos[0]["Marca"]);
            $("#modeloV").val(datos[0]["Modelo"]);
            $("#tipoV").val(datos[0]["Tipo"]);
            $("#descripcionV").val(datos[0]["Descripcion"]);
            $("#precioV").val(datos[0]["Precio"]);

            obtenerSedes(datos[0]["ID"]);
        },
        error: function(data){   
            mensaje("error","ERROR","Ha ocurrido un error al buscar los Vehículos!");
        }
    });
}
function obtenerSedes(id){
    var sedes = "";

    $.ajax({
        url: "./Controlador/ControladorSedeVehiculo.php",
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
function inicializarSlide(){ //Muestra la primera imágen
    if(slides.length > 0){
        $("#noVehiculo").text("Vehículo "+(slideIndex + 1)+" de "+slides.length);
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
function btnVerMas(id){ //Muestra los detalles de un vehículo determinado
    obtenerDatosVehiculo(id);
    $(".modal").modal("show");
}