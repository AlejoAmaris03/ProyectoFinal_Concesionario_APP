<?php
    include("../Principal/header.php");

    /*$v = $_SESSION["v"];
        
    if(strcmp($u->getTipoUsuario(),"Administrador")!=0)
        header("Location: ../../Controlador/Validar.php?accion=Salir");*/
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

                            <button class="btnComprar" type="button" onclick="btnComprar()" title="Comprar Vehículo">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>

                        <div class="img">
                            <button class="btnVerDetalles" type="button" onclick="btnVerDetalles(<?php echo $i; ?>)" title="Ver Detalles">
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

    <!-- Modal de Comprar -->
    <div class="pop-up-compra">
        <div class="pop-up-cuerpo">
            <div class="pop-up-encabezado">
                <h3 class="pop-up-titulo">Detalles de la Compra</h3>
                <button type="button" onclick="cerrarPopUp('.pop-up-compra')">X</button>
            </div>

            <div class="pop-up-contenido">
                ...
            </div>

            <div class="pop-up-footer">
                <button type="button" onclick="cerrarPopUp('.pop-up-compra')">Cancelar</button>
                <button type="button" onclick="comprar()">Comprar</button>
            </div>
        </div>
    </div>

    <!-- Modal de Comprar -->
    <div class="pop-up-detalles">
        <div class="pop-up-cuerpo">
            <div class="pop-up-encabezado">
                <h3 class="pop-up-titulo">Detalles del Vehículo</h3>
                <button type="button" onclick="cerrarPopUp('.pop-up-detalles')">X</button>
            </div>

            <div class="pop-up-contenido">
                ...
            </div>

            <div class="pop-up-footer">
                <button type="button" onclick="cerrarPopUp('.pop-up-detalles')">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php")
?>