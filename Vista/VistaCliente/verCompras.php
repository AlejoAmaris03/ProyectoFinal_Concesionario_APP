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
        <input type="hidden" name="idUsuario" id="idUsuario" value="<?=$u->getId()?>">

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

    <div class="modal fade" id="verDetalles" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detalles de la Compra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <div class="campos descripcion" title="Referencia del Vehículo">
                        <i>Referencia del Vehículo</i>
                        <textarea name="referencia" id="referencia" cols="30" rows="1" readonly></textarea>
                    </div>

                    <div class="campos descripcion" title="Nombre del Vehículo">
                        <i>Nombre del Vehículo</i>
                        <textarea name="vehiculo" id="vehiculo" cols="30" rows="1" readonly></textarea>
                    </div>

                    <div class="campos descripcion" title="Placa">
                        <i>Placa</i>
                        <textarea name="placa" id="placa" cols="30" rows="1" readonly></textarea>
                    </div>

                    <div class="campos descripcion" title="Sede">
                        <i>Lugar de la Compra</i>
                        <textarea name="sede" id="sede" cols="30" rows="1" readonly></textarea>
                    </div>

                    <div class="campos descripcion" title="Equipamientos seleccionados">
                        <i>Equipamientos Seleccionados</i>
                        <textarea name="equipamientos" id="equipamientos" cols="30" rows="3" readonly></textarea>
                    </div>

                    <div class="campos descripcion" title="Precio del Vehículo">
                        <i>Precio de los Equipamientos</i>
                        <textarea name="precioEq" id="precioEq" cols="30" rows="1" readonly></textarea>
                    </div>

                    <div class="campos descripcion" title="Precio del Vehículo">
                        <i>Precio del Vehículo</i>
                        <textarea name="precioVehiculo" id="precioVehiculo" cols="30" rows="1" readonly></textarea>
                    </div>

                    <div class="campos descripcion" title="Total">
                        <i>Total</i>
                        <textarea name="totalVenta" id="totalVenta" cols="30" rows="1" readonly></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <buton type="button" class="btn btn-primary" onclick="btnDescargar()">Descargar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>