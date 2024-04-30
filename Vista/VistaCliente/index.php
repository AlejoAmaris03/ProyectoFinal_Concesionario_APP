<?php //Vista Principal de los Clientes (usuarios "estándar")
include("../Principal/header.php");

    /*$v = $_SESSION["v"];*/ //Lista de vehiculos disponibles
            
    if(strcmp($u->getTipoUsuario(),"Estandar")!=0)
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
            $cont = 0;
            $cantVehiculos = 5;

            for ($i = 0; $i < $cantVehiculos; $i++) {
                if (($i % 3) == 0)
                    echo "<tr class='tr'>";
            ?>
                <td>
                    <div class="modal-vehiculo">
                        <div class="encabezado">
                            <p>
                                Volkwagen <?php echo $i; ?>
                            </p>

                            <button class="btnComprar" type="button" onclick="btnBuscarVehiculo()" title="Comprar Vehículo">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>

                        <div class="img">
                            <button class="btnVerDetalles" type="button" onclick="btnVerDetalles()" title="Ver Detalles">
                                <input type="image" src="../../CSS/Imgs/Fondo_2.png" width="100%" height="100%" alt="Vehículo">
                            </button>
                        </div>

                        <div class="final">
                            <p>
                                Valor: $<?php //echo $v[$i]["Valor"]; ?>
                            </p>
                        </div>
                    </div>
                </td>
            <?php
                if ((($i + 1) % 3) == 0 || $i == ($cantVehiculos - 1))
                    echo "</tr>";
            }
            ?>
        </table>
    </div>

    <!-- Modal de Ver Detalles -->
    <div class="modal fade" id="verDetalles" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detalles del Vehículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="idVehiculo" id="idVehiculo">

                    <div class="nombre">
                        <label for="nombre">Nombre y Modelo</label>
                        <input type="text" name="nombre_modelo" id="nombre_modelo" readonly>
                    </div>

                    <div class="descripcion">
                        <label for="descripcion">Descripción</label>
                        <fieldset id="descripcion"></fieldset>
                    </div>

                    <div class="valor">
                        <label for="valor">Precio</label>
                        <input type="number" name="valor" id="valor" readonly>
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