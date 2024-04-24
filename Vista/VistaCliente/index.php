<?php
    include("../Principal/header.php");

    /*$v = $_SESSION["v"];
    $cantVehiculos = $_SESSION["cantVehiculos"];

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

    <div class="vehiculos">
        <table>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php
                $cantVehiculos = 5;
                $cont = 0;

                if(intval($cantVehiculos % 3) == 0)
                    $nFilas = $cantVehiculos / 3;
                else
                    $nFilas = intval(($cantVehiculos / 3) + 1);

                for($i=0; $i<$nFilas; $i++){ 
            ?>
            <tr>
                <?php
                    for($j=0; $j<3; $j++){
                ?>
                <td>
                    <?php 
                        if($cont < $cantVehiculos){
                    ?>
                    <div class="modal-vehiculo">
                        <input class="img" type="image" src="../../CSS/Imgs/Fondo_12.jpg" width="100%" height="100%" alt="Vehículo">
                    </div>
                    <?php 
                            $cont++;
                        }
                    ?>
                </td>
            <?php 
                    }
            echo "</tr>";
                } 
            ?>
        </table>
    </div>
</div>

<?php
    include("../Principal/footer.php")
?>