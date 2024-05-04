<?php //Vista Principal de los Clientes (usuarios "estándar")
    include("../Principal/header.php");
            
    if(strcmp($u->getTipoUsuario(),"Cliente")!=0)
        header("Location: ../../Controlador/Validar.php?accion=Salir");
?>

<div class="contenedor-vehiculos">
    <div class="botones">
        <div class="principales">
            <a class="btnCompras" href="./verCompras.php" title="Ver Historial de Compras">
                <i class="btnCompras fa-solid fa-cart-shopping"></i>
            </a>
        </div>
    </div>

    <div class="separador"></div>

    <div class="vehiculos">
        <div class="titulo">
            <h3>Vehículos Disponibles</h3>
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
                if($v[$i]["Cantidad"] > 0){
                    if (($i % 3) == 0)
                        echo "<tr class='tr'>";
            ?>
                <td>
                    <div class="modal-vehiculo">
                        <div class="encabezado">
                            <p>
                                <?=$v[$i]["Marca"]?> <?=$v[$i]["Modelo"]?>
                            </p>

                            <button class="btnComprar" type="button" onclick="btnBuscarVehiculo()" title="Comprar Vehículo">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>

                        <div class="img">
                            <button class="btnVerDetalles" type="button" onclick="btnVerDetalles(<?=$v[$i]['ID']?>)" title="Ver Detalles">
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

                    <div class="campos" title="Placa del Vehículo">
                        <i class="fa-solid fa-car"></i>
                        <input class="form-campos" type="text" name="placaV" id="placaV" readonly>
                    </div>

                    <div class="campos descripcion" title="Descripción del Vehículo">
                        <i>Descripción</i>
                        <textarea name="descripcionV" id="descripcionV" cols="30" rows="3" readonly></textarea>
                    </div>

                    <div class="campos" title="Cantidad de Vehículos Disponibles">
                        <i class="fa-solid fa-hashtag"></i>
                        <input class="form-campos" type="number" name="cantidadV" id="cantidadV" readonly>
                    </div>

                    <div class="campos" title="Precio del Vehículo">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <input class="form-campos" type="number" name="precioV" id="precioV" readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <buton type="button" class="btn btn-primary" onclick="btnBuscarVehiculo()">Comprar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>