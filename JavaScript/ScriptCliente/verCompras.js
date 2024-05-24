$(document).ready(function() {
    idUsuario = $("#idUsuario").val();
    
    tablaHistorialCompras = $('#tablaHistorialCompras').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorVentaCompra.php",
            method: "POST",
            dataSrc: "",
            data: {
                idUsuario: idUsuario,
                accion: "listarCompras"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Vehiculo"},
            {"data" : "Referencia"},
            {"data" : "PlacaVehiculo"},
            {"data" : "Total"},
            {"data" : "verDetalles"}
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        }
    });
});
function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
}
function btnVerDetalleCompra(id){
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            idCompra: id,
            accion: "listarComprasPorIdCompra"
        },
        success: function(data){
            datos = JSON.parse(data);
            
            $("#referencia").val(datos[0]["Referencia"]);   
            $("#vehiculo").val(datos[0]["Vehiculo"]);
            $("#placa").val(datos[0]["PlacaVehiculo"]);
            $("#sede").val(datos[0]["Sede"]);
            $("#precioVehiculo").val(datos[0]["PrecioVehiculo"]);
            $("#totalVenta").val(datos[0]["Total"]);

            obtenerExtras(id);
        },
        error: function(data){
            mensaje("error","ERROR","Error al obtener una Compra!");
        }
    });
}
function obtenerExtras(idCompra){
    let extras = "";
    let totalExtras = 0;

    $.ajax({
        url: "../../Controlador/ControladorExtra.php",
        method: "POST",
        data: {
            idCompra: idCompra,
            accion: "listarExtrasPorIdCompra"
        },
        success: function(data){
            datos = JSON.parse(data);
            
            for(let i=0; i<datos.length; i++){
                extras += "(" + datos[i]["Cantidad"] + ") " + datos[i]["Equipamiento"] + " $" + parseInt(datos[i]["Cantidad"]) * parseInt(datos[i]["Precio"]) + "\n";
                totalExtras += parseInt(datos[i]["Cantidad"]) * parseInt(datos[i]["Precio"]);
            }

            if(datos.length == 0)
                extras = "No se seleccionaron Equipamientos";

            document.getElementById("equipamientos").value = extras;
            document.getElementById("precioEq").value = totalExtras;
        },
        error: function(data){
            mensaje("error","ERROR","Error al obtener los Extras!");
        }
    });
}
function btnDescargarCompra(){
    let pdf = new jsPDF();
    pdf.text(20,30,"Reporte de Compra "+$("#nombreComprador").val()+": "+$("#referencia").val()+" - "+$("#placa").val());

    let columnas = ["Detalle","Descripción"];
    let datos = [
        ["Referencia del Vehículo",$("#referencia").val()],
        ["Vendedor","Concesionario Auto Shop S.A.S"],
        ["Comprador",$("#nombreComprador").val()],
        ["Vehículo",$("#vehiculo").val()],
        ["Placa",$("#placa").val()],
        ["Sede",$("#sede").val()],
        ["Equipamientos",$("#equipamientos").val()],
        ["Precio Equipamiento",$("#precioEq").val()],
        ["Precio Vehículo",$("#precioVehiculo").val()],
        ["TOTAL",$("#totalVenta").val()]
    ];
    pdf.autoTable(columnas,datos,
        { margin: {top: 35}}
    );

    pdf.save("DetallesCompra"+$("#referencia").val()+"_"+$("#placa").val());
}