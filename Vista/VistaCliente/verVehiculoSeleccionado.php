<?php //Vista para ver y comprar el vehículo seleccionado por el cliente
    include("../Principal/header.php");   

    $v = $_SESSION["vSeleccionado"];
    $eq = $_SESSION["equipamiento"];
    $sede = $_SESSION["sedes"];
?>

<div class="editar">
    <div class="botones">
        <div class="principales">
            <a class="btnRegresar" href="<?php echo $link; ?>" title="Regresar a la página principal">
                <i class="fa-solid fa-rotate-left"></i>
            </a>
        </div>
    </div>

    <hr class="separador">

    <h3 class="titulo">Adquirir Vehículo</h3>

    <div class="contenedor-editar">
        <div class="ver-info">
            <div class="logo">
                <img src="data:image/jpeg;base64,<?=$v[0]["Imagen"]?>" width="100%" height="100%" alt="Vehículo Seleccionado">
            </div>

            <div class="info">
                <form name="ver-info" id="ver-info">
                    <div class="datos">
                        <label class="MarcaModelo" id="marcaModeloV"><?=$v[0]["Marca"]?> <?=$v[0]["Modelo"]?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-car"></i><b>Tipo de Vehículo:</b>
                        <label id="tipoV"><?=$v[0]["Tipo"]?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-comment"></i><b>Descripción:</b> 
                        <label id="descripcionV"><?=$v[0]["Descripcion"]?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-money-bill"></i><b>Precio:</b> 
                        <label id="precioV">$<?=$v[0]["Precio"]?></label>
                    </div>
                </form>

                <div class="btn-editar">
                    <button type="button" onclick="btnMostarBotonComprar()">Adquirir</button>
                </div>
            </div>
        </div>

        <div class="edicion">
            <h3>Equipamiento Extra</h3>

            <input type="hidden" name="idU" id="idU" value="<?=$u->getId()?>">
            <input type="hidden" name="nombreComprador" id="nombreComprador" value="<?=$u->getNombre()?>">
            <input type="hidden" name="correoComprador" id="correoComprador" value="<?=$u->getCorreo()?>">
            <input type="hidden" name="idV" id="idV" value="<?=$v[0]["ID"]?>">

            <form name="form" id="edicion" method="POST">
                <?php 
                    for ($i=0; $i<count($eq); $i++){ ?>
                        <div class="opcionesEquipamiento">
                            <div class="equipamiento">
                                <input type="checkbox" id="idEq" value="<?=$eq[$i]["ID"]?>">
                                <label class="eqNombre" id="eqNombre"><?=$eq[$i]["Nombre"]?></label>
                                $<label class="precioEq" id="precioEq"><?=$eq[$i]["Precio"]?></label>
                            </div>

                            <div class="cantidad">
                                <input type="number" name="cantidadEq" id="cantidadEq" min=1 placeholder="Digite la Cantidad">
                            </div>
                        </div>
                <?php 
                    } ?>
            </form>

            <div class="btn-editar">
                <button id="btnConfirmarCompra" type="button" onclick="btnConfirmarCompra()">Comprar Vehículo</button>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmar Compra -->
    <div class="modal fade" id="confirmarCompra" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detalles de la Compra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="campos descripcion" title="Nombre del Vehículo">
                        <i>Nombre del Vehículo</i>
                        <textarea name="vehiculo" id="vehiculo" cols="30" rows="1" readonly><?=$v[0]["Marca"]?> <?=$v[0]["Modelo"]?></textarea>
                    </div>

                    <div class="campos descripcion" title="Precio del Vehículo">
                        <i>Precio del Vehículo</i>
                        <textarea name="precioVehiculo" id="precioVehiculo" cols="30" rows="1" readonly><?=$v[0]["Precio"]?></textarea>
                    </div>

                    <div class="campos descripcion" title="Equipamientos seleccionados">
                        <i>Equipamientos Seleccionados</i>
                        <textarea name="equipamientos" id="equipamientos" cols="30" rows="4" readonly></textarea>
                    </div>

                    <div class="campos select" title="Seleccione la Sede">
                        <i>Sede</i>

                        <select name="sede" id="sede">
                            <?php 
                                for ($i=0; $i<count($sede); $i++){ ?>
                                    <option value="<?=$sede[$i]["IdSede"]?>"><?=$sede[$i]["Sede"]?> - <?=$sede[$i]["Direccion"]?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="campos descripcion" title="Total">
                        <i>Total</i>
                        <textarea name="totalVenta" id="totalVenta" cols="30" rows="1" readonly></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <buton type="button" class="btn btn-primary" onclick="btnRealizarCompra()">Comprar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>