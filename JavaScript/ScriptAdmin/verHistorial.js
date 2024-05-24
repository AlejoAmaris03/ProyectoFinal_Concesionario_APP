 $(document).ready(function() { 
    tablaHistorialVentas = $('#tablaHistorialVentas').DataTable({ //Llena la tabla con los datos
        responsive: true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        ajax: {
            url: "../../Controlador/ControladorVentaCompra.php",
            method: "POST",
            dataSrc: "",
            data: {
                accion: "listarVentaCompra"
            }
        },
        "columns": [
            {"data" : "ID"},
            {"data" : "Usuario"},
            {"data" : "TipoU"},
            {"data" : "Vehiculo"},
            {"data" : "Referencia"},
            {"data" : "PlacaVehiculo"},
            {"data" : "Total"},
            {"data" : "verDetalles"},
            {"data" : "descargar"},
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        dom: "Bfrtilp",
        buttons: [
            {
                extend: "pdfHtml5",
                download: "open",
                titleAttr: "Reporte Historial de Ventas/Compras (pdf)",
                title: "Reporte Historial de Ventas/Compras",
                filename: "ReporteHistorial",
                text: "<i class='fa-solid fa-file-pdf'></i>",
                className: "pdf btn btn-danger",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: "print",
                titleAttr: "Reporte Historial de Ventas/Compras (pdf)",
                title: "Reporte Historial de Ventas/Compras",
                filename: "ReporteHistorial",
                text: "<i class='fa-solid fa-print'></i>",
                className: "imprimir btn btn-info",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }
        ]
    });
});
function mensaje(icono,titulo,texto){ //Mensaje básico de SweetAlert2
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
    });
}
function btnVerDetallesHistorial(id){
    $(".modal").modal("show");

    $.ajax({
        url: "../../Controlador/ControladorVentaCompra.php",
        method: "POST",
        data: {
            idVentaCompra: id,
            accion: "listarHistorialPorIdVentaCompra"
        },
        success: function(data){
            datos = JSON.parse(data);

            if(!datos[0]["NombreVendedor"])
                $("#nombreVendedor").val("Concesionario Auto Shop S.A.S");
            else
                $("#nombreVendedor").val(datos[0]["NombreVendedor"]);

            $("#nombreComprador").val(datos[0]["NombreComprador"]); 
            $("#correoComprador").val(datos[0]["CorreoComprador"]); 
            $("#referencia").val(datos[0]["Referencia"]);   
            $("#vehiculo").val(datos[0]["Vehiculo"]);
            $("#placa").val(datos[0]["PlacaVehiculo"]);
            $("#sede").val(datos[0]["Sede"]);
            $("#precioVehiculo").val(datos[0]["PrecioVehiculo"]);
            $("#totalVenta").val(datos[0]["Total"]);

            obtenerExtras(id);
        },
        error: function(data){
            mensaje("error","ERROR","Error al obtener una Venta/Compra!");
        }
    });
}
function obtenerExtras(idVentaCompra){
    let extras = "";
    let totalExtras = 0;

    $.ajax({
        url: "../../Controlador/ControladorExtra.php",
        method: "POST",
        data: {
            idCompra: idVentaCompra,
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
function btnDescargarHistorial(){
    refVehiculo = $("#referencia");
    nombreVendedor = $("#nombreVendedor");
    nombreComprador = $("nombreComprador");
    correoComprador = $("correoComprador");
    nombreVehiculo = $("vehiculo");
    

    let pdf = new jsPDF();

    pdf.text(20,30,"Reporte de Ventas/Compras");
}