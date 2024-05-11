<?php //Vista Principal de los Clientes (usuarios "estándar")
    include("../Principal/header.php");
            
    if(strcmp($u->getTipoUsuario(),"Vendedor")!=0)
        header("Location: ../../Controlador/Validar.php?accion=Salir");
?>

<div class="contenedor-vehiculos">
    <div class="botones">
        <div class="principales">
            <a class="btnCompras" href="./verVentas.php" title="Ver Historial de Ventas">
                <i class="btnCompras fa-solid fa-cart-shopping"></i>
            </a>
        </div>
    </div>

    <div class="separador"></div>

    <div class="vehiculos">
        <div class="titulo">
            <h3>Vehículos Disponibles para la Venta</h3>
        </div>

        <table>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>

            <?php
            $v = $_SESSION["v"]; //Lista de vehiculos disponibles

            for ($i = 0; $i<count($v); $i++) {
                    if (($i % 3) == 0)
                        echo "<tr class='tr'>";
            ?>
                <td>
                    <div class="modal-vehiculo">
                        <div class="encabezado">
                            <p>
                                <?=$v[$i]["Marca"]?> <?=$v[$i]["Modelo"]?>
                            </p>

                            <button class="btnComprar" type="button" onclick="btnSeleccionarVehiculoVenta(<?=$v[$i]['ID']?>)" title="Vender Vehículo">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>

                        <div class="img">
                            <button class="btnVerDetalles" type="button" onclick="btnVerDetallesVenta(<?=$v[$i]['ID']?>)" title="Ver Detalles">
                                <img src="data:image/jpeg;base64,<?=$v[$i]["Imagen"]?>" width="100%" height="100%" alt="Imágen Vehículos">
                            </button>
                        </div>

                        <div class="final">
                            <p>
                                Precio: $<?=$v[$i]["Precio"]?>
                            </p>
                        </div>
                    </div>
                </td>
            <?php
                    if ((($i + 1) % 3) == 0 || $i == (count($v) - 1))
                        echo "</tr>";
            }
            ?>
        </table>
    </div>

    <!-- Modal de Ver Detalles -->
    <div class="modal fade" id="verDetalles" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detalles del Vehículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="idV" id="idV">

                    <div class="campos" title="Marca del Vehículo">
                        <i class="fa-solid fa-car"></i>
                        <input class="form-campos" type="text" name="marcaV" id="marcaV" readonly>
                    </div>

                    <div class="campos" title="Modelo del Vehículo">
                        <i class="fa-solid fa-car"></i>
                        <input class="form-campos" type="text" name="modeloV" id="modeloV" readonly>
                    </div>

                    <div class="campos" title="Tipo de Vehículo">
                        <i class="fa-solid fa-car"></i>
                        <input class="form-campos" type="text" name="tipoV" id="tipoV" readonly>
                    </div>

                    <div class="campos descripcion" title="Descripción del Vehículo">
                        <i>Descripción</i>
                        <textarea name="descripcionV" id="descripcionV" cols="30" rows="3" readonly></textarea>
                    </div>

                    <div class="campos descripcion" title="Sedes donde se encuentra el vehículo">
                        <i>Sedes donde se encuentra el vehículo</i>
                        <textarea name="sedesV" id="sedesV" cols="30" rows="3" readonly></textarea>
                    </div>

                    <div class="campos" title="Precio del Vehículo">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <input class="form-campos" type="number" name="precioV" id="precioV" readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <buton type="button" class="btn btn-primary" onclick="btnVistaVenta()">Vender</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>