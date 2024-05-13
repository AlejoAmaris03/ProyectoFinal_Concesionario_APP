<?php //Vista que muestra el historial de compras
    include("../Principal/header.php");

    if(strcmp($u->getTipoUsuario(),"Cliente")!=0)
        header("Location: ../../Controlador/Validar.php?accion=Salir");
?>

<div class="contenido-opcion">
    <!--Botones Superiores-->
    <div class="botones">
        <div class="principales">
        </div>

        <div class="regresar">
            <a class="btnRegresar" href="<?php echo $link; ?>" title="Regresar a la Página Principal">
                <i class="btnRegresar fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>

    <div class="separador"></div>
    <!--Tabla de Datos-->
    <div class="tabla">
        <div class="titulo-tabla">
            <h3>Historial de Compras</h3>
        </div>
        
        <div class="table-responsive contenido-tabla">
            <table class="table table-striped table-dark table-hover display nowrap" id="tablaHistorialCompras" style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vehículo</th>
                        <th>Referencia</th>
                        <th>Placa</th>
                        <th>Valor de la Compra</th>
                        <th>Ver Detalles</th>
                        <th>Descargar Recibo</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>