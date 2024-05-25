$(document).ready(function() {
    idUsuario = $("#idUsuario").val();
    
    tablaHistorial = $('#tablaHistorial').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorVentaCompra.php",
            method: "POST",
            dataSrc: "",
            data: {
                idUsuario: idUsuario,
                accion: "listarVentas"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "NombreComprador"},
            {"data" : "Vehiculo"},
            {"data" : "Referencia"},
            {"data" : "PlacaVehiculo"},
            {"data" : "FechaVentaCompra"},
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
function btnVerDetalleVenta(id){
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            idVenta: id,
            accion: "listarVentasPorIdVenta"
        },
        success: function(data){
            datos = JSON.parse(data);

            $("#nombreComprador").val(datos[0]["NombreComprador"]); 
            $("#correoComprador").val(datos[0]["CorreoComprador"]); 
            $("#referencia").val(datos[0]["Referencia"]);   
            $("#vehiculo").val(datos[0]["Vehiculo"]);
            $("#placa").val(datos[0]["PlacaVehiculo"]);
            $("#sede").val(datos[0]["Sede"]);
            $("#precioVehiculo").val(datos[0]["PrecioVehiculo"]);
            $("#fecha").val(datos[0]["FechaVentaCompra"]);
            $("#totalVenta").val(datos[0]["Total"]);

            obtenerExtras(id);
        },
        error: function(data){
            mensaje("error","ERROR","Error al obtener una Venta!");
        }
    });
}
function obtenerExtras(idVenta){
    let extras = "";
    let totalExtras = 0;

    $.ajax({
        url: "../../Controlador/ControladorExtra.php",
        method: "POST",
        data: {
            idCompra: idVenta,
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
function btnDescargarVenta(){
    let pdf = new jsPDF();
    pdf.text(20,30,"Reporte de Venta "+$("#nombreVendedor").val()+": "+$("#referencia").val()+" - "+$("#placa").val());

    let columnas = ["Detalle","Descripción"];
    let datos = [
        ["Referencia del Vehículo",$("#referencia").val()],
        ["Vendedor",$("#nombreVendedor").val()],
        ["Comprador",$("#nombreComprador").val()],
        ["Correo Comprador",$("#correoComprador").val()],
        ["Vehículo",$("#vehiculo").val()],
        ["Placa",$("#placa").val()],
        ["Sede",$("#sede").val()],
        ["Equipamientos",$("#equipamientos").val()],
        ["Precio Equipamiento",$("#precioEq").val()],
        ["Precio Vehículo",$("#precioVehiculo").val()],
        ["Fecha de Venta",$("#fecha").val()],
        ["TOTAL",$("#totalVenta").val()]
    ];
    pdf.autoTable(columnas,datos,
        { margin: {top: 35}}
    );

    pdf.save("DetallesVenta"+$("#referencia").val()+"_"+$("#placa").val());
}